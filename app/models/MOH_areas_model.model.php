<?php
//MOH_areas class
class MOH_areas_model extends Model
{
    public array $errors = [];
    protected string $table = "MOH_areas";
    protected $primaryKey = 'id';
    protected array $allowedColumns = [
        'area'
    ];

    public function validate($data): bool
    {
        //check MOH area
        $this->errors = [];
        if(empty($data['area'])){
            $this->errors['area'] = "MOH area is required";
        }else if(!preg_match("/^[a-zA-Z0-9\s]+$/", trim($data['area']))){
            $this->errors['area'] = "MOH area can have only have letters, spaces and numbers";
        }
        if(empty($this->errors)){
            return true;
        }
        return false;
    }

}