<?php
//Home class
class Home extends Controller
{
    public function index(): void
    {
        $db = new Database();
        $db->create_tables();

        $data['title'] = "Home";
        $this->view('home', $data);
    }
}