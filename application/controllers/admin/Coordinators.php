<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Coordinators extends MY_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('admin/coordinator_model', 'coordinator_model');
        }

        public function index()
        {
            $data['all_coordinators'] =  $this->coordinator_model->get_all_coordinators();
            $data['title'] = 'Coordinator List';
            $data['view'] = 'admin/coordinators/coordinator_list';
            $this->load->view('admin/layout', $data);
        }

        public function add() {
            if($this->input->post('submit')) {
                $this->form_validation->set_rules('name', 'Coordinator Name', 'trim|min_length[5]|required');
                $this->form_validation->set_rules('address', 'Address', 'trim|required');
                $this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');
                $this->form_validation->set_rules('distributor', 'Distributor', 'trim|required');

                if ($this->form_validation->run() == FALSE ) {
                    $data['distributor_groups'] = $this->coordinator_model->get_distributor_groups();
                    $data['title'] = 'Add Coordinator';
                    $data['view'] = 'admin/coordinators/coordinator_add';
                    $this->load->view('admin/layout', $data);
                } else {
                    $data = array(
                        'name' => $this->input->post('name'),
                        'address' => $this->input->post('address'),
                        'mobile' => $this->input->post('mobile_no'),
                        'distributor_id' => $this->input->post('distributor'),
                    );
                    $data = $this->security->xss_clean($data);
                    $result = $this->coordinator_model->add_coordinator($data);
                    if($result){
                        $this->session->set_flashdata('msg', 'Coordinator has been Added Successfully!');
                        redirect(base_url('admin/coordinators'));
                    }
                }
            } else {
                $data['distributor_groups'] = $this->coordinator_model->get_distributor_groups();
                $data['title'] = 'Add Coordinator';
                $data['view'] = 'admin/coordinators/coordinator_add';
                $this->load->view('admin/layout', $data);
            }
        }

        public function edit($id = 0) {
            if($this->input->post('submit')) {
                $this->form_validation->set_rules('name', 'Coordinator Name', 'trim|required');
                $this->form_validation->set_rules('address', 'Address', 'trim|required');
                $this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required');
                $this->form_validation->set_rules('distributor', 'Distributor', 'trim|required');

                if ($this->form_validation->run() == FALSE) {
                    $data['coordinator'] = $this->coordinator_model->get_coordinator_by_id($id);
                    $data['distributor_groups'] = $this->coordinator_model->get_distributor_groups();
                    $data['title'] = 'Edit Coordinator';
                    $data['view'] = 'admin/coordinators/coordinator_edit';
                    $this->load->view('admin/layout', $data);
                }
                else{
                    $data = array(
                        'name' => $this->input->post('name'),
                        'address' => $this->input->post('address'),
                        'mobile' => $this->input->post('mobile_no'),
                        'distributor_id' => $this->input->post('distributor'),
                    );
                    $data = $this->security->xss_clean($data);
                    $result = $this->coordinator_model->edit_coordinator($data, $id);
                    if($result){
                        $this->session->set_flashdata('msg', 'Coordinator has been Updated Successfully!');
                        redirect(base_url('admin/coordinators'));
                    }
                }
            } else {
                $data['coordinator'] = $this->coordinator_model->get_coordinator_by_id($id);
                $data['distributor_groups'] = $this->coordinator_model->get_distributor_groups();
                $data['title'] = 'Edit Coordinator';
                $data['view'] = 'admin/coordinators/coordinator_edit';
                $this->load->view('admin/layout', $data);
            }
        }

        public function del($id = 0) {
            $this->db->delete('coordinators', array('id' => $id));
            $this->session->set_flashdata('msg', 'Coordinator has been Deleted Successfully!');
            redirect(base_url('admin/coordinators'));
        }

        public function create_coordinators_pdf() {
            $this->load->helper('pdf_helper'); // loaded pdf helper
            $data['all_coordinators'] = $this->coordinator_model->get_all_coordinators();
            $this->load->view('admin/coordinators/coordinators_pdf', $data);
        }

        public function export_csv() {
            // file name
            $filename = 'coordinators_'.date('Y-m-d').'.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$filename");
            header("Content-Type: application/csv; ");

            // get data
            $coordinator_data = $this->coordinator_model->get_all_coordinators_for_csv();

            // file creation
            $file = fopen('php://output', 'w');

            $header = array("ID", "Coordinator Name", "Address", "Mobile Number", "Unpaid", "Paid", "Distributed ID");
            fputcsv($file, $header);
            foreach ($coordinator_data as $key=>$line){
                fputcsv($file,$line);
            }
            fclose($file);
            exit;
        }
    }
?>