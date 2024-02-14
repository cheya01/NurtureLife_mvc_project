<?php
//doctor class
class Mother_model extends Model
{
    public array $errors = [];
    protected string $table = "mothers";
    protected string $primaryKey = 'id';
    protected array $afterSelect = [
        'get_clinic_name',
        'get_mothers_doctor_name',
        'get_mothers_phm_name',
        'get_moh_area',
        'get_created_user',
        'get_mother_name'
    ];
    protected array $beforeUpdate = [];
    protected array $allowedColumns = [
        'user_id',
        'phm_id',
        'doctor_id',
        'clinic_id',
        'moh_area_id',
        'status',
        'maritalStatus',
        'marriageDate',
        'bloodGroup',
        'occupation',
        'gps_location',
        'allergies',
        'consanguinity',
        'history_of_infertility',
        'hypertension',
        'diabetes_mellitus',
        'rubella_immunization',
        'emergency_no',
        'created_user_id',
        'created_at'
    ];

    public function validate($data)
    {
        $this->errors = [];
        $user = new User_model();
        $mother = new Mother_model();
        $mothers_user_id=null;
        //check user nic
        if(empty($data['nic'])){
            $this->errors['nic'] = "Please enter NIC No. of the mother";
        }else {
            $row=$user->where(['nic' => $data['nic']]);
            if (empty($row)) {
                //check whether that user already exists
                $this->errors['nic'] = "User doesn't exist";
            } else {//user exists
                $userData=$row[0];
                if (!empty($mother->where(['user_id' => $userData->id]))) {
                    //check whether that user already exists in the mothers table
                    $this->errors['nic'] = "This user is already a mother";
                }else{
                    $mothers_user_id=$userData->id;
                }

            }
        }
        //check clinic id
        if(empty($data['clinic_id'])){
            $this->errors['clinic_id'] = "Please select clinic id of the mother";
        }else{
            //check whether that clinic already exists
            $clinic = new Clinic_model();
            $row = $clinic->where(['id' => $data['clinic_id']]);
            if(empty($row)){
                $this->errors['clinic_id'] = "That clinic doesn't exist";
            }
        }
        //check PHM id
        if(empty($data['phm_id'])){
            $this->errors['phm_id'] = "Please select PHM of the Mother";
        }else{
            //check whether that PHM already exists
            $PHM = new Midwife_model();
            $row = $PHM->where(['id' => $data['phm_id']]);
            if(empty($row)){
                $this->errors['phm_id'] = "That PHM doesn't exist";
            }
        }
        //check status
        if(empty($data['status'])){
            $this->errors['status'] = "Please select status of the mother";
            //1 = prenatal, 2 = postnatal, 3 = inactive
        }
        //check marital status
        if(empty($data['maritalStatus'])){
            $this->errors['maritalStatus'] = "Please select marital status of the mother";
            // 1 = unmarried (Single Mother), 2 = married, 3 = Divorced
        }
        //check marriage Date
        if(empty($data['marriageDate']) && ($data['maritalStatus'] == 1 || $data['maritalStatus'] == 2)){
            $this->errors['marriageDate'] = "Please select date of marriage";
        }
        //check blood Group
        if(empty($data['bloodGroup'])){
            $this->errors['bloodGroup'] = "Please select blood group";
            // 1 = A RhD positive (A+)
            // 2 = A RhD negative (A-)
            // 3 = B RhD positive (B+)
            // 4 = B RhD negative (B-)
            // 5 = O RhD positive (O+)
            // 6 = O RhD negative (O-)
            // 7 = AB RhD positive (AB+)
            // 8 = AB RhD negative (AB-)
        }
        //check occupation
        if(empty($data['occupation'])){
            $this->errors['occupation'] = "Please enter occupation of mother";
        }
        //check gps location
        if(empty($data['gps_location'])){
            $this->errors['gps_location'] = "Please copy GPS location of mother";
        }

        if(!empty($data['other_allergies'])){
            $_POST['allergies'] =array_merge($_POST['allergies'],explode(",", $data['other_allergies']));
        }

        //check allergies
        if(!empty($data['no_allergies'])){
            $_POST['allergies'] = [];
        }

        // no need to check allergies, since some mothers may not have allergies
        // no need to check consanguinity, since some mothers may not have consanguinity
        // no need to check history_of_infertility, since some mothers may not have history_of_infertility
        // no need to check hypertension, since some mothers may not have hypertension
        // no need to check diabetes_mellitus, since some mothers may not have diabetes_mellitus
        // no need to check rubella_immunization, since some mothers may not have rubella_immunization

        //check emergency_no
        if(empty($data['emergency_no'])){
            $this->errors['emergency_no'] = "Please enter emergency contact number of mother";
        }

        if(empty($this->errors)){
            return $mothers_user_id;
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
        //check status
        if(empty($data['status'])){
            $this->errors['status'] = "Please select status of the mother";
            //1 = prenatal, 2 = postnatal, 3 = inactive
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
    protected function get_mothers_doctor_name($rows)
    {
        $db = new Database();
        if(!empty($rows[0]->clinic_id)){
            foreach ($rows as $key => $row){
                $query = "select users.firstname as firstname, users.lastname as lastname from doctors inner join users on doctors.user_id = users.id inner join clinics on doctors.clinic_id = clinics.id where clinics.id = :id";
                $name = $db->query($query, ['id'=>$row->clinic_id]);


                if(!empty($name)){
                    $name[0]->name = $name[0]->firstname . ' ' . $name[0]->lastname;
                    $rows[$key]->mothers_doctor_name_row = $name[0];
                }else{
                    $nameObj=new stdClass();
                    $nameObj->name='Not Available';
                    $rows[$key]->mothers_doctor_name_row=$nameObj;

                }
            }
        }
        return $rows;
    }
    protected function get_mothers_phm_name($rows)
    {
        $db = new Database();
        if(!empty($rows[0]->phm_id)){
            foreach ($rows as $key => $row){
                $query = "select users.firstname as firstname, users.lastname as lastname from PHM inner join users on PHM.user_id = users.id and PHM.id = :id";
                $name = $db->query($query, ['id'=>$row->phm_id]);
                if(!empty($name)){
                    $name[0]->name = $name[0]->firstname . ' ' . $name[0]->lastname;
                    $rows[$key]->mothers_phm_name_row = $name[0];
                }
            }
        }
        return $rows;
    }
    protected function get_moh_area($rows)
    {
        $db = new Database();
        if(!empty($rows[0]->clinic_id)){
            foreach ($rows as $key => $row){
                $query = "select MOH_areas.area as area from MOH_areas inner join clinics on clinics.moh_area_id = MOH_areas.id where clinics.id = :id";
                $name = $db->query($query, ['id'=>$row->clinic_id]);


                if(!empty($name)){
                    $rows[$key]->moh_area_row = $name[0];
                }else{
                    $nameObj=new stdClass();
                    $nameObj->name='Not Available';
                    $rows[$key]->moh_area_row=$nameObj;

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
    protected function get_mother_name($rows)
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

}



