<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Access_Control extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){	
       
		$this->load->view('access_control/index');
	}

    public function get_movie_view(){
        $this->load->view('access_control/get_movie');
    }

	public function get_movie(){
        $artist = str_replace(' ', '', $this->input->post('user_input'));
        $url = "https://itunes.apple.com/search?term=".$artist."&entity=musicVideo";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $data = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        echo $data;
        echo json_encode($data);
	}

    public function calling_library(){
        $this->load->library("someclass");
        echo "calling library";
        $this->someclass->some_method();
    }
}
