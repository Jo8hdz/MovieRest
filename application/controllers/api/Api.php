<?php

use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Api extends REST_Controller{

    public function data_get(){

        $this->load->model('Pelicula');

        /*$data=array(
            'data1' => 1,
            'data2' => 2
        );*/

        $data= $this->Pelicula->findAll();
        $this->response($data);
    }
}