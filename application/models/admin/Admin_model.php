<?php
    class Admin_model extends CI_Model{

        public function get_all_admins() {
            $query = $this->db->get('admins');
            return $result = $query->result_array();
        }

        public function add_admin($data) {
            $this->db->insert('admins', $data);
            return true;
        }

        public function get_admin_by_id($id) {
            $query = $this->db->get_where('admins', array('id' => $id));
            return $result = $query->row_array();
        }

        public function get_all_admins_for_csv() {
            $this->db->select('id, name, address, mobile, unpaid, paid, distributor_id');
            $this->db->from('admins');
            $query = $this->db->get();
            return $result = $query->result_array();
        }

        public function edit_admin($data, $id) {
            $this->db->where('id', $id);
            $this->db->update('admins', $data);
            return true;
        }

        public function get_distributor_groups() {
            $query = $this->db->get('distributors');
            return $result = $query->result_array();
        }

    }
?>