<?php
//signup class
class Login extends Controller
{
    public function index(): void
    {
        $data['errors'] = [];
        $data['title'] = "Login";
        $user = new User_model();

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $query = "SELECT *,roles.id as role_id,users.id as id FROM users INNER JOIN roles ON roles.id=users.role_id WHERE email=:email";
            //validate
//            $row = $user->first([
//                'email' => $_POST['email'],
//            ]);
            $row=$user->query($query,['email'=>$_POST['email']])[0];
            if($row){
                if(password_verify($_POST['password'], $row->password)){
                    //authenticate
                    Auth::authenticate($row);
                    redirect('home');
                }
            }
            $data['errors']['email'] = "Wrong email or Password";
        }
        $this->view('login', $data);
    }
}