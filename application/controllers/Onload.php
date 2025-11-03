<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Onload extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        ini_set('display_errors', 'off'); //matikan pesan error
    }

    public function index()
    {
        $data['title'] = "#SKAMANDA Medika | Menjalankan Aplikasi..";
        $this->template->load('template/loading', 'welcome', $data);
    }
}
