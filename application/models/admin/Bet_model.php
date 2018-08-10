<?php
    class Bet_model extends CI_Model{

        public function get_all_bets() {
            $query = $this->db->get('bet');
            return $result = $query->result_array();
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