<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
date_default_timezone_set('Asia/Manila');
class Task extends CI_Model {
   
    function get_all_task(){
        $query = "SELECT * FROM tasks ";
        return $this->db->query($query)->result_array();
    }

    function get_all_in_progress_task(){
        $query = "SELECT * FROM tasks WHERE status = 0";
        return $this->db->query($query)->result_array();
    }

    function get_all_done_task(){
        $query = "SELECT * FROM tasks WHERE status = 1";
        return $this->db->query($query)->result_array();
    }

    function add_task($data){
        //not done = 0, done = 1
        $query = "INSERT INTO tasks(name,status,created_at) VALUES (?,?,?)";
        $values = array($data["task"],0,date("Y-m-d, H:i:s"));
        return $this->db->query($query,$values);
    }

    function update_task($data){
        $query = "UPDATE tasks SET name = ?, status = ?, updated_at = ? WHERE ID = ?";
        $values = array($data["task"],$data["status"],date("Y-m-d, H:i:s"),$data["task_id"]);
        return $this->db->query($query,$values);
    }

    function update_task_title($data){
        $query = "UPDATE tasks SET name = ?,updated_at = ? WHERE ID = ?";
        $values = array($data["task"],date("Y-m-d, H:i:s"),$data["task_id"]);
        return $this->db->query($query,$values);
    }


    function update_task_status($data){
        $query = "UPDATE tasks SET status = ?, updated_at = ? WHERE ID = ?";
        $values = array($data["status"],date("Y-m-d, H:i:s"),$data["task_id"]);
        return $this->db->query($query,$values);
    }

}