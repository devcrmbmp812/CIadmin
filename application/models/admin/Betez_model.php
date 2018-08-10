<?php
    class Betez_model extends CI_Model{

        public function get_all_betezs() {
            $query = $this->db->get('betez');
            return $result = $query->result_array();
        }

        public function add_betez($data) {
            $this->db->insert('betez', $data);
            return true;
        }

        public function get_betez_by_id($id) {
            $query = $this->db->get_where('betez', array('id' => $id));
            return $result = $query->row_array();
        }

        public function get_all_betezs_for_csv() {
            $this->db->select('id, bet_created, bet_draw, bet_date, bet_amt, bet_number, agent_id, mobile, bet_code, bet_text');
            $this->db->from('betez');
            $query = $this->db->get();
            return $result = $query->result_array();
        }

        public function edit_betez($data, $id) {
            $this->db->where('id', $id);
            $this->db->update('betez', $data);
            return true;
        }

        public function get_agent_groups() {
            $query = $this->db->get('agents');
            return $result = $query->result_array();
        }

    }
?>