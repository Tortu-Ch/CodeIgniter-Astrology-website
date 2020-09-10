<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        ob_start();
    }

    public function index()
    {
        $this->load->view('home');
    }

    public function about()
    {
        $this->load->view('about');
    }

    public function app()
    {
        $this->load->view('app');
    }

    public function blog()
    {
        $this->load->view('blog');
    }

    
    public function contacts()
    {
        $this->load->view('contacts');
    }

    public function eclipse()
    {
        $this->load->view('eclipse');
    }

    public function houses()
    {
        $this->load->view('houses');
    }

    public function lunarreturn()
    {
        $this->load->view('lunarreturn');
    }

    public function lunarvoc()
    {
        $this->load->view('lunarvoc');
    }

    public function privacy()
    {
        $this->load->view('privacy');
    }

    public function search_results()
    {
        $this->load->view('search-results');
    }

    public function single_post()
    {
        $this->load->view('single-post');
    }

    public function test()
    { 
        $this->load->view('test');
    }
}
