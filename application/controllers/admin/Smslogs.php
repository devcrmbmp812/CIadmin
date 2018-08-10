<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Smslogs extends MY_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('admin/smslog_model', 'smslog_model');
        }

        public function index()
        {
            $data['all_smslogs'] =  $this->smslog_model->get_all_smslogs();
            $data['title'] = 'Sms Log List';
            $data['view'] = 'admin/smslogs/smslog_list';
            $this->load->view('admin/layout', $data);
        }

        public function add() {
            if($this->input->post('submit')) {
                $this->form_validation->set_rules('sms_text', 'SMS Text', 'trim|required');
                $this->form_validation->set_rules('sender_number', 'Sender Number', 'trim|required');
                $this->form_validation->set_rules('instance_name', 'Instance Name', 'trim|required');

                if ($this->form_validation->run() == FALSE ) {
                    $data['title'] = 'Add Sms Log';
                    $data['view'] = 'admin/smslogs/result_add';
                    $this->load->view('admin/layout', $data);
                } else {
                    $data = array(
                        'sms_text' => $this->input->post('sms_text'),
                        'sender_number' => $this->input->post('sender_number'),
                        'instance_name' => $this->input->post('instance_name'),
                    );
                    $data = $this->security->xss_clean($data);
                    $result = $this->smslog_model->add_smslog($data);
                    if($result){
                        $this->session->set_flashdata('msg', 'Sms Log has been Added Successfully!');
                        redirect(base_url('admin/smslogs'));
                    }
                }
            } else {
                $data['title'] = 'Add Sms Log';
                $data['view'] = 'admin/smslogs/smslog_add';
                $this->load->view('admin/layout', $data);
            }
        }

        public function edit($id = 0) {
            if($this->input->post('submit')) {
                $this->form_validation->set_rules('sms_text', 'SMS Text', 'trim|required');
                $this->form_validation->set_rules('sender_number', 'Sender Number', 'trim|required');
                $this->form_validation->set_rules('instance_name', 'Instance Name', 'trim|required');

                if ($this->form_validation->run() == FALSE) {
                    $data['smslog'] = $this->smslog_model->get_smslog_by_id($id);
                    $data['title'] = 'Edit Sms Log';
                    $data['view'] = 'admin/smslogs/smslog_edit';
                    $this->load->view('admin/layout', $data);
                }
                else{
                    $data = array(
                        'sms_text' => $this->input->post('sms_text'),
                        'sender_number' => $this->input->post('sender_number'),
                        'instance_name' => $this->input->post('instance_name'),
                    );
                    $data = $this->security->xss_clean($data);
                    $result = $this->smslog_model->edit_smslog($data, $id);
                    if($result){
                        $this->session->set_flashdata('msg', 'Sms Log has been Updated Successfully!');
                        redirect(base_url('admin/smslogs'));
                    }
                }
            } else {
                $data['smslog'] = $this->smslog_model->get_smslog_by_id($id);
                $data['title'] = 'Edit Sms Log';
                $data['view'] = 'admin/smslogs/smslog_edit';
                $this->load->view('admin/layout', $data);
            }
        }

        public function del($id = 0) {
            $this->db->delete('sms_logs', array('id' => $id));
            $this->session->set_flashdata('msg', 'Sms Log has been Deleted Successfully!');
            redirect(base_url('admin/smslogs'));
        }

        public function create_smslogs_pdf() {
            $this->load->helper('pdf_helper'); // loaded pdf helper
            $data['all_smslogs'] = $this->smslog_model->get_all_smslogs();
            $this->load->view('admin/smslogs/smslogs_pdf', $data);
        }

        public function export_csv() {
            // file name
            $filename = 'smslogs_'.date('Y-m-d').'.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$filename");
            header("Content-Type: application/csv; ");

            // get data
            $smslog_data = $this->smslog_model->get_all_smslogs_for_csv();

            // file creation
            $file = fopen('php://output', 'w');

            $header = array("ID", "SMS Text", "Sender Number", "Sent Datetime", "Instance Name");
            fputcsv($file, $header);
            foreach ($smslog_data as $key=>$line){
                fputcsv($file,$line);
            }
            fclose($file);
            exit;
        }
    }
?>