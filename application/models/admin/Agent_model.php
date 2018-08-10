<?php
    class Agent_model extends CI_Model{

        public function get_all_agents() {
            $query = $this->db->get('agents');
            return $result = $query->result_array();
        }

        public function add_agent($data) {
            $this->db->insert('agents', $data);
            return true;
        }

        public function get_agent_by_id($id) {
            $query = $this->db->get_where('agents', array('id' => $id));
            return $result = $query->row_array();
        }

        public function get_all_agents_for_csv() {
            $this->db->select('id, name, address, mobile, unpaid, paid, coordinator_id');
            $this->db->from('agents');
            $query = $this->db->get();
            return $result = $query->result_array();
        }

        public function edit_agent($data, $id) {
            $this->db->where('id', $id);
            $this->db->update('agents', $data);
            return true;
        }

        public function get_coordinator_groups() {
            $query = $this->db->get('coordinators');
            return $result = $query->result_array();
        }

    }
?>