<?php
    class Distributor_model extends CI_Model{

        public function get_all_distributors() {
            $query = $this->db->get('distributors');
            return $result = $query->result_array();
        }

        public function add_distributor($data) {
            $this->db->insert('distributors', $data);
            return true;
        }

        public function get_distributor_by_id($id) {
            $query = $this->db->get_where('distributors', array('id' => $id));
            return $result = $query->row_array();
        }

        public function get_all_distributors_for_csv() {
            $this->db->select('id, name, address, mobile, unpaid, paid');
            $this->db->from('distributors');
            $query = $this->db->get();
            return $result = $query->result_array();
        }

        public function edit_distributor($data, $id) {
            $this->db->where('id', $id);
            $this->db->update('distributors', $data);
            return true;
        }
    }
?>