<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Reporting extends MY_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('admin/report_model', 'report_model');
        }

        public function index()
        {
            $data['today'] = date("Y-m-d");
            $data['title'] = 'Generate Winners';
            $data['view'] = 'admin/reporting/reporting';
            $this->load->view('admin/layout', $data);
        }

        public function get_result_ajax() {
            if(isset($_POST['searchdate']) && isset($_POST['searchtime'])) {
                $list = $this->report_model->searchdate_time_result();
            }
            //output to json format
            if(empty($list)) return false;
            else echo json_encode($list);
        }

        public function get_winners_with_result_ajax() {
            if(isset($_POST['result']) && $_POST['result'] != '')
            {
                $list = $this->report_model->get_winnerswithresult();
                $data = array();
                $no = $_POST['start'];
                foreach ($list as $person) {
                    $no++;
                    $row = array();
                    $row[] = $person->bet_code;
                    $row[] = $person->name;
                    $row[] = $person->bet_draw;
                    $row[] = $person->bet_date;
                    $row[] = $person->bet_number;
                    $row[] = $person->bet_amt;
                    $row[] = $person->mobile;
                    $row[] = getCoordinatorName($person->coordinator_id);

                    $data[] = $row;
                }

                $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->report_model->countwinner_all($_POST['searchdate'], $_POST['searchtime']),
                    "recordsFiltered" => $this->report_model->countwinner_filtered($_POST['searchdate'], $_POST['searchtime'], $_POST['result']),
                    "data" => $data,
                );
                //output to json format
                echo json_encode($output);
            } else {
                $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => '0',
                    "recordsFiltered" => '0',
                    "data" => array(),
                );
                //output to json format
                echo json_encode($output);
            }
        }
    }
?>