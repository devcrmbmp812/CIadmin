<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Betezs extends MY_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('admin/betez_model', 'betez_model');
        }

        public function index()
        {
            $data['all_betezs'] =  $this->betez_model->get_all_betezs();
            $data['title'] = 'Betez List';
            $data['view'] = 'admin/betezs/betez_list';
            $this->load->view('admin/layout', $data);
        }

        public function add() {
            if($this->input->post('submit')) {
                $this->form_validation->set_rules('bet_amt', 'Bet Amount', 'trim|required');
                $this->form_validation->set_rules('bet_number', 'Bet Number', 'trim|required');
                $this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required');
                $this->form_validation->set_rules('bet_code', 'Bet Code', 'trim|required');
                $this->form_validation->set_rules('bet_text', 'Bet Text', 'trim|required');
                $this->form_validation->set_rules('agent', 'Agent', 'trim|required');

                if ($this->form_validation->run() == FALSE ) {
                    $data['agent_groups'] = $this->betez_model->get_agent_groups();
                    $data['title'] = 'Add Betez';
                    $data['view'] = 'admin/betezs/bet_add';
                    $this->load->view('admin/layout', $data);
                } else {
                    $date = new DateTime();
                    $datetime = $date->format('Y-m-d H:i:s');
                    $bet_date = $date->format('Y-m-d');

                    $datetime1 = $date->format('H');
                    $date_input1 = $datetime1;

                    if($date_input1<'11')
                    {
                        $bet_draw='11AM';
                    }
                    elseif($date_input1>='11' && $date_input1<'16')
                    {
                        $bet_draw='4PM';
                    }
                    elseif($date_input1>='16' && $date_input1<'21')
                    {
                        $bet_draw='9PM';
                    }
                    else
                    {
                        $bet_draw='NODRAW';
                    }

                    $data = array(
                        'bet_created' => $datetime,
                        'bet_draw' => $bet_draw,
                        'bet_date' => $bet_date,
                        'bet_amt' => $this->input->post('bet_amt'),
                        'bet_number' => $this->input->post('bet_number'),
                        'mobile' => $this->input->post('mobile_no'),
                        'bet_code' => $this->input->post('bet_code'),
                        'bet_text' => $this->input->post('bet_text'),
                        'agent_id' => $this->input->post('agent'),
                    );
                    $data = $this->security->xss_clean($data);
                    $result = $this->betez_model->add_betez($data);
                    if($result){
                        $this->session->set_flashdata('msg', 'Betez has been Added Successfully!');
                        redirect(base_url('admin/betezs'));
                    }
                }
            } else {
                $data['agent_groups'] = $this->betez_model->get_agent_groups();
                $data['title'] = 'Add Betez';
                $data['view'] = 'admin/betezs/betez_add';
                $this->load->view('admin/layout', $data);
            }
        }

        public function edit($id = 0) {
            if($this->input->post('submit')) {
                $this->form_validation->set_rules('bet_amt', 'Bet Amount', 'trim|required');
                $this->form_validation->set_rules('bet_number', 'Bet Number', 'trim|required');
                $this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required');
                $this->form_validation->set_rules('bet_code', 'Bet Code', 'trim|required');
                $this->form_validation->set_rules('bet_text', 'Bet Text', 'trim|required');
                $this->form_validation->set_rules('agent', 'Agent', 'trim|required');

                if ($this->form_validation->run() == FALSE) {
                    $data['betez'] = $this->betez_model->get_betez_by_id($id);
                    $data['agent_groups'] = $this->betez_model->get_agent_groups();
                    $data['title'] = 'Edit Betez';
                    $data['view'] = 'admin/betezs/betez_edit';
                    $this->load->view('admin/layout', $data);
                }
                else{
                    $date = new DateTime();
                    $datetime = $date->format('Y-m-d H:i:s');
                    $bet_date = $date->format('Y-m-d');

                    $datetime1 = $date->format('H');
                    $date_input1 = $datetime1;

                    if($date_input1<'11')
                    {
                        $bet_draw='11AM';
                    }
                    elseif($date_input1>='11' && $date_input1<'16')
                    {
                        $bet_draw='4PM';
                    }
                    elseif($date_input1>='16' && $date_input1<'21')
                    {
                        $bet_draw='9PM';
                    }
                    else
                    {
                        $bet_draw='NODRAW';
                    }

                    $data = array(
                        'bet_created' => $datetime,
                        'bet_draw' => $bet_draw,
                        'bet_date' => $bet_date,
                        'bet_amt' => $this->input->post('bet_amt'),
                        'bet_number' => $this->input->post('bet_number'),
                        'mobile' => $this->input->post('mobile_no'),
                        'bet_code' => $this->input->post('bet_code'),
                        'bet_text' => $this->input->post('bet_text'),
                        'agent_id' => $this->input->post('agent'),
                    );
                    $data = $this->security->xss_clean($data);
                    $result = $this->betez_model->edit_betez($data, $id);
                    if($result){
                        $this->session->set_flashdata('msg', 'Betez has been Updated Successfully!');
                        redirect(base_url('admin/betezs'));
                    }
                }
            } else {
                $data['betez'] = $this->betez_model->get_betez_by_id($id);
                $data['agent_groups'] = $this->betez_model->get_agent_groups();
                $data['title'] = 'Edit Betez';
                $data['view'] = 'admin/betezs/betez_edit';
                $this->load->view('admin/layout', $data);
            }
        }

        public function del($id = 0) {
            $this->db->delete('betez', array('id' => $id));
            $this->session->set_flashdata('msg', 'Betez has been Deleted Successfully!');
            redirect(base_url('admin/betezs'));
        }

        public function create_betezs_pdf() {
            $this->load->helper('pdf_helper'); // loaded pdf helper
            $data['all_betezs'] = $this->betez_model->get_all_betezs();
            $this->load->view('admin/betezs/betezs_pdf', $data);
        }

        public function export_csv() {
            // file name
            $filename = 'betezs_'.date('Y-m-d').'.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$filename");
            header("Content-Type: application/csv; ");

            // get data
            $betez_data = $this->betez_model->get_all_betezs_for_csv();

            // file creation
            $file = fopen('php://output', 'w');

            $header = array("ID", "Bet Created", "Bet Draw","Bet Amount","Bet Number","Agent ID", "Mobile Number", "Bet Code", "Bet Text", "Text Code", "Status");
            fputcsv($file, $header);
            foreach ($betez_data as $key=>$line){
                fputcsv($file,$line);
            }
            fclose($file);
            exit;
        }
    }
?>