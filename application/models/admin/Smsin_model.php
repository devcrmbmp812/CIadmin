<?php
    class Smsin_model extends CI_Model{

        public function get_all_smsins() {
            $query = $this->db->get('sms_in');
            return $result = $query->result_array();
        }

        public function add_smsin($data) {
            $this->db->insert('sms_in', $data);
            return true;
        }

        public function get_smsin_by_id($id) {
            $query = $this->db->get_where('sms_in', array('id' => $id));
            return $result = $query->row_array();
        }

        public function get_all_smsins_for_csv() {
            $this->db->select('id, gateway, originator, message, timestamp, status');
            $this->db->from('sms_in');
            $query = $this->db->get();
            return $result = $query->result_array();
        }

        public function edit_smsin($data, $id) {
            $this->db->where('id', $id);
            $this->db->update('sms_in', $data);
            return true;
        }
    }
?>