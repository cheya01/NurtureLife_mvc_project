<?php

// 404 class page not found
class _404 extends Controller
{
    public function index(): void
    {
        $data['title'] = "404";
        $this->view('404', $data);
    }
}