<?php
//doctor specials class
class Doctor_specials_model extends Model
{
    public array $errors = [];
    protected string $table = "doctor_specials";
    protected $primaryKey = 'id';
    protected array $allowedColumns = [
        'special'
    ];

    public function validate($data): bool
    {
        //check doctor special
        $this->errors = [];
        if(empty($data['special'])){
            $this->errors['special'] = "Doctor special area is required";
        }
        if(empty($this->errors)){
            return true;
        }
        return false;
    }

}