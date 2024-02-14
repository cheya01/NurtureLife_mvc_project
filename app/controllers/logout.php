<?php
//logout class
class Logout extends Controller
{
    public function index(): void
    {
        Auth::logout();
        redirect('home');
    }
}