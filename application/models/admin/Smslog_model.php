<?php
    class Smslog_model extends CI_Model{

        public function get_all_smslogs() {
            $query = $this->db->get('sms_logs');
            return $result = $query->result_array();
        }

        public function add_smslog($data) {
            $this->db->insert('sms_logs', $data);
            return true;
        }

        public function get_smslog_by_id($id) {
            $query = $this->db->get_where('sms_logs', array('id' => $id));
            return $result = $query->row_array();
        }

        public function get_all_smslogs_for_csv() {
            $this->db->select('id, sms_text, sender_number,sent_dt, instance_name');
            $this->db->from('sms_logs');
            $query = $this->db->get();
            return $result = $query->result_array();
        }

        public function edit_smslog($data, $id) {
            $this->db->where('id', $id);
            $this->db->update('sms_logs', $data);
            return true;
        }
    }
?>