<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Smsins extends MY_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('admin/smsin_model', 'smsin_model');
        }

        public function index()
        {
            $data['all_smsins'] =  $this->smsin_model->get_all_smsins();
            $data['title'] = 'Sms In List';
            $data['view'] = 'admin/smsins/smsin_list';
            $this->load->view('admin/layout', $data);
        }

        public function add() {
            if($this->input->post('submit')) {
                $this->form_validation->set_rules('gateway', 'Gateway', 'trim|required');
                $this->form_validation->set_rules('originator', 'Originator', 'trim|required');
                $this->form_validation->set_rules('message', 'Message', 'trim|required');
                $this->form_validation->set_rules('status', 'Status', 'trim|required');

                if ($this->form_validation->run() == FALSE ) {
                    $data['title'] = 'Add Sms In';
                    $data['view'] = 'admin/smsins/smsin_add';
                    $this->load->view('admin/layout', $data);
                } else {
                    $date = new DateTime();
                    $datetime = $date->format('Y-m-d H:i:s');
                    $data = array(
                        'gateway' => $this->input->post('gateway'),
                        'originator' => $this->input->post('originator'),
                        'message' => $this->input->post('message'),
                        'status' => $this->input->post('status'),
                        'timestamp' => $datetime,
                    );
                    $data = $this->security->xss_clean($data);
                    $result = $this->smsin_model->add_smsin($data);
                    if($result){
                        $this->session->set_flashdata('msg', 'Sms In has been Added Successfully!');
                        redirect(base_url('admin/smsins'));
                    }
                }
            } else {
                $data['title'] = 'Add Sms In';
                $data['view'] = 'admin/smsins/smsin_add';
                $this->load->view('admin/layout', $data);
            }
        }

        public function edit($id = 0) {
            if($this->input->post('submit')) {
                $this->form_validation->set_rules('gateway', 'Gateway', 'trim|required');
                $this->form_validation->set_rules('originator', 'Originator', 'trim|required');
                $this->form_validation->set_rules('message', 'Message', 'trim|required');
                $this->form_validation->set_rules('status', 'Status', 'trim|required');

                if ($this->form_validation->run() == FALSE) {
                    $data['smsin'] = $this->smsin_model->get_smsin_by_id($id);
                    $data['title'] = 'Edit Sms In';
                    $data['view'] = 'admin/smsins/smsin_edit';
                    $this->load->view('admin/layout', $data);
                }
                else{
                    $date = new DateTime();
                    $datetime = $date->format('Y-m-d H:i:s');
                    $data = array(
                        'gateway' => $this->input->post('gateway'),
                        'originator' => $this->input->post('originator'),
                        'message' => $this->input->post('message'),
                        'status' => $this->input->post('status'),
                        'timestamp' => $datetime,
                    );
                    $data = $this->security->xss_clean($data);
                    $result = $this->smsin_model->edit_smsin($data, $id);
                    if($result){
                        $this->session->set_flashdata('msg', 'Sms In has been Updated Successfully!');
                        redirect(base_url('admin/smsins'));
                    }
                }
            } else {
                $data['smsin'] = $this->smsin_model->get_smsin_by_id($id);
                $data['title'] = 'Edit Sms In';
                $data['view'] = 'admin/smsins/smsin_edit';
                $this->load->view('admin/layout', $data);
            }
        }

        public function del($id = 0) {
            $this->db->delete('sms_in', array('id' => $id));
            $this->session->set_flashdata('msg', 'Sms In has been Deleted Successfully!');
            redirect(base_url('admin/smsins'));
        }

        public function create_smsins_pdf() {
            $this->load->helper('pdf_helper'); // loaded pdf helper
            $data['all_smsins'] = $this->smsin_model->get_all_smsins();
            $this->load->view('admin/smsins/smsins_pdf', $data);
        }

        public function export_csv() {
            // file name
            $filename = 'Smsins_'.date('Y-m-d').'.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$filename");
            header("Content-Type: application/csv; ");

            // get data
            $smsin_data = $this->smsin_model->get_all_smsins_for_csv();

            // file creation
            $file = fopen('php://output', 'w');

            $header = array("ID", "Gateway", "Originator", "Message", "Timestamp", "Status");
            fputcsv($file, $header);
            foreach ($smsin_data as $key=>$line){
                fputcsv($file,$line);
            }
            fclose($file);
            exit;
        }
    }
?>