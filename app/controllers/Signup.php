<?php
//signup class
class Signup extends Controller
{
    public function index(): void
    {
        $data['errors'] = [];
        $user = new User_model();

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            if($user->validate($_POST)){
                $_POST['date'] = date("Y-m-d H:i:s");
                $_POST['role_id'] = 1;
                $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $user->insert($_POST);

                message("Profile creation successful. Please login");
                redirect('login');
            }
        }


        $data['errors'] = $user->errors;

        $data['title'] = "Signup";
        $this->view('signup', $data);
    }
}