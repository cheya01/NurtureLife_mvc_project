<?php
//admin class
class Admin extends Controller
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
    public function clinics($action = null, $id = null): void{
        if(!Auth::logged_in()){
            message('Please login');
            redirect('login');
        }
        $created_user_id = Auth::getID();
        $clinic = new Clinic_model();
        $data = [];
        $data['action'] = $action;
        $data['id'] = $id;

        if(!empty($action)) {
            if ($action == 'add') {
                $clinic_types = new Clinic_types_model();
                $moh_areas = new MOH_areas_model();

                $data['clinic_types'] = $clinic_types->findAll('asc');
                $data['moh_areas'] = $moh_areas->findAll('asc', 'area');

                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    if ($clinic->validate($_POST)) {
                        $_POST['created_at'] = date("Y-m-d H:i:s");
                        $_POST['created_user_id'] = $created_user_id;

                        $clinic->insert($_POST);

                        $row = $clinic->first(['created_user_id' => $created_user_id]);
                        message("New clinic created successfully");
                        if ($row) {
                            redirect('admin/clinics/edit/' . $row->id);
                        } else {
                            redirect('admin/clinics');
                        }

                    }
                    $data['errors'] = $clinic->errors;
                }

            } elseif ($action == 'edit') {
                $clinic_types = new Clinic_types_model();
                $moh_areas = new MOH_areas_model();

                $data['clinic_types'] = $clinic_types->findAll('asc');
                $data['moh_areas'] = $moh_areas->findAll('asc', 'area');
                //get clinic information
                $data['row'] = $row = $clinic->first(['id' => $id]);
                if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
                    if ($clinic->edit_validate($_POST, $id)) {
                        $clinic->update($id, $_POST);
                        message("Clinic details saved successfully");
                        redirect('admin/clinics');
                    }
                }
            } elseif ($action == 'delete') {

                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    if (!empty($_POST["clinic_id"])) {
                        $clinic->delete($_POST["clinic_id"]);
                        message("Clinic deleted successfully");
                        redirect('admin/clinics');
                    }
                }
            } elseif ($action == 'addPHM') {
                    $midwife =  new Midwife_model();

                $clinic_names = new Clinic_model();
                $moh_areas = new MOH_areas_model();

                $data['clinic_names'] = $clinic_names->where(['id'=>$id]);
                $data['moh_areas'] = $moh_areas->query("SELECT MOH_areas.id as id, MOH_areas.area as area FROM MOH_areas INNER JOIN clinics ON clinics.moh_area_id=MOH_areas.id WHERE clinics.id=:id",['id'=>$id]);
                $data['clinic_midwives'] = $midwife->where(['clinic_id'=>$id]);
                $data['fromClinic'] = $data['clinic_names'][0]->name;
                    if($_SERVER['REQUEST_METHOD'] == "POST"){
                        if($user_id=$midwife->validate_PHM_from_clinic($_POST)){
                            $_POST['user_id'] = $user_id;
                            $_POST['created_at'] = date("Y-m-d H:i:s");
                            $_POST['created_user_id'] = $created_user_id;
                            $user = new User_model();

                            $user->update($_POST['user_id'],['role_id'=>5]);
                            $moh_area_id=$clinic->query("SELECT moh_area_id from clinics where id=:id",['id'=>$id])[0]->moh_area_id;
                            $_POST['moh_area_id'] = $moh_area_id;
                            $_POST['clinic_id'] = $id;
                            $midwife->insert($_POST);

                            message("New PHM created successfully");
                                redirect('admin/clinics/addPHM/'.$id);

                        }
                        $data['errors'] = $midwife->errors;
                    }
                $data['action']='add';
                $data['lock_clinic']=$id;
                $data['lock_moh']=$data['moh_areas'][0]->id;
                $this->view('admin/midwives', $data);
                return;

            }elseif($action == 'deletePHM'){

                if($_SERVER['REQUEST_METHOD'] == "POST"){
                    if(!empty($_POST["PHM_id"])){
                        $user=new User_model();
                        $midwife=new Midwife_model();
                        $user->query("update users set role_id=1 where id=(select user_id from PHM where id=:id)",['id'=>$_POST["PHM_id"]]);
                        $midwife->delete($_POST["PHM_id"]);
                        message("Midwife deleted successfully");
                        redirect('admin/clinics/addPHM/'.$id);
                    }
                }
            }
        }else{
            //clinics view
            $data['rows'] = $clinic->findAll();
        }
        $this->view('admin/clinics', $data);
    }
    public function doctors($action = null, $id = null): void{
        if(!Auth::logged_in()){
            message('Please login');
            redirect('login');
        }
        $created_user_id = Auth::getID();
        $doctor = new Doctor_model();
        $data = [];
        $data['action'] = $action;
        $data['id'] = $id;


        if($action == 'add'){
            $clinic_names = new Clinic_model();
            $moh_areas = new MOH_areas_model();
            $doctor_specials = new Doctor_specials_model();

            $data['clinic_names'] = $clinic_names->findAll('asc');
            $data['moh_areas'] = $moh_areas->findAll('asc', 'area');
            $data['doctor_specials'] = $doctor_specials->findAll('asc');

            if($_SERVER['REQUEST_METHOD'] == "POST"){
                if($doctor->validate($_POST)){
                    $_POST['created_at'] = date("Y-m-d H:i:s");
                    $_POST['created_user_id'] = $created_user_id;
                    $user = new User_model();
                    $user->update($_POST['user_id'],['role_id'=>3]);
                    $doctor->insert($_POST);

                    $row = $doctor->first(['created_user_id' =>$created_user_id]);
                    message("New Doctor created successfully");
                    if($row){
                        redirect('admin/doctors/edit/'.$row->id);
                    }else{
                        redirect('admin/doctors');
                    }

                }
                $data['errors'] = $doctor->errors;
            }

        }
        elseif($action == 'edit'){
            $clinic_names = new Clinic_model();
            $moh_areas = new MOH_areas_model();
            $doctor_specials = new Doctor_specials_model();

            $data['clinic_names'] = $clinic_names->findAll('asc');
            $data['moh_areas'] = $moh_areas->findAll('asc', 'area');
            $data['doctor_specials'] = $doctor_specials->findAll('asc');

            //get doctor information
            $data['row'] = $row =  $doctor->first(['id'=>$id]);
            if($_SERVER['REQUEST_METHOD'] == "POST" && $row){
                if($doctor->edit_validate($_POST, $id)){
                    $user = new User_model();
                    $user->update($row->name_row->id, $_POST);
                    $doctor->update($row->id, $_POST);
                    message("Doctor details saved successfully");
                    redirect('admin/doctors');
                }

            }
        }
        elseif($action == 'delete'){

            if($_SERVER['REQUEST_METHOD'] == "POST"){
                if(!empty($_POST["doctor_id"])){
                    $user=new User_model();
                    $user->query("update users set role_id=1 where id=(select user_id from doctors where id=:id)",['id'=>$_POST["doctor_id"]]);
                    $doctor->delete($_POST["doctor_id"]);
                    message("Doctor deleted successfully");
                    redirect('admin/doctors');
                }
            }
        }
        else{
            //doctors view
            $data['rows'] = $doctor->findAll();
        }
        $this->view('admin/doctors', $data);
    }
    public function midwives($action = null, $id = null): void{
        if(!Auth::logged_in()){
            message('Please login');
            redirect('login');
        }
        $created_user_id = Auth::getID();
        $midwife = new Midwife_model();
        $data = [];
        $data['action'] = $action;
        $data['id'] = $id;


        if($action == 'add'){
            $clinic_names = new Clinic_model();
            $moh_areas = new MOH_areas_model();

            $data['clinic_names'] = $clinic_names->findAll('asc');
            $data['moh_areas'] = $moh_areas->findAll('asc', 'area');

            if($_SERVER['REQUEST_METHOD'] == "POST"){
                if($user_id=$midwife->validate($_POST)){
                    $_POST['created_at'] = date("Y-m-d H:i:s");
                    $_POST['created_user_id'] = $created_user_id;
                    $_POST['user_id'] = $user_id;
                    $user = new User_model();
                    $user->update($_POST['user_id'],['role_id'=>5]);
                    $midwife->insert($_POST);

                    $row = $midwife->first(['created_user_id' =>$created_user_id]);
                    message("New PHM created successfully");
                    if($row){
                        redirect('admin/midwives/edit/'.$row->id);
                    }else{
                        redirect('admin/midwives');
                    }

                }
                $data['errors'] = $midwife->errors;
            }

        }
        elseif($action == 'edit'){
            $clinic_names = new Clinic_model();
            $moh_areas = new MOH_areas_model();
            $data['clinic_names'] = $clinic_names->findAll('asc');
            $data['moh_areas'] = $moh_areas->findAll('asc');
            //get midwife information
            $data['row'] = $row =  $midwife->first(['id'=>$id]);
            if($_SERVER['REQUEST_METHOD'] == "POST" && $row){
                if($midwife->edit_validate($_POST, $id)){
                    //show($row);die;
                    $user = new User_model();
                    $user->update($row->name_row->id, $_POST);
                    $midwife->update($row->id, $_POST);
                    message("PHM details saved successfully");
                    redirect('admin/midwives');
                }
                //show($midwife->errors);die;

            }
        }
        elseif($action == 'delete'){

            if($_SERVER['REQUEST_METHOD'] == "POST"){
                if(!empty($_POST["PHM_id"])){
                    $user=new User_model();
                    $user->query("update users set role_id=1 where id=(select user_id from PHM where id=:id)",['id'=>$_POST["PHM_id"]]);
                    $midwife->delete($_POST["PHM_id"]);
                    message("Midwife deleted successfully");
                    redirect('admin/midwives');
                }
            }
        }elseif ($action == 'addMother') {
            $mother =  new Mother_model();
            $clinic_names = new Clinic_model();
            $midwife = new Midwife_model();

            $data['phm_names'] = $midwife->query("select users.firstname as firstname, users.lastname as lastname, PHM.id as id , PHM.clinic_id as clinic_id from PHM inner join users on PHM.user_id = users.id where PHM.id=:id  order by users.firstname asc ",['id'=>$id]);
            $data['clinic_names'] = $clinic_names->where(['id'=>$data['phm_names'][0]->clinic_id]);
            $data['PHM_mothers'] = $mother->where(['phm_id'=>$id]);
            $data['fromPHM'] = $data['phm_names'][0]->firstname.' '.$data['phm_names'][0]->lastname;
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $_POST['phm_id']=$id;
                $_POST['clinic_id']=$data['phm_names'][0]->clinic_id;
                if($user_id=$mother->validate($_POST)){

                    $_POST['created_at'] = date("Y-m-d H:i:s");
                    $_POST['created_user_id'] = $created_user_id;
                    $_POST['user_id']=$user_id;

                    $user = new User_model();

                    $user->update($_POST['nic'],['role_id'=>4],'nic');

                    $_POST['allergies']=json_encode($_POST['allergies']);
                    $mother->insert($_POST);

                    message("New Mother created successfully");
                        redirect('admin/midwives/addMother/'.$id);


                }

                $data['errors'] = $midwife->errors;
            }
            $data['action']='add';
            $data['lock_clinic']=$data['phm_names'][0]->clinic_id;
            $data['lock_phm']=$id;
            $this->view('admin/mothers', $data);
            return;

        }elseif($action == 'deleteMother'){
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                if(!empty($_POST["PHM_id"])){
                    $user=new User_model();
                    $midwife=new Midwife_model();
                    $user->query("update users set role_id=1 where id=(select user_id from PHM where id=:id)",['id'=>$_POST["PHM_id"]]);
                    $midwife->delete($_POST["PHM_id"]);
                    message("Midwife deleted successfully");
                    redirect('admin/clinics/addPHM/'.$id);
                }
            }
        }
        else{
            //midwives view
            $data['rows'] = $midwife->findAll();
        }
        $this->view('admin/midwives', $data);
    }

    public function all_users($action = null, $id = null): void{
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
    public function mothers($action = null, $id = null): void{
        if(!Auth::logged_in()){
            message('Please login');
            redirect('login');
        }
        $mother = new Mother_model();
        $data = [];
        $data['action'] = $action;
        $data['id'] = $id;


        if($action == 'add'){
            $created_user_id = Auth::getID();
            $clinic_names = new Clinic_model();
            $moh_areas = new MOH_areas_model();
            $phm_names = new Midwife_model();
            $doctor_names = new Doctor_model();
            $db = new Database();

            $data['clinic_names'] = $clinic_names->findAll('asc', 'name');
//            $data['moh_areas'] = $moh_areas->findAll('asc', 'area');
            $data['phm_names'] = $phm_names->query("select users.firstname as firstname, users.lastname as lastname, PHM.id as id from PHM inner join users on PHM.user_id = users.id order by users.firstname asc ");
//            $data['doctor_names'] = $doctor_names->query("select users.firstname as firstname, users.lastname as lastname, doctors.id from doctors inner join users on doctors.user_id = users.id order by users.firstname asc");

            if($_SERVER['REQUEST_METHOD'] == "POST"){
                if($user_id=$mother->validate($_POST)){
                    $_POST['created_at'] = date("Y-m-d H:i:s");
                    $_POST['created_user_id'] = $created_user_id;
                    $_POST['user_id']=$user_id;
                    $user = new User_model();

                    $user->update($_POST['nic'],['role_id'=>4],'nic');

                    $_POST['allergies']=json_encode($_POST['allergies']);
                    $mother->insert($_POST);

                    $row = $mother->first(['user_id' =>$user_id]);
                    message("New Mother created successfully");
                    if($row){
                        redirect('admin/mothers/edit/'.$row->id);
                    }else{
                        redirect('admin/mothers');
                    }

                }
                $data['errors'] = $mother->errors;
            }

        }
        elseif($action == 'edit'){
            $clinic_names = new Clinic_model();
            $moh_areas = new MOH_areas_model();

            $data['clinic_names'] = $clinic_names->findAll('asc');
            $data['moh_areas'] = $moh_areas->findAll('asc', 'area');

            //get mother information
            $data['row'] = $row =  $mother->first(['id'=>$id]);
            if($_SERVER['REQUEST_METHOD'] == "POST" && $row){
                if($mother->edit_validate($_POST, $id)){
                    $user = new User_model();
                    $user->update($row->name_row->id, $_POST);
                    $mother->update($row->id, $_POST);
                    message("Mother details saved successfully");
                    redirect('admin/mothers');
                }

            }
        }
        elseif($action == 'delete'){

            if($_SERVER['REQUEST_METHOD'] == "POST"){
                if(!empty($_POST["mother_id"])){
                    $user=new User_model();
                    $user->query("update users set role_id=1 where id=(select user_id from mothers where id=:id)",['id'=>$_POST["mother_id"]]);
                    $mother->delete($_POST["mother_id"]);
                    message("Mother deleted successfully");
                    redirect('admin/mothers');
                }
            }
        }
        else{
            //mothers view
            $data['rows'] = $mother->findAll();
        }
        $this->view('admin/mothers', $data);
    }

//    public function child($action = null, $id = null): void{
//        if(!Auth::logged_in()){
//            message('Please login');
//            redirect('login');
//        }
//        $created_user_id = Auth::getID();
//        $child = new Child_model();
//        $data = [];
//        $data['action'] = $action;
//        $data['id'] = $id;
//
//
//        if($action == 'add'){
//            $db = new Database();
//            if($_SERVER['REQUEST_METHOD'] == "POST"){
//                //show($_POST);
//                if($user_id=$child->validate($_POST)){
//                    $_POST['created_at'] = date("Y-m-d H:i:s");
//                    $_POST['created_user_id'] = $created_user_id;
//                    $_POST['user_id']=$user_id;
//                    $user = new User_model();
//
//                    $user->update($_POST['nic'],['role_id'=>4],'nic');
//                    $mother->insert($_POST);
//
//                    $row = $mother->first(['user_id' =>$user_id]);
//                    message("New Mother created successfully");
//                    if($row){
//                        redirect('admin/mothers/edit/'.$row->id);
//                    }else{
//                        redirect('admin/mothers');
//                    }
//
//                }
//                $data['errors'] = $mother->errors;
//            }
//
//        }
//        elseif($action == 'edit'){
//            $clinic_names = new Clinic_model();
//            $moh_areas = new MOH_areas_model();
//
//            $data['clinic_names'] = $clinic_names->findAll('asc');
//            $data['moh_areas'] = $moh_areas->findAll('asc', 'area');
//
//            //get doctor information
//            $data['row'] = $row =  $mother->first(['id'=>$id]);
//            if($_SERVER['REQUEST_METHOD'] == "POST" && $row){
//                if($mother->edit_validate($_POST, $id)){
//                    $user = new User_model();
//                    $user->update($row->name_row->id, $_POST);
//                    $mother->update($row->id, $_POST);
//                    message("Mother details saved successfully");
//                    redirect('admin/mothers');
//                }
//
//            }
//        }
//        elseif($action == 'delete'){
//
//            if($_SERVER['REQUEST_METHOD'] == "POST"){
//                if(!empty($_POST["mother_id"])){
//                    $mother->delete($_POST["mother_id"]);
//                    message("Mother deleted successfully");
//                    redirect('admin/mothers');
//                }
//            }
//        }
//        else{
//            //mothers view
//            $data['rows'] = $mother->findAll();
//        }
//        $this->view('admin/mothers', $data);
//    }
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

