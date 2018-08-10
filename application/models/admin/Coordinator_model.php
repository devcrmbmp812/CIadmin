<?php
    class Coordinator_model extends CI_Model{

        public function get_all_coordinators() {
            $query = $this->db->get('coordinators');
            return $result = $query->result_array();
        }

        public function add_coordinator($data) {
            $this->db->insert('coordinators', $data);
            return true;
        }

        public function get_coordinator_by_id($id) {
            $query = $this->db->get_where('coordinators', array('id' => $id));
            return $result = $query->row_array();
        }

        public function get_all_coordinators_for_csv() {
            $this->db->select('id, name, address, mobile, unpaid, paid, distributor_id');
            $this->db->from('coordinators');
            $query = $this->db->get();
            return $result = $query->result_array();
        }

        public function edit_coordinator($data, $id) {
            $this->db->where('id', $id);
            $this->db->update('coordinators', $data);
            return true;
        }

        public function get_distributor_groups() {
            $query = $this->db->get('distributors');
            return $result = $query->result_array();
        }

    }
?>