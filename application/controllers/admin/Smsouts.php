<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Smsouts extends MY_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('admin/smsout_model', 'smsout_model');
        }

        public function index()
        {
            $data['all_smsouts'] =  $this->smsout_model->get_all_smsouts();
            $data['title'] = 'Sms Out List';
            $data['view'] = 'admin/smsouts/smsout_list';
            $this->load->view('admin/layout', $data);
        }

        public function add() {
            if($this->input->post('submit')) {
                $this->form_validation->set_rules('sms_text', 'SMS Text', 'trim|required');
                $this->form_validation->set_rules('recipient_number', 'Recipient Number', 'trim|required');
                $this->form_validation->set_rules('instance_name', 'Instance Name', 'trim|required');
                $this->form_validation->set_rules('msg_status', 'Message Status', 'trim|required');

                if ($this->form_validation->run() == FALSE ) {
                    $data['title'] = 'Add Sms Out';
                    $data['view'] = 'admin/smsouts/smsout_add';
                    $this->load->view('admin/layout', $data);
                } else {
                    $date = new DateTime();
                    $datetime = $date->format('Y-m-d H:i:s');
                    $data = array(
                        'sms_text' => $this->input->post('sms_text'),
                        'recipient_number' => $this->input->post('recipient_number'),
                        'instance_name' => $this->input->post('instance_name'),
                        'msg_status' => $this->input->post('msg_status'),
                        'sent_dt' => $datetime,
                    );
                    $data = $this->security->xss_clean($data);
                    $result = $this->smsout_model->add_smsout($data);
                    if($result){
                        $this->session->set_flashdata('msg', 'SMS Out has been Added Successfully!');
                        redirect(base_url('admin/smsouts'));
                    }
                }
            } else {
                $data['title'] = 'Add Sms Out';
                $data['view'] = 'admin/smsouts/smsout_add';
                $this->load->view('admin/layout', $data);
            }
        }

        public function edit($id = 0) {
            if($this->input->post('submit')) {
                $this->form_validation->set_rules('sms_text', 'SMS Text', 'trim|required');
                $this->form_validation->set_rules('recipient_number', 'Recipient Number', 'trim|required');
                $this->form_validation->set_rules('instance_name', 'Instance Name', 'trim|required');
                $this->form_validation->set_rules('msg_status', 'Message Status', 'trim|required');

                if ($this->form_validation->run() == FALSE) {
                    $data['smsout'] = $this->smsout_model->get_smsout_by_id($id);
                    $data['title'] = 'Edit Sms Out';
                    $data['view'] = 'admin/smsouts/smsout_edit';
                    $this->load->view('admin/layout', $data);
                }
                else{
                    $date = new DateTime();
                    $datetime = $date->format('Y-m-d H:i:s');
                    $data = array(
                        'sms_text' => $this->input->post('sms_text'),
                        'recipient_number' => $this->input->post('recipient_number'),
                        'instance_name' => $this->input->post('instance_name'),
                        'msg_status' => $this->input->post('msg_status'),
                        'sent_dt' => $datetime,
                    );
                    $data = $this->security->xss_clean($data);
                    $result = $this->smsout_model->edit_smsout($data, $id);
                    if($result){
                        $this->session->set_flashdata('msg', 'Sms Out has been Updated Successfully!');
                        redirect(base_url('admin/smsouts'));
                    }
                }
            } else {
                $data['smsout'] = $this->smsout_model->get_smsout_by_id($id);
                $data['title'] = 'Edit Sms Out';
                $data['view'] = 'admin/smsouts/smsout_edit';
                $this->load->view('admin/layout', $data);
            }
        }

        public function del($id = 0) {
            $this->db->delete('sms_out', array('id' => $id));
            $this->session->set_flashdata('msg', 'Sms Out has been Deleted Successfully!');
            redirect(base_url('admin/smsouts'));
        }

        public function create_smsouts_pdf() {
            $this->load->helper('pdf_helper'); // loaded pdf helper
            $data['all_smsouts'] = $this->smsout_model->get_all_smsouts();
            $this->load->view('admin/smsouts/smsouts_pdf', $data);
        }

        public function export_csv() {
            // file name
            $filename = 'Smsouts'.date('Y-m-d').'.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$filename");
            header("Content-Type: application/csv; ");

            // get data
            $smsout_data = $this->smsout_model->get_all_smsouts_for_csv();

            // file creation
            $file = fopen('php://output', 'w');

            $header = array("ID", "SMS Text", "Recipient Number", "Instance Name", "Sent Datetime", "Message Status");
            fputcsv($file, $header);
            foreach ($smsout_data as $key=>$line){
                fputcsv($file,$line);
            }
            fclose($file);
            exit;
        }
    }
?>