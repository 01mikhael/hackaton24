<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        
    }

    // Function to insert a task into the database and return the ID
    public function insert_task($data) {
        $this->db->insert('tasks', $data);
        return $this->db->insert_id(); // Returns the ID of the inserted row
    }

    public function get_task($task_id) {
        $query = $this->db->get_where('tasks', ['id' => $task_id]);
        return $query->row_array(); // Return task as an associative array
    }
}
