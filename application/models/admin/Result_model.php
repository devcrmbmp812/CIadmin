<?php
    class Result_model extends CI_Model{

        public function get_all_results() {
            $query = $this->db->get('results');
            return $result = $query->result_array();
        }

        public function add_result($data) {
            $this->db->insert('results', $data);
            return true;
        }

        public function get_result_by_id($id) {
            $query = $this->db->get_where('results', array('id' => $id));
            return $result = $query->row_array();
        }

        public function get_all_results_for_csv() {
            $this->db->select('id, drawtime, drawdate, result');
            $this->db->from('results');
            $query = $this->db->get();
            return $result = $query->result_array();
        }

        public function edit_result($data, $id) {
            $this->db->where('id', $id);
            $this->db->update('results', $data);
            return true;
        }
    }
?>