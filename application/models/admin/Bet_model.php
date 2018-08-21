<?php
    class Bet_model extends CI_Model{

        var $table = 'bet';
        var $column = array('id','bet_date','bet_draw','bet_amt','bet_number','mobile','bet_code','bet_text','text_code', 'agent_id');
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

        public function get_bet_statistics()
        {
            $query_str="select count(id) as num, bet_draw from bet group by bet_draw";
            $query=$this->db->query($query_str);


            foreach ($query->result_array() as $row)
            {
                $return[$row['bet_draw']] = $row['num'];
            }

            $this->db->from($this->table);
            $query = $this->db->get();
            $total_num = $query->num_rows();
            $return['total'] = $total_num;
            return $return;
        }

        public function get_bet_top10agents()
        {
            $query_str="SELECT b.agent_id, b.bet_draw, b.bet_date, sum(b.bet_amt) as amount, a.id, a.name, a.mobile, a.coordinator_id FROM bet b JOIN agents a ON b.agent_id = a.id where b.bet_draw = '11AM' GROUP BY b.agent_id ORDER BY amount desc limit 10";
            $query=$this->db->query($query_str);

            return $result = $query->result_array();
        }

        public function get_top100bet_numbers()
        {
            $query_str="SELECT SUM(bet_amt) AS amount, bet_number, bet_date,bet_draw FROM `bet` WHERE `bet_draw`='11AM' GROUP BY bet_number ORDER BY amount DESC LIMIT 100";
            $query=$this->db->query($query_str);

            return $result = $query->result_array();
        }

        public function get_smslogs100latests()
        {
            $query_str="SELECT * FROM sms_logs ORDER BY id DESC LIMIT 100";
            $query=$this->db->query($query_str);

            return $result = $query->result_array();
        }

        public function get_smsouts100latests()
        {
            $query_str="SELECT * FROM sms_out ORDER BY id DESC LIMIT 100";
            $query=$this->db->query($query_str);

            return $result = $query->result_array();
        }

        public function count_coordinators()
        {
            $this->db->from('coordinators');
            return $this->db->count_all_results();
        }

        public function count_distributors()
        {
            $this->db->from('distributors');
            return $this->db->count_all_results();
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