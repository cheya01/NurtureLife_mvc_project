<?php

class Child_model extends Model
{
    public array $errors = [];
    protected string $table = "child";
    protected string $primaryKey = 'id';
    protected array $afterSelect = [];
    protected array $beforeUpdate = [];
    protected array $allowedColumns = [
        'phm_id',
        'mother_id',
        'clinic_id',
        'firstname',
        'lastname',
        'dob',
        'blood_group',
        'address',
        'status',
        'gender'
    ];

    public function validate($data): bool{
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
    }


}