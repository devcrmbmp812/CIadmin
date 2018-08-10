<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Agents extends MY_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('admin/agent_model', 'agent_model');
        }

        public function index()
        {
            $data['all_agents'] =  $this->agent_model->get_all_agents();
            $data['title'] = 'Agent List';
            $data['view'] = 'admin/agents/agent_list1';
            $this->load->view('admin/layout', $data);
        }

        public function add() {
            if($this->input->post('submit')) {
                $this->form_validation->set_rules('name', 'Agent Name', 'trim|required');
                $this->form_validation->set_rules('address', 'Address', 'trim|required');
                $this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');
                $this->form_validation->set_rules('limit', 'Limit', 'trim|required');
                $this->form_validation->set_rules('coordinator', 'Coordinator', 'trim|required');

                if ($this->form_validation->run() == FALSE ) {
                    $data['coordinator_groups'] = $this->agent_model->get_coordinator_groups();
                    $data['title'] = 'Add Agent';
                    $data['view'] = 'admin/agents/agent_add';
                    $this->load->view('admin/layout', $data);
                } else {
                    $data = array(
                        'name' => $this->input->post('name'),
                        'address' => $this->input->post('address'),
                        'mobile' => $this->input->post('mobile_no'),
                        'limit' => $this->input->post('limit'),
                        'coordinator_id' => $this->input->post('coordinator'),
                    );
                    $data = $this->security->xss_clean($data);
                    $result = $this->agent_model->add_agent($data);
                    if($result){
                        $this->session->set_flashdata('msg', 'Agent has been Added Successfully!');
                        redirect(base_url('admin/agents'));
                    }
                }
            } else {
                $data['coordinator_groups'] = $this->agent_model->get_coordinator_groups();
                $data['title'] = 'Add Agent';
                $data['view'] = 'admin/agents/agent_add';
                $this->load->view('admin/layout', $data);
            }
        }

        public function edit($id = 0) {
            if($this->input->post('submit')) {
                $this->form_validation->set_rules('name', 'Admin Name', 'trim|required');
                $this->form_validation->set_rules('address', 'Address', 'trim|required');
                $this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required');
                $this->form_validation->set_rules('limit', 'Limit', 'trim|required');
                $this->form_validation->set_rules('coordinator', 'Coordinator', 'trim|required');

                if ($this->form_validation->run() == FALSE) {
                    $data['agent'] = $this->agent_model->get_agent_by_id($id);
                    $data['coordinator_groups'] = $this->agent_model->get_coordinator_groups();
                    $data['title'] = 'Edit Agent';
                    $data['view'] = 'admin/agents/agent_edit';
                    $this->load->view('admin/layout', $data);
                }
                else{
                    $data = array(
                        'name' => $this->input->post('name'),
                        'address' => $this->input->post('address'),
                        'mobile' => $this->input->post('mobile_no'),
                        'limit' => $this->input->post('limit'),
                        'coordinator_id' => $this->input->post('coordinator'),
                    );
                    $data = $this->security->xss_clean($data);
                    $result = $this->agent_model->edit_agent($data, $id);
                    if($result){
                        $this->session->set_flashdata('msg', 'Agent has been Updated Successfully!');
                        redirect(base_url('admin/agents'));
                    }
                }
            } else {
                $data['agent'] = $this->agent_model->get_agent_by_id($id);
                $data['coordinator_groups'] = $this->agent_model->get_coordinator_groups();
                $data['title'] = 'Edit Agent';
                $data['view'] = 'admin/agents/agent_edit';
                $this->load->view('admin/layout', $data);
            }
        }

        public function del($id = 0) {
            $this->db->delete('agents', array('id' => $id));
            $this->session->set_flashdata('msg', 'Admin has been Deleted Successfully!');
            redirect(base_url('admin/agents'));
        }

        public function create_agents_pdf() {
            $this->load->helper('pdf_helper'); // loaded pdf helper
            $data['all_agents'] = $this->agent_model->get_all_agents();
            $this->load->view('admin/agents/agents_pdf', $data);
        }

        public function export_csv() {
            // file name
            $filename = 'agents_'.date('Y-m-d').'.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$filename");
            header("Content-Type: application/csv; ");

            // get data
            $agent_data = $this->agent_model->get_all_agents_for_csv();

            // file creation
            $file = fopen('php://output', 'w');

            $header = array("ID", "Agent Name", "Address", "Mobile Number", "Unpaid", "Paid", "Coordinator ID");
            fputcsv($file, $header);
            foreach ($agent_data as $key=>$line){
                fputcsv($file,$line);
            }
            fclose($file);
            exit;
        }
    }
?>