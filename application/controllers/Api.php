<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('produk_model');
    }

    public function test()
    {
        // Users from a data store e.g. database
        $users = [
            ['id' => 0, 'name' => 'John', 'email' => 'john@example.com'],
            ['id' => 1, 'name' => 'Jim', 'email' => 'jim@example.com'],
            ['id' => 2, 'name' => 'Memek', 'email' => 'rifky@example.com'],
        ];

        $id = $this->get( 'id' );

        if ( $id === null )
        {
            // Check if the users data store contains users
            if ( $users )
            {
                // Set the response and exit
                $this->response( $users, 200 );
            }
            else
            {
                // Set the response and exit
                $this->response( [
                    'status' => false,
                    'message' => 'No users were found'
                ], 404 );
            }
        }
        else
        {
            if ( array_key_exists( $id, $users ) )
            {
                $this->response( $users[$id], 200 );
            }
            else
            {
                $this->response( [
                    'status' => false,
                    'message' => 'No such user found'
                ], 404 );
            }
        }
    }
    public function makanan_get()
    {

        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'GET'){
            json_output(400,array('status' => 400,'message' => 'Bad request.'));
        } else {

            // $check_auth_client = $this->MyModel->check_auth_client();
            $check_auth_client = true;
            if($check_auth_client == true){
                    // $response = $this->MyModel->auth();
                $response = 200;
                    if($response == 200){
                        // print_r("test");exit;
                        $resp = $this->produk_model->book_all_data();
                        // print_r($resp);exit;
                        $this->response( $resp, 200 );
                        // json_output($response['status'],$resp);
                    }
            }
        }
    }

    public function login_post()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            json_output(400,array('status' => 400,'message' => 'Bad request.'));
        } else {
            $check_auth_client = true;
            if($check_auth_client == true){
                $params = json_decode(file_get_contents('php://input'), TRUE);
                    $username = $params['username'];
                    $password = $params['password'];
                
                    $response = $this->MyModel->login($username,$password);
                json_output($response['status'],$response);
            }
        }
    }
}