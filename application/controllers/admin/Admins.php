<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Admins extends MY_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('admin/admin_model', 'admin_model');
        }

        public function index()
        {
            $data['all_admins'] =  $this->admin_model->get_all_admins();
            $data['title'] = 'Admin List';
            $data['view'] = 'admin/admins/admin_list';
            $this->load->view('admin/layout', $data);
        }

        public function add() {
            if($this->input->post('submit')) {
                $this->form_validation->set_rules('name', 'Admin Name', 'trim|min_length[5]|required');
                $this->form_validation->set_rules('address', 'Address', 'trim|required');
                $this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');
                $this->form_validation->set_rules('distributor', 'Distributor', 'trim|required');

                if ($this->form_validation->run() == FALSE ) {
                    $data['title'] = 'Add Admin';
                    $data['view'] = 'admin/admins/admin_add';
                    $this->load->view('admin/layout', $data);
                } else {
                    $data = array(
                        'name' => $this->input->post('name'),
                        'address' => $this->input->post('address'),
                        'mobile' => $this->input->post('mobile_no'),
                        'distributor_id' => $this->input->post('distributor'),
                    );
                    $data = $this->security->xss_clean($data);
                    $result = $this->admin_model->add_admin($data);
                    if($result){
                        $this->session->set_flashdata('msg', 'Admin has been Added Successfully!');
                        redirect(base_url('admin/admins'));
                    }
                }
            } else {
                $data['distributor_groups'] = $this->admin_model->get_distributor_groups();
                $data['title'] = 'Add Admin';
                $data['view'] = 'admin/admins/admin_add';
                $this->load->view('admin/layout', $data);
            }
        }

        public function edit($id = 0) {
            if($this->input->post('submit')) {
                $this->form_validation->set_rules('name', 'Admin Name', 'trim|required');
                $this->form_validation->set_rules('address', 'Address', 'trim|required');
                $this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required');
                $this->form_validation->set_rules('distributor', 'Distributor', 'trim|required');

                if ($this->form_validation->run() == FALSE) {
                    $data['admin'] = $this->admin_model->get_admin_by_id($id);
                    $data['title'] = 'Edit Admin';
                    $data['view'] = 'admin/admins/admin_edit';
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
                    $result = $this->admin_model->edit_admin($data, $id);
                    if($result){
                        $this->session->set_flashdata('msg', 'Admin has been Updated Successfully!');
                        redirect(base_url('admin/admins'));
                    }
                }
            } else {
                $data['admin'] = $this->admin_model->get_admin_by_id($id);
                $data['distributor_groups'] = $this->admin_model->get_distributor_groups();
                $data['title'] = 'Edit Admin';
                $data['view'] = 'admin/admins/admin_edit';
                $this->load->view('admin/layout', $data);
            }
        }

        public function del($id = 0) {
            $this->db->delete('admins', array('id' => $id));
            $this->session->set_flashdata('msg', 'Admin has been Deleted Successfully!');
            redirect(base_url('admin/admins'));
        }

        public function create_admins_pdf() {
            $this->load->helper('pdf_helper'); // loaded pdf helper
            $data['all_admins'] = $this->admin_model->get_all_admins();
            $this->load->view('admin/admins/admins_pdf', $data);
        }

        public function export_csv() {
            // file name
            $filename = 'admins_'.date('Y-m-d').'.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$filename");
            header("Content-Type: application/csv; ");

            // get data
            $admin_data = $this->admin_model->get_all_admins_for_csv();

            // file creation
            $file = fopen('php://output', 'w');

            $header = array("ID", "Admin Name", "Address", "Mobile Number", "Unpaid", "Paid", "Distributed ID");
            fputcsv($file, $header);
            foreach ($admin_data as $key=>$line){
                fputcsv($file,$line);
            }
            fclose($file);
            exit;
        }
    }
?>