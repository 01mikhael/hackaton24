<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ScanStatus_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Load the database
    }

    // Function to get all statuses for a specific task
    public function get_statuses_by_task($task_id) {
        $this->db->where('task_id', $task_id);
        $this->db->order_by('created_at', 'ASC'); // Optional: Order statuses by time
        $query = $this->db->get('scan_status');
        return $query->result_array(); // Return statuses as an array
    }
}
