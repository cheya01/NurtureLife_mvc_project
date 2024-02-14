<?php
//admin class
class User extends Controller
{
    public function index(): void
    {
        if(!Auth::logged_in()){
            message('Please login');
            redirect('login');
        }
        $data['title'] = "Dashboard";
        $this->view('user/dashboard', $data);
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
                redirect('user/profile/'.$id);
            }
        }

        $data['title'] = "Profile";
        $data['errors'] = $user->errors;
        $this->view('user/profile', $data);
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

