<?php
    class Bet_model extends CI_Model{

        var $table = 'bet';
        var $column = array('bet_date','bet_draw','bet_amt','bet_number','mobile','bet_code','bet_text','text_code', 'agent_id');
        var $order = array('id' => 'desc');

        public function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->search = '';

        }

        private function _get_datatables_query()
        {

            $this->db->from($this->table);

            $i = 0;

            foreach ($this->column as $item)
            {
                if(isset($_POST['search']) && $_POST['search']['value'])
                    ($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
                $column[$i] = $item;
                $i++;
            }

            if(isset($_POST['order']))
            {
                $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }
            else if(isset($this->order))
            {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }

        public function count_all()
        {
            $this->db->from($this->table);
            return $this->db->count_all_results();
        }

        function count_filtered()
        {
            $this->_get_datatables_query();
            $query = $this->db->get();
            return $query->num_rows();
        }

        public function get_pdf_all_bets() {
            $query = $this->db->get('bet');
            return $result = $query->result_array();
        }

        public function get_all_bets() {
            $this->_get_datatables_query();
            if(isset($_POST['search']) && $_POST['length'] != -1)
                $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
            return $query->result();
        }

        public function add_bet($data) {
            $this->db->insert('bet', $data);
            return true;
        }

        public function get_bet_by_id($id) {
            $query = $this->db->get_where('bet', array('id' => $id));
            return $result = $query->row_array();
        }

        public function get_all_bets_for_csv() {
            $this->db->select('id, bet_created, bet_draw, bet_date, bet_amt, bet_number, agent_id, mobile, bet_code, bet_text, text_code,status');
            $this->db->from('bet');
            $query = $this->db->get();
            return $result = $query->result_array();
        }

        public function edit_bet($data, $id) {
            $this->db->where('id', $id);
            $this->db->update('bet', $data);
            return true;
        }

        public function get_agent_groups() {
            $query = $this->db->get('agents');
            return $result = $query->result_array();
        }

    }
?>