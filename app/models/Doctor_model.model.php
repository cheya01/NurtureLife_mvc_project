<?php
//doctor class
class Doctor_model extends Model
{
    public array $errors = [];
    protected string $table = "doctors";
    protected string $primaryKey = 'id';
    protected array $afterSelect = [
        'get_moh_area',
        'get_created_user',
        'get_clinic_name',
        'get_doctor_name',
        'get_special'
    ];
    protected array $beforeUpdate = [];
    protected array $allowedColumns = [
        'user_id',
        'SLMC_no',
        'clinic_id',
        'moh_area_id',
        'special_id',
        'created_user_id',
        'created_at',
        'active'
    ];

    public function validate($data): bool
    {
        //check user id
        $this->errors = [];
        $user = new User_model();
        $doctor = new Doctor_model();
        if(empty($data['user_id'])){
            $this->errors['user_id'] = "Please enter user id of the doctor";
        }else if(empty($user->where(['id' => $data['user_id']]))){
            //check whether that user already exists
            $this->errors['user_id'] = "User doesn't exist";
            }
        else {
            if(!empty($doctor->where(['user_id' => $data['user_id']]))){
                //check whether that user already exists in the doctors table
                $this->errors['user_id'] = "This user is already a doctor";
            }
        }

        //check SLMC registration number
        //assumed the SLMC Reg no is 10 chars long and alphanumeric
        if(empty($data['SLMC_no']))
            $this->errors['SLMC_no'] = "Please enter doctor's Sri Lanka Medial Council Reg no.";
        else if(!preg_match("/^[0-9-]{8}$/", trim($data['SLMC_no'])))
            $this->errors['SLMC_no'] = "SLMC reg no should be [section no]-[reg no]. eg:- 29-38500";
        else if($this->where(['SLMC_no' => $data['SLMC_no']]))
            $this->errors['SLMC_no'] = "This SLMC Reg no already exists";

        //check clinic id
        if(empty($data['clinic_id'])){
            $this->errors['clinic_id'] = "Please select clinic id of the doctor";
        }else{
            //check whether that clinic already exists
            $clinic = new Clinic_model();
            $row = $clinic->where(['id' => $data['clinic_id']]);
            if(empty($row)){
                $this->errors['clinic_id'] = "That clinic doesn't exist";
            }
        }
        //check moh area id
        if(empty($data['moh_area_id'])){
            $this->errors['moh_area_id'] = "Please select MOH area id of the doctor";
        }else{
            //check whether that moh_area_id already exists
            $moh_area = new MOH_areas_model();
            $row = $moh_area->where(['id' => $data['moh_area_id']]);
            if(empty($row)){
                $this->errors['moh_area_id'] = "That MOH area doesn't exist";
            }
        }
        //check speacial id
        if(empty($data['special_id']))
            $this->errors['special_id'] = "Please select special of the doctor";
        else{
            //check whether that special_id already exists
            $doctor_special = new Doctor_specials_model();
            $row = $doctor_special->where(['id' => $data['special_id']]);
            if(empty($row)){
                $this->errors['special_id'] = "That doctor special area doesn't exist";
            }
        }
        if(empty($this->errors)){
            return true;
        }
        return false;
    }

    public function edit_validate($data, $id): bool
    {
        $this->errors = [];

        //check firstname
        if(empty($data['firstname'])){
            $this->errors['firstname'] = "Please enter your firstname";
        }else if(!preg_match("/^[a-zA-Z]+$/", trim($data['firstname']))){
            $this->errors['firstname'] = "First name can only have letters without spaces";
        }
        //check lastname
        if(empty($data['lastname'])){
            $this->errors['lastname'] = "Please enter your lastname";
        }else if(!preg_match("/^[a-zA-Z]+$/", trim($data['lastname']))){
            $this->errors['lastname'] = "Last name can only have letters without spaces";
        }

        //check clinic id
        if(empty($data['clinic_id'])){
            $this->errors['clinic_id'] = "Please select clinic id of the doctor";
        }else{
            //check whether that clinic already exists
            $clinic = new Clinic_model();
            $row = $clinic->where(['id' => $data['clinic_id']]);
            if(empty($row)){
                $this->errors['clinic_id'] = "That clinic doesn't exist";
            }
        }

        //check moh area id
        if(empty($data['moh_area_id'])){
            $this->errors['moh_area_id'] = "Please select MOH area id of the doctor";
        }else{
            //check whether that moh_area_id already exists
            $moh_area = new MOH_areas_model();
            $row = $moh_area->where(['id' => $data['moh_area_id']]);
            if(empty($row)){
                $this->errors['moh_area_id'] = "That MOH area doesn't exist";
            }
        }


        if(empty($this->errors)){
            return true;
        }
        return false;
    }
    protected function get_clinic_name($rows)
    {
        $db = new Database();
        if(!empty($rows[0]->clinic_id)){
            foreach ($rows as $key => $row){
                $query = "select * from clinics where id = :id limit 1";
                $name = $db->query($query, ['id'=>$row->clinic_id]);
                if(!empty($name)){
                    $rows[$key]->clinic_name_row = $name[0];
                }
            }
        }
        return $rows;
    }
    protected function get_moh_area($rows)
    {
        $db = new Database();
        if(!empty($rows[0]->moh_area_id)){
            foreach ($rows as $key => $row){
                $query = "select * from MOH_areas where id = :id limit 1";
                $area = $db->query($query, ['id'=>$row->moh_area_id]);
                if(!empty($area)){
                    $rows[$key]->moh_area_row = $area[0];
                }
            }
        }
        return $rows;
    }
    protected function get_created_user($rows)
    {
        $db = new Database();
        if(!empty($rows[0]->created_user_id)){
            foreach ($rows as $key => $row){
                $query = "select firstname, lastname, role_id from users where id = :id limit 1";
                $user = $db->query($query, ['id'=>$row->created_user_id]);
                if(!empty($user)){
                    $user[0]->name = $user[0]->firstname . ' ' . $user[0]->lastname;
                    $rows[$key]->user_row = $user[0];
                }
            }
        }
        return $rows;
    }
    protected function get_doctor_name($rows)
    {
        $db = new Database();
        if(!empty($rows[0]->user_id)){
            foreach ($rows as $key => $row){
                $query = "select firstname, lastname, email, id, contact_no from users where id = :id limit 1";
                $user = $db->query($query, ['id'=>$row->user_id]);
                if(!empty($user)){
                    $user[0]->name = $user[0]->firstname . ' ' . $user[0]->lastname;
                    $rows[$key]->name_row = $user[0];
                }
            }
        }
        return $rows;
    }
    protected function get_special($rows)
    {
        $db = new Database();
        if(!empty($rows[0]->special_id)){
            foreach ($rows as $key => $row){
                $query = "select * from doctor_specials where id = :id limit 1";
                $special = $db->query($query, ['id'=>$row->special_id]);
                if(!empty($special)){
                    $rows[$key]->doctor_special_row = $special[0];
                }
            }
        }
        return $rows;
    }


}