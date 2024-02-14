<?php
//clinic_types class
class Clinic_types_model extends Model
{
    public array $errors = [];
    protected string $table = "clinic_types";
    protected $primaryKey = 'id';
    protected array $allowedColumns = [
        'type',
        'active'
    ];

    public function validate($data): bool
    {
        //check clinic type
        $this->errors = [];
        if(empty($data['type'])){
            $this->errors['type'] = "A clinic type is required";
        }else if(!preg_match("/^[a-zA-Z\s]+$/", trim($data['type']))){
            $this->errors['type'] = "Clinic type can only have letters and spaces";
        }
        if(empty($this->errors)){
            return true;
        }
        return false;
    }

}