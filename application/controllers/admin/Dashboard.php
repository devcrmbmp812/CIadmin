<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Dashboard extends MY_Controller {
		public function __construct(){
			parent::__construct();
            $this->load->model('admin/bet_model', 'bet_model');
		}

		public function index(){
			$data['total_bets_num'] = $this->bet_model->count_all();
			$data['total_coordinators'] = $this->bet_model->count_coordinators();
			$data['total_distributors'] = $this->bet_model->count_distributors();
            $data['bet_top10agents'] = $this->bet_model->get_bet_top10agents();
            $data['top100bet_numbers'] = $this->bet_model->get_top100bet_numbers();
            $data['smslogs100latests'] = $this->bet_model->get_smslogs100latests();
            $data['smsouts100latests'] = $this->bet_model->get_smsouts100latests();

			$data['title'] = 'CEBU BOSS';
			$data['view'] = 'admin/dashboard/index';
			$this->load->view('admin/layout', $data);
		}

		public function index2(){
			$data['title'] = 'Dashboard 2';
			$data['view'] = 'admin/dashboard/index2';
			$this->load->view('admin/layout', $data);
		}

        public function bet_top10agent()
        {
            $data['bet_top10agents'] = $this->bet_model->get_bet_top10agents();
            $data['title'] = 'Bet Top 10 Agents';
            $data['view'] = 'admin/dashboard/bet_top10agents';
            $this->load->view('admin/layout', $data);
        }

        public function bet_statistics()
        {
            $data['bet_statistics'] = $this->bet_model->get_bet_statistics();
            $data['title'] = 'Bet Statistics';
            $data['view'] = 'admin/dashboard/bet_statistics';
            $this->load->view('admin/layout', $data);
        }

        public function top100bet_number()
		{
            $data['top100bet_numbers'] = $this->bet_model->get_top100bet_numbers();
            $data['title'] = 'Top 100 Bet Numbers';
            $data['view'] = 'admin/dashboard/top100bet_numbers';
            $this->load->view('admin/layout', $data);
		}

		public function smslogs100latest()
		{
            $data['smslogs100latests'] = $this->bet_model->get_smslogs100latests();
            $data['title'] = 'Top 100 Latest SMS Logs';
            $data['view'] = 'admin/dashboard/smslogs100latests';
            $this->load->view('admin/layout', $data);
		}

		public function smsouts100latest()
		{
            $data['smsouts100latests'] = $this->bet_model->get_smsouts100latests();
            $data['title'] = 'Top 100 Latest SMS Outs';
            $data['view'] = 'admin/dashboard/smsouts100latests';
            $this->load->view('admin/layout', $data);
		}

		public function resultfilter()
        {
            $data['title'] = 'Results Date Filter';
            $data['view'] = 'admin/dashboard/resultsfilter';
            $this->load->view('admin/layout', $data);
        }
	}

?>	