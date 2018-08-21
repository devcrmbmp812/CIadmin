<?php
    class Result_model extends CI_Model{

        var $table = 'results';
        var $column = array('id','drawtime','drawdate','result');
        var $order = array('id' => 'desc');

        public function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->search = '';

        }

        private function _get_datatables_query($searchdate = null)
        {

            $this->db->from($this->table);
            if(isset($searchdate))
            {
                $this->db->where('drawdate', $searchdate);
            }

            $i = 0;

            foreach ($this->column as $item)
            {
                if(isset($_POST['search']) && $_POST['search']['value']){
                    if($i === 0){
                        $this->db->group_start();
                    }
                    ($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
                }

                $column[$i] = $item;
                $i++;
            }
            if(isset($_POST['search']) && $_POST['search']['value']){
                $this->db->group_end();
            }

            if(isset($_POST['order']))
            {
                $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }
            else if(isset($this->order))
            {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }

        public function count_all($searchdate = null)
        {
            if (isset($searchdate) && $searchdate != '')
            {
                $this->db->from($this->table);
                $this->db->where('drawdate', $searchdate);
                return $this->db->count_all_results();
            }
            else {
                $this->db->from($this->table);
                return $this->db->count_all_results();
            }
        }

        function count_filtered($searchdate = null)
        {
            if(isset($searchdate) && $searchdate != '')
            {
                $this->_get_datatables_query($searchdate);
                $query = $this->db->get();
                return $query->num_rows();
            }
            else {
                $this->_get_datatables_query();
                $query = $this->db->get();
                return $query->num_rows();
            }
        }

        public function get_pdf_all_results() {
            $query = $this->db->get('results');
            return $result = $query->result_array();
        }

        public function get_all_results() {
            $this->_get_datatables_query();
            if(isset($_POST['search']) && $_POST['length'] != -1)
                $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
            return $query->result();
        }

        public function get_results_searchdate() {
            $this->_get_datatables_query($_POST['searchdate']);
            if(isset($_POST['search']) && $_POST['length'] != -1)
                $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
            return $query->result();
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