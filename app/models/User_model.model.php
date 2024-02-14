<?php
//user class
class User_model extends Model
{
    public array $errors = [];
    public array $NIC_extract = [];
    protected string $table = "users";
    protected $primaryKey = 'id';
    protected array $allowedColumns = [
        'id',
        'email',
        'firstname',
        'lastname',
        'nic',
        'status',
        'password',
        'contact_no',
        'dob',
        'gender',
        'role_id'
    ];

    /**
     * @throws Exception
     */
    public function validate($data): bool
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

        // check email
        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            $this->errors['email'] = "Invalid Email address";
        }else
        if($this->where(['email' => $data['email']])){
            $this->errors['email'] = "The entered email already exists";
        }

        //check NIC
        if(empty($data['nic'])){
            $this->errors['nic'] = "Please enter NIC number";
        }else if($this->where(['nic' => $data['nic']])){
            $this->errors['nic'] = "Entered NIC number already exists";
        }else if(strlen($data['nic']) == 10 || strlen($data['nic']) == 12){
            // Extract information from old/new NIC
            $NIC_extract = $this->extractFromNic($data['nic']);
        }
        else{
            $this->errors['nic'] = "Invalid NIC number";
        }

        //check user age
        $currentDate = new DateTime();
        $dobDate = new DateTime($NIC_extract['dob']);
        $age = $currentDate->diff($dobDate)->y;
        if ($age < 18) {
            // User is under 18 years old
            $this->errors['nic'] = "You must be 18 years or older to signup for NurtureLife.";
        }else{
            // Set $_POST['gender'] and $_POST['dob']
            $_POST['gender'] = $NIC_extract['gender'];
            $_POST['dob'] = $NIC_extract['dob'];
        }

        //check contact number
        if(empty($data['contact_no'])){
            $this->errors['contact_no'] = "Please enter a contact number";
        }else if (strlen($data['contact_no']) < 10) {
            $this->errors['contact_no'] = "Contact number must be 10 characters long";
        }

        //check password
        if(empty($data['password'])){
            $this->errors['password'] = "Please enter a password";
        }else if (strlen($data['password']) < 8 || strlen($data['password']) > 14) {
            $this->errors['password'] = "Password must be between 8 to 14 characters long";
        }
        //check whether password == confirm_password
        if($data['password'] !== $data['confirm_password']){
            $this->errors['password'] = "Passwords do not match";
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

        // check email
        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            $this->errors['email'] = "Invalid Email address";
        }else
            if($results = $this->where(['email' => $data['email']])){
                foreach ($results as $result) {
                    if($id != $result->id){
                        $this->errors['email'] = "email already exists";
                    }
                }
            }

        //check contact number
        if(empty($data['contact_no'])){
            $this->errors['contact_no'] = "Please enter a contact number";
        }else {
            if (strlen($data['contact_no']) < 10) {
                $this->errors['contact_no'] = "Min length of Contact number is 10";
            }else if(!preg_match("/^(07|\+947)[0-9]{8}$/", trim($data['contact_no']))){
                $this->errors['contact_no'] = "Invalid Contact number";
            }
        }
        if(empty($this->errors)){
            return true;
        }
        return false;
    }

}