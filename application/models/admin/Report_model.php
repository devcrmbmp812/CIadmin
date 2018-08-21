<?php
    class Report_model extends CI_Model{

        var $table = 'bet';
        var $column = array('a.id','b.bet_code','a.name','b.bet_draw','b.bet_date', 'b.bet_number', 'b.bet_amt', 'a.mobile', 'a.coordinator_id');
        var $order = array('a.name' => 'ASC');

        public function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->search = '';
        }

        private function _get_datatables_query($searchdate = null, $searchtime = null, $result = null)
        {
            $this->db->from('bet as b');
            if(isset($searchdate) && isset($searchtime) && isset($result))
            {
                $this->db->where(array('b.bet_date' => $searchdate, 'b.bet_draw' => $searchtime, 'b.bet_number' => $result));
                $this->db->join('agents as a', 'b.agent_id = a.id', 'LEFT');
            }

            $i = 0;

            foreach ($this->column as $item)
            {
                if(isset($_POST['search']) && $_POST['search']['value']) {
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

        public function countwinner_all($searchdate, $searchtime)
        {
            if (isset($searchdate) && $searchdate != '' && isset($searchtime) && $searchtime != '')
            {
                $searchdate = $_POST['searchdate'];
                $searchtime = $_POST['searchtime'];
                $result = $_POST['result'];
                $query = $this->db->query("SELECT b.bet_code, b.agent_id, b.bet_draw, b.bet_date, b.bet_number, b.bet_amt, a.id, a.name, a.mobile, a.coordinator_id FROM bet b JOIN agents a ON b.agent_id = a.id 
WHERE b.bet_date='".$searchdate."' AND b.bet_draw ='".$searchtime."' AND b.bet_number = '".$result."'
ORDER BY `a`.`name` ASC ");
                return $result = $query->num_rows();
            }
            else {
                return 0;
            }
        }

        function countwinner_filtered($searchdate, $searchtime, $result)
        {
            if(isset($searchdate) && $searchdate != '' && isset($searchtime) && $searchtime != '' && isset($result) && $result != '')
            {
                $this->_get_datatables_query($_POST['searchdate'], $_POST['searchtime'], $_POST['result']);
                $query = $this->db->get();
                return $query->num_rows();
            }
            else {
                return 0;
            }
        }

        public function searchdate_time_result() {
            $this->db->select('result');
            $this->db->from('results');
            $this->db->where(array('drawdate'=>$_POST['searchdate'], 'drawtime' => $_POST['searchtime']));
            $query = $this->db->get();

            return $result = $query->result_array();
        }

        public function get_winnerswithresult() {
            $this->_get_datatables_query($_POST['searchdate'], $_POST['searchtime'], $_POST['result']);
            if(isset($_POST['search']) && $_POST['length'] != -1)
                $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
            return $query->result();
        }
    }
?>