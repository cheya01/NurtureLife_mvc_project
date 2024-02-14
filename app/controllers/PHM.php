<?php
//PHM(midwife) class
class PHM extends Controller
{
    public function index(): void
    {
        if(!Auth::logged_in()){
            message('Please login');
            redirect('login');
        }
        $data['title'] = "Dashboard";
        $this->view('admin/dashboard', $data);
    }
    public function mothers($action = null, $id = null): void{
        //$created_user_id = new User_model();
        if(!Auth::logged_in()){
            message('Please login');
            redirect('login');
        }
        $user = new User_model();
        $data = [];
        $data['action'] = $action;
        $data['id'] = $id;

        if($action == 'edit'){
            //get User information
            $data['row'] = $row =  $user->first(['id'=>$id]);
            if($_SERVER['REQUEST_METHOD'] == "POST" && $row){
                if($user->edit_validate($_POST, $id)){
                    $user->update($id, $_POST);
                    message("User details saved successfully");
                    redirect('admin/all_users');
                }
            }
        }
        elseif($action == 'delete'){

            if($_SERVER['REQUEST_METHOD'] == "POST"){
                if(!empty($_POST["user_id"])){
                    $user->delete($_POST["user_id"]);
                    message("User deleted successfully");
                    redirect('admin/all_users');
                }
            }
        }
        else{
            //all users view
            $data['rows'] = $user->findAll();
        }
        $this->view('admin/all_users', $data);
    }
    public function profile($id = null): void
    {
        if(!Auth::logged_in()){
            message('Please login');
            redirect('login');
        }
        $id = $id ?? Auth::getId();
        $user = new User_model();
        $data['row'] = $row =  $user->first(['id'=>$id]);
        if($_SERVER['REQUEST_METHOD'] == "POST" && $row){
            if($user->edit_validate($_POST, $id)){
                $user->update($id, $_POST);
                message("Profile saved successfully");
                redirect('admin/profile/'.$id);
            }
        }

        $data['title'] = "Profile";
        $data['errors'] = $user->errors;
        $this->view('admin/profile', $data);
    }
    public function settings(): void
    {
        if(!Auth::logged_in()){
            redirect('login');
        }
        $data['title'] = "Settings";
        $this->view('admin/settings', $data);
    }
}

