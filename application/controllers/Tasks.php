<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks extends CI_Controller {

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
    
		$this->load->view('tasks/index');
	}

    public function load_task_json(){
        $data["tasks"] = $this->task->get_all_task();
        $data["in_progress_task"] = $this->task->get_all_in_progress_task();
        $data["done_task"] = $this->task->get_all_done_task();
        echo json_encode($data);
    }

	public function add_task(){
		// $data["task"] = $this->input->post("task",TRUE);
        $task_detail = array(
            "task" => $this->input->post("task",TRUE),
        );

        $this->task->add_task($task_detail);
        $data["tasks"] = $this->task->get_all_task();
        $data["in_progress_task"] = $this->task->get_all_in_progress_task();
        $data["done_task"] = $this->task->get_all_done_task();
		echo json_encode($data);
	}

    public function update_task_title(){
        $task_detail = array(
            "task" => $this->input->post("task",TRUE),
            "task_id" => $this->input->post("task_id",TRUE),
        );
        $this->task->update_task_title($task_detail);
        $data["tasks"] = $this->task->get_all_task();
        $data["in_progress_task"] = $this->task->get_all_in_progress_task();
        $data["done_task"] = $this->task->get_all_done_task();
        
        echo json_encode($data);
    }

    public function update_task_status(){
        $is_done = $this->input->post("done",TRUE);
        if($is_done == "on"){
            $task_detail = array(
                "task_id" => $this->input->post("task_id",TRUE),
                "status" => 1
            );
        }else{
            $task_detail = array(
                "task_id" => $this->input->post("task_id",TRUE),
                "status" => 0,
            );
        }

        $this->task->update_task_status($task_detail);
        $data["tasks"] = $this->task->get_all_task();
        $data["in_progress_task"] = $this->task->get_all_in_progress_task();
        $data["done_task"] = $this->task->get_all_done_task();
        echo json_encode($data);
    }
}
