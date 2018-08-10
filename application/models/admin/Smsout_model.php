<?php
    class Smsout_model extends CI_Model{

        public function get_all_smsouts() {
            $query = $this->db->get('sms_out');
            return $result = $query->result_array();
        }

        public function add_smsout($data) {
            $this->db->insert('sms_out', $data);
            return true;
        }

        public function get_smsout_by_id($id) {
            $query = $this->db->get_where('sms_out', array('id' => $id));
            return $result = $query->row_array();
        }

        public function get_all_smsouts_for_csv() {
            $this->db->select('id, sms_text, recipient_number, instance_name, sent_dt, msg_status');
            $this->db->from('sms_out');
            $query = $this->db->get();
            return $result = $query->result_array();
        }

        public function edit_smsout($data, $id) {
            $this->db->where('id', $id);
            $this->db->update('sms_out', $data);
            return true;
        }
    }
?>