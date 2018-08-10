<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Distributors extends MY_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('admin/distributor_model', 'distributor_model');
        }

        public function index()
        {
            $data['all_distributors'] =  $this->distributor_model->get_all_distributors();
            $data['title'] = 'Distributor List';
            $data['view'] = 'admin/distributors/distributor_list';
            $this->load->view('admin/layout', $data);
        }

        public function add() {
            if($this->input->post('submit')) {
                $this->form_validation->set_rules('name', 'Distributor Name', 'trim|required');
                $this->form_validation->set_rules('address', 'Address', 'trim|required');
                $this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');

                if ($this->form_validation->run() == FALSE ) {
                    $data['title'] = 'Add Distributor';
                    $data['view'] = 'admin/distributors/distributor_add';
                    $this->load->view('admin/layout', $data);
                } else {
                    $data = array(
                        'name' => $this->input->post('name'),
                        'address' => $this->input->post('address'),
                        'mobile' => $this->input->post('mobile_no'),
                    );
                    $data = $this->security->xss_clean($data);
                    $result = $this->distributor_model->add_distributor($data);
                    if($result){
                        $this->session->set_flashdata('msg', 'Distributor has been Added Successfully!');
                        redirect(base_url('admin/distributors'));
                    }
                }
            } else {
                $data['title'] = 'Add Distributor';
                $data['view'] = 'admin/distributors/distributor_add';
                $this->load->view('admin/layout', $data);
            }
        }

        public function edit($id = 0) {
            if($this->input->post('submit')) {
                $this->form_validation->set_rules('name', 'Distributor Name', 'trim|required');
                $this->form_validation->set_rules('address', 'Address', 'trim|required');
                $this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required');

                if ($this->form_validation->run() == FALSE) {
                    $data['distributor'] = $this->distributor_model->get_distributor_by_id($id);
                    $data['title'] = 'Edit Distributor';
                    $data['view'] = 'admin/distributors/distributor_edit';
                    $this->load->view('admin/layout', $data);
                }
                else{
                    $data = array(
                        'name' => $this->input->post('name'),
                        'address' => $this->input->post('address'),
                        'mobile' => $this->input->post('mobile_no'),
                    );
                    $data = $this->security->xss_clean($data);
                    $result = $this->distributor_model->edit_distributor($data, $id);
                    if($result){
                        $this->session->set_flashdata('msg', 'Distributor has been Updated Successfully!');
                        redirect(base_url('admin/distributors'));
                    }
                }
            } else {
                $data['distributor'] = $this->distributor_model->get_distributor_by_id($id);
                $data['title'] = 'Edit Distributor';
                $data['view'] = 'admin/distributors/distributor_edit';
                $this->load->view('admin/layout', $data);
            }
        }

        public function del($id = 0) {
            $this->db->delete('distributors', array('id' => $id));
            $this->session->set_flashdata('msg', 'Distributor has been Deleted Successfully!');
            redirect(base_url('admin/distributors'));
        }

        public function create_distributors_pdf() {
            $this->load->helper('pdf_helper'); // loaded pdf helper
            $data['all_distributors'] = $this->distributor_model->get_all_distributors();
            $this->load->view('admin/distributors/distributors_pdf', $data);
        }

        public function export_csv() {
            // file name
            $filename = 'distributors_'.date('Y-m-d').'.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$filename");
            header("Content-Type: application/csv; ");

            // get data
            $distributor_data = $this->distributor_model->get_all_distributors_for_csv();

            // file creation
            $file = fopen('php://output', 'w');

            $header = array("ID", "Distributor Name", "Address", "Mobile Number", "Unpaid", "Paid");
            fputcsv($file, $header);
            foreach ($distributor_data as $key=>$line){
                fputcsv($file,$line);
            }
            fclose($file);
            exit;
        }
    }
?>