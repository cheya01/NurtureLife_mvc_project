<?php
//clinic class
class Midwife_model extends Model
{
    public array $errors = [];
    protected string $table = "PHM";
    protected string $primaryKey = 'id';
    protected array $afterSelect = [
        'get_moh_area',
        'get_created_user',
        'get_clinic_name',
        'get_PHM_name',
    ];
    protected array $beforeUpdate = [];
    protected array $allowedColumns = [
        'user_id',
        'SLMC_no',
        'clinic_id',
        'moh_area_id',
        'created_user_id',
        'created_at',
        'active'
    ];

    public function validate($data)
    {
        $this->errors = [];
        $user = new User_model();
        $clinic = new Clinic_model();
        $midwife = new Midwife_model();
        $PHM_user_id = 0;

        //check PHM nic
        if(empty($data['nic'])){
            $this->errors['nic'] = "Please enter NIC No. of PHM";
        }else {
            $row=$user->where(['nic' => $data['nic']]);
            if (empty($row)) {
                //check whether that user already exists
                $this->errors['nic'] = "User doesn't exist";
            } else {//user exists
                $userData=$row[0];
                if (!empty($midwife->where(['user_id' => $userData->id]))) {
                    //check whether that user already exists in the mothers table
                    $this->errors['nic'] = "This user is already a PHM";
                }else{
                    $PHM_user_id=$userData->id;
                }

            }
        }

        //check SLMC registration number
        if(empty($data['SLMC_no']))
            $this->errors['SLMC_no'] = "Please enter midwive's Sri Lanka Medial Council Reg no.";
        else if(!preg_match("/^[0-9-]{8}$/", trim($data['SLMC_no'])))
            $this->errors['SLMC_no'] = "SLMC reg no should be [section no]-[reg no]. eg:- 29-38500";
        else if($this->where(['SLMC_no' => $data['SLMC_no']]))
            $this->errors['SLMC_no'] = "This SLMC Reg no already exists";


        //check clinic id
        if(empty($data['clinic_id'])){
            $this->errors['clinic_id'] = "Please select clinic id of the PHM";
        }else{
            //check whether that clinic already exists
            $row = $clinic->where(['id' => $data['clinic_id']]);
            if(empty($row)){
                $this->errors['clinic_id'] = "That clinic doesn't exist";
            }
        }
        //check moh area id
        if(empty($data['moh_area_id'])){
            $this->errors['moh_area_id'] = "Please select MOH area id of the PHM";
        }else{
            //check whether that moh_area_id already exists
            $moh_area = new MOH_areas_model();
            $row = $moh_area->where(['id' => $data['moh_area_id']]);
            if(empty($row)){
                $this->errors['moh_area_id'] = "That MOH area doesn't exist";
            }
        }
        if(empty($this->errors)){
            return $PHM_user_id;
        }
        return false;
    }

    public function edit_validate($data, $id): bool
    {

        $this->errors = [];
        $user = new User_model();

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
            $this->errors['clinic_id'] = "Please select clinic id of the PHM";
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
            $this->errors['moh_area_id'] = "Please select MOH area id of the Midwife";
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
    protected function get_PHM_name($rows)
    {
        $db = new Database();
        if(!empty($rows[0]->user_id)){
            foreach ($rows as $key => $row){
                $query = "select firstname, lastname, email, id, contact_no, dob from users where id = :id limit 1";
                $user = $db->query($query, ['id'=>$row->user_id]);
                if(!empty($user)){
                    $user[0]->name = $user[0]->firstname . ' ' . $user[0]->lastname;
                    $rows[$key]->name_row = $user[0];
                }
            }
        }
        return $rows;
    }

public function validate_PHM_from_clinic($data)
{
    $this->errors = [];
    $user = new User_model();
    $clinic = new Clinic_model();
    $midwife = new Midwife_model();
    $PHM_user_id = 0;
    //check PHM nic
    if(empty($data['nic'])){
        $this->errors['nic'] = "Please enter NIC No. of PHM";
    }else {
        $row=$user->where(['nic' => $data['nic']]);
        if (empty($row)) {
            //check whether that user already exists
            $this->errors['nic'] = "User doesn't exist";
        } else {//user exists
            $userData=$row[0];
            if (!empty($midwife->where(['user_id' => $userData->id]))) {
                //check whether that user already exists in the mothers table
                $this->errors['nic'] = "This user is already a PHM";
            }else{
                $PHM_user_id=$userData->id;
            }

        }
    }
    //check SLMC registration number
    if(empty($data['SLMC_no']))
        $this->errors['SLMC_no'] = "Please enter midwive's Sri Lanka Medial Council Reg no.";
    else if(!preg_match("/^[0-9-]{8}$/", trim($data['SLMC_no'])))
        $this->errors['SLMC_no'] = "SLMC reg no should be [section no]-[reg no]. eg:- 29-38500";
    else if($this->where(['SLMC_no' => $data['SLMC_no']]))
        $this->errors['SLMC_no'] = "This SLMC Reg no already exists";
    if(empty($this->errors)){
        return $PHM_user_id;
    }
    return false;

}
}