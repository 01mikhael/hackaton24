<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scan extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->database();
		$this->load->library('session');
        $this->load->model('Task_model'); // Load the Task model
		$this->load->model('ScanStatus_model'); // Load the ScanStatus model
		
    }

    public function index() {
        // Load the form view
       redirect(base_url());
    }

    public function start() {
        // Get the URL from the form input
        $url = $this->input->post('url', TRUE);

        if (empty($url)) {
            // Handle error if URL is not provided
            $this->session->set_flashdata('error', 'URL is required');
            redirect(base_url());
        }

        // Insert a new task into the database
        $data = [
            'url' => $url,
            'status' => 'queued'
        ];
        $task_id = $this->Task_model->insert_task($data);

        // Redirect to success or list page
        $this->session->set_flashdata('success', 'Task created successfully!');
        redirect('scan/status/'.$task_id);
    }

	public function status($task_id = null) {
        if (!$task_id) {
            show_404(); // Task ID is required
        }

        // Get task details
        $task = $this->Task_model->get_task($task_id);

        if (!$task) {
            show_404(); // Task not found
        }

        $data['task'] = $task; // Pass task to the view
        $this->load->view('task_status', $data); // Load the status view
    }

    // Function to return statuses via AJAX
    public function get_statuses($task_id = null) {
        if (!$task_id) {
            echo json_encode(['error' => 'Task ID is required']);
            return;
        }

        $statuses = $this->ScanStatus_model->get_statuses_by_task($task_id);

        echo json_encode($statuses); // Return JSON response
    }
}
