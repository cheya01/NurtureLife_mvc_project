<?php
//clinic class
class Clinic_model extends Model
{
    public array $errors = [];
    protected string $table = "clinics";
    protected string $primaryKey = 'id';
    protected array $afterSelect = [
        'get_clinic_type',
        'get_moh_area',
        'get_created_user'
    ];
    protected array $beforeUpdate = [];
    protected array $allowedColumns = [
        'id',
        'name',
        'address',
        'contact_no',
        'capacity',
        'gps_location',
        'type_id',
        'moh_area_id',
        'created_user_id',
        'created_at',
        'active'
    ];

    public function validate($data): bool
    {
        //check clinic name
        $this->errors = [];
        if(empty($data['name'])){
            $this->errors['name'] = "Please enter clinic name";
        }else
            if(!preg_match("/^[a-zA-Z\s,']+$/", trim($data['name']))){
                $this->errors['name'] = "Clinic name can have only letters, spaces, comma, and apostrophe";
            }

        //check clinic address
        if(empty($data['address'])){
            $this->errors['address'] = "Please enter Clinic address";
        }

        //check clinic MOH area
        if(empty($data['moh_area_id'])){
            $this->errors['moh_area_id'] = "Please select MOH area of the clinic";
        }
        //check clinic contact number
        if(empty($data['contact_no'])){
            $this->errors['contact_no'] = "Please enter a contact number";
        }else if (strlen($data['contact_no']) < 10) {
            $this->errors['contact_no'] = "Contact number must be 10 characters long";
        }
        //check clinic capacity
        if(empty($data['capacity'])){
            $this->errors['capacity'] = "Please enter clinic's operational capacity";
        }else
            if($data['capacity'] < 0){
                $this->errors['capacity'] = "Clinic capacity must be a positive number";
            }
        //check clinic gps location link
        if(empty($data['gps_location'])){
            $this->errors['gps_location'] = "Please copy GPS location link of the clinic";
        }
        //check clinic type
        if(empty($data['type_id'])){
            $this->errors['type_id'] = "Please select clinic type";
        }

        if(empty($this->errors)){
            return true;
        }
        return false;
    }

    public function edit_validate($data, $id): bool
    {

        $this->errors = [];

        //check clinic name
        if(empty($data['name'])){
            $this->errors['name'] = "Please enter clinic name";
        }else if(!preg_match("/^[a-zA-Z\s,']+$/", trim($data['name']))){
                $this->errors['name'] = "Clinic name can have only letters, spaces, comma, and apostrophe";
            }

        //check clinic address
        if(empty($data['address'])){
            $this->errors['address'] = "Please enter Clinic address";
        }

        //check clinic gps location link
        if(empty($data['gps_location'])){
            $this->errors['gps_location'] = "Please copy GPS location link of the clinic";
        }
        //check clinic MOH area
        if(empty($data['moh_area_id'])){
            $this->errors['moh_area_id'] = "Please select MOH area of the clinic";
        }
        //check clinic type
        if(empty($data['type_id'])){
            $this->errors['type_id'] = "Please select clinic type";
        }
        //check clinic contact number
        if(empty($data['contact_no'])){
            $this->errors['contact_no'] = "Please enter a contact number";
        }else if (strlen($data['contact_no']) < 10) {
            $this->errors['contact_no'] = "Contact number must be 10 characters long";
        }
        //check clinic capacity
        if(empty($data['capacity'])){
            $this->errors['capacity'] = "Please enter clinic's operational capacity";
        }else if($data['capacity'] < 0){
                $this->errors['capacity'] = "Clinic capacity must be a positive number";
        }

        if(empty($this->errors)){
            return true;
        }
        return false;
    }
    protected function get_clinic_type($rows)
    {
        $db = new Database();
        if(!empty($rows[0]->type_id)){
            foreach ($rows as $key => $row){
                $query = "select * from clinic_types where id = :id limit 1";
                $type = $db->query($query, ['id'=>$row->type_id]);
                if(!empty($type)){
                    $rows[$key]->type_row = $type[0];
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

}