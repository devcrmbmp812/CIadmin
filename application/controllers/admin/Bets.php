<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Bets extends MY_Controller {

        public function __construct()
        {
            parent::__construct();
                $this->load->model('admin/bet_model', 'bet_model');
        }

        public function index()
        {
            //$data['all_bets'] =  $this->bet_model->get_all_bets();
            $data['title'] = 'Bet List';
            $data['view'] = 'admin/bets/bet_list';
            $this->load->view('admin/layout', $data);
        }

        public function add() {
            if($this->input->post('submit')) {
                $this->form_validation->set_rules('bet_amt', 'Bet Amount', 'trim|required');
                $this->form_validation->set_rules('bet_number', 'Bet Number', 'trim|required');
                $this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required');
                $this->form_validation->set_rules('bet_code', 'Bet Code', 'trim|required');
                $this->form_validation->set_rules('bet_text', 'Bet Text', 'trim|required');
                $this->form_validation->set_rules('text_code', 'Text Code', 'trim|required');
                $this->form_validation->set_rules('agent', 'Agent', 'trim|required');

                if ($this->form_validation->run() == FALSE ) {
                    $data['agent_groups'] = $this->bet_model->get_agent_groups();
                    $data['title'] = 'Add Bet';
                    $data['view'] = 'admin/bets/bet_add';
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
                        'text_code' => $this->input->post('text_code'),
                        'agent_id' => $this->input->post('agent'),
                    );
                    $data = $this->security->xss_clean($data);
                    $result = $this->bet_model->add_bet($data);
                    if($result){
                        $this->session->set_flashdata('msg', 'Bet has been Added Successfully!');
                        redirect(base_url('admin/bets'));
                    }
                }
            } else {
                $data['agent_groups'] = $this->bet_model->get_agent_groups();
                $data['title'] = 'Add Bet';
                $data['view'] = 'admin/bets/bet_add';
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
                $this->form_validation->set_rules('text_code', 'Text Code', 'trim|required');
                $this->form_validation->set_rules('agent', 'Agent', 'trim|required');

                if ($this->form_validation->run() == FALSE) {
                    $data['bet'] = $this->bet_model->get_bet_by_id($id);
                    $data['agent_groups'] = $this->bet_model->get_agent_groups();
                    $data['title'] = 'Edit Bet';
                    $data['view'] = 'admin/bets/bet_edit';
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
                        'text_code' => $this->input->post('text_code'),
                        'agent_id' => $this->input->post('agent'),
                    );
                    $data = $this->security->xss_clean($data);
                    $result = $this->bet_model->edit_bet($data, $id);
                    if($result){
                        $this->session->set_flashdata('msg', 'Bet has been Updated Successfully!');
                        redirect(base_url('admin/bets'));
                    }
                }
            } else {
                $data['bet'] = $this->bet_model->get_bet_by_id($id);
                $data['agent_groups'] = $this->bet_model->get_agent_groups();
                $data['title'] = 'Edit Bet';
                $data['view'] = 'admin/bets/bet_edit';
                $this->load->view('admin/layout', $data);
            }
        }

        public function del($id = 0) {
            $this->db->delete('bet', array('id' => $id));
            $this->session->set_flashdata('msg', 'Bet has been Deleted Successfully!');
            redirect(base_url('admin/bets'));
        }

        public function create_bets_pdf() {
            $this->load->helper('pdf_helper'); // loaded pdf helper
            $data['all_bets'] = $this->bet_model->get_pdf_all_bets();
            $this->load->view('admin/bets/bets_pdf', $data);
        }

        public function export_csv() {
            // file name
            $filename = 'bets_'.date('Y-m-d').'.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$filename");
            header("Content-Type: application/csv; ");

            // get data
            $bet_data = $this->bet_model->get_all_bets_for_csv();

            // file creation
            $file = fopen('php://output', 'w');

            $header = array("ID", "Bet Created", "Bet Draw","Bet Amount","Bet Number","Agent ID", "Mobile Number", "Bet Code", "Bet Text", "Text Code", "Status");
            fputcsv($file, $header);
            foreach ($bet_data as $key=>$line){
                fputcsv($file,$line);
            }
            fclose($file);
            exit;
        }

        public function bet_ajax_list() {

            $list = $this->bet_model->get_all_bets();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $person) {
                $no++;
                $row = array();
                $row[] = $person->id;
                $row[] = $person->bet_date;
                $row[] = $person->bet_draw;
                $row[] = $person->bet_amt;
                $row[] = $person->bet_number;
                $row[] = $person->mobile;
                $row[] = $person->bet_code;
                $row[] = $person->bet_text;
                $row[] = $person->text_code;
                $row[] = '<span class="btn btn-primary btn-flat btn-xs bg-green">'.getAgentName($person->agent_id).'<span>';
                $row[] = '<a class="btn btn-sm btn-primary" href="'.base_url('admin/bets/edit/').$person->id.' class="btn btn-info btn-flat btn-xs">Edit</a>'.'
                            <a class="btn btn-sm btn-danger" data-href="'.base_url('admin/bets/del/').$person->id.'" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#confirm-delete">Delete</a>';

                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->bet_model->count_all(),
                "recordsFiltered" => $this->bet_model->count_filtered(),
                "data" => $data,
            );
            //output to json format
            echo json_encode($output);

        }
    }
?>