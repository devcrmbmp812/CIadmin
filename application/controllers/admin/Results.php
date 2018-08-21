<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Results extends MY_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('admin/result_model', 'result_model');
        }

        public function index()
        {
            $data['all_results'] =  $this->result_model->get_all_results();
            $data['today'] = date("Y-m-d");
            $data['title'] = 'Result List';
            $data['view'] = 'admin/results/result_list';
            $this->load->view('admin/layout', $data);
        }

        public function add() {
            if($this->input->post('submit')) {
                $this->form_validation->set_rules('drawtime', 'Draw Time', 'trim|required');
                $this->form_validation->set_rules('drawdate', 'Draw Date', 'trim|required');
                $this->form_validation->set_rules('result', 'Result', 'trim|required');

                if ($this->form_validation->run() == FALSE ) {
                    $data['title'] = 'Add Result';
                    $data['view'] = 'admin/results/result_add';
                    $this->load->view('admin/layout', $data);
                } else {
                    $data = array(
                        'drawtime' => $this->input->post('drawtime'),
                        'drawdate' => $this->input->post('drawdate'),
                        'result' => $this->input->post('result'),
                    );
                    $data = $this->security->xss_clean($data);
                    $result = $this->result_model->add_result($data);
                    if($result){
                        $this->session->set_flashdata('msg', 'Result has been Added Successfully!');
                        redirect(base_url('admin/results'));
                    }
                }
            } else {
                $data['title'] = 'Add Result';
                $data['view'] = 'admin/results/result_add';
                $this->load->view('admin/layout', $data);
            }
        }

        public function edit($id = 0) {
            if($this->input->post('submit')) {
                $this->form_validation->set_rules('drawtime', 'Draw Time', 'trim|required');
                $this->form_validation->set_rules('drawdate', 'Draw Date', 'trim|required');
                $this->form_validation->set_rules('result', 'Result', 'trim|required');

                if ($this->form_validation->run() == FALSE) {
                    $data['result'] = $this->result_model->get_result_by_id($id);
                    $data['title'] = 'Edit Result';
                    $data['view'] = 'admin/results/result_edit';
                    $this->load->view('admin/layout', $data);
                }
                else{
                    $data = array(
                        'drawtime' => $this->input->post('drawtime'),
                        'drawdate' => $this->input->post('drawdate'),
                        'result' => $this->input->post('result'),
                    );
                    $data = $this->security->xss_clean($data);
                    $result = $this->result_model->edit_result($data, $id);
                    if($result){
                        $this->session->set_flashdata('msg', 'Result has been Updated Successfully!');
                        redirect(base_url('admin/results'));
                    }
                }
            } else {
                $data['result'] = $this->result_model->get_result_by_id($id);
                $data['title'] = 'Edit Result';
                $data['view'] = 'admin/results/result_edit';
                $this->load->view('admin/layout', $data);
            }
        }

        public function del($id = 0) {
            $this->db->delete('results', array('id' => $id));
            $this->session->set_flashdata('msg', 'Result has been Deleted Successfully!');
            redirect(base_url('admin/results'));
        }

        public function create_results_pdf() {
            $this->load->helper('pdf_helper'); // loaded pdf helper
            $data['all_results'] = $this->result_model->get_pdf_all_results();
            $this->load->view('admin/results/results_pdf', $data);
        }

        public function export_csv() {
            // file name
            $filename = 'results_'.date('Y-m-d').'.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$filename");
            header("Content-Type: application/csv; ");

            // get data
            $result_data = $this->result_model->get_all_results_for_csv();

            // file creation
            $file = fopen('php://output', 'w');

            $header = array("ID", "Draw Time", "Draw Date", "Result");
            fputcsv($file, $header);
            foreach ($result_data as $key=>$line){
                fputcsv($file,$line);
            }
            fclose($file);
            exit;
        }

        public function result_ajax_list() {

            $list = $this->result_model->get_all_results();

            $data = array();
            $no = $_POST['start'];
            foreach ($list as $person) {
                $no++;
                $row = array();
                $row[] = $person->id;
                $row[] = $person->drawtime;
                $row[] = $person->drawdate;
                $row[] = $person->result;
                $row[] = '<a class="btn btn-sm btn-primary" href="'.base_url('admin/results/edit/').$person->id.' class="btn btn-info btn-flat btn-xs">Edit</a>'.'
                            <a class="btn btn-sm btn-danger" data-href="'.base_url('admin/results/del/').$person->id.'" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#confirm-delete">Delete</a>';

                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->result_model->count_all(),
                "recordsFiltered" => $this->result_model->count_filtered(),
                "data" => $data,
            );
            //output to json format
            echo json_encode($output);
        }

        public function result_filter_ajax_list() {
            if(isset($_POST['searchdate']) && $_POST['searchdate'] != '') {
                $list = $this->result_model->get_results_searchdate();
            } else {
                $list = $this->result_model->get_all_results();
            }

            $data = array();
            $no = $_POST['start'];
            foreach ($list as $person) {
                $no++;
                $row = array();
                $row[] = $person->id;
                $row[] = $person->drawtime;
                $row[] = $person->drawdate;
                $row[] = $person->result;
                $row[] = '<a class="btn btn-sm btn-primary" href="'.base_url('admin/results/edit/').$person->id.' class="btn btn-info btn-flat btn-xs">Edit</a>'.'
                            <a class="btn btn-sm btn-danger" data-href="'.base_url('admin/results/del/').$person->id.'" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#confirm-delete">Delete</a>';

                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->result_model->count_all($_POST['searchdate']),
                "recordsFiltered" => $this->result_model->count_filtered($_POST['searchdate']),
                "data" => $data,
            );
            //output to json format
            echo json_encode($output);
        }
    }
?>