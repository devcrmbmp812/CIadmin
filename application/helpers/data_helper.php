<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	// -----------------------------------------------------------------------------
    function getGroupyName($id){
    	
    	$CI = & get_instance();
    	return $CI->db->get_where('ci_user_groups', array('id' => $id))->row_array()['group_name'];
    }

    function getDistributorName($id) {
        $CI = & get_instance();
        return $CI->db->get_where('distributors', array('id' => $id))->row_array()['name'];
    }

    function getCoordinatorName($id) {
        $CI = & get_instance();
        return $CI->db->get_where('coordinators', array('id' => $id))->row_array()['name'];
    }

    function getAgentName($id) {
        $CI = & get_instance();
        return $CI->db->get_where('agents', array('id' => $id))->row_array()['name'];
    }

?>