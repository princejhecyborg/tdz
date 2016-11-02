<?php

class tdz_model extends CI_Model{

	function headerLinks($account_type){
		$page = $this->db->select('*')
                		 ->from('tbl_pages')
                		 ->join('tbl_page_per_account', 'tbl_page_per_account.page_id = tbl_pages.id')
                		 ->join('tbl_page_titles', 'tbl_page_titles.id = tbl_pages.page_title_id')
                		 ->where('tbl_page_per_account.account_type', $account_type)
                         ->order_by('tbl_page_per_account.order_in', 'ASC')
                		 ->get()->result();
    	return $page;
	}
	function pageTitle($link)
	{
		$pageTitle = $this->db->select('*')
					->from('tbl_page_titles')
					->where('link', $link)
					->get()
					->result();
		return $pageTitle;
	}
	function getFields($db, $except = array(), $para = ''){
        if(!$para){
            $para = $this->db;
        }

        $fields = $para->list_fields($db);
        if(count($fields)>0){
            foreach($fields as $k=>$v){
                if(count($except)>0){
                    if(in_array($v, $except)){
                        unset($fields[$k]);
                    }
                }
            }
        }

        return $fields;
    }
    function getRows($table, $restrictions = array())
    {
        foreach ($restrictions as $key => $value) {
            $newValue = array_diff_key($value, array_flip(array('type')));
            foreach ($newValue as $i => $var) {                
                if (array_key_exists($i, $newValue))
                {
                    $this->db->$key($i, $restrictions[$key][$i], $type = (array_key_exists('type', $value)) ? current($value) : "");
                }
            }
        }
        $getRows = $this->db->get($table);
        return $getRows;
    }
    function getJobCode($jobCode)
    {
        $this->db->where('id', $jobCode);
        $jobcode = $this->db->get('tbl_client')->row();
        $returnJobcode = $jobcode->customer_code;
        return $returnJobcode;
    }
    function getJobCodeExtend($get)
    {
        if ($get=="get")
        {
            $tbl = $this->db->get('tbl_job_code')->row();
            $getResult = $tbl->jobcode;
            return $getResult;
        }
        else
        {
            $this->db->truncate('tbl_job_code');
            $this->db->insert('tbl_job_code', $get);
        }
    }
    public function insert_data($db, $data)
    {
        $this->db->insert($db,$data);
    }
    function edit($table, $data, $id, $what_id = 'id')
    {
        $this->db->where($what_id, $id);
        $this->db->update($table, $data);
        return $id;
    }
    function countRows($table, $restrictions = array())
    {
        foreach ($restrictions as $key => $value) {
            foreach ($value as $i => $var) {
                 if (array_key_exists($i, $value))
                {
                    $this->db->$key($i, $restrictions[$key][$i]);
                }
            }
        }
        $countRows = $this->db->get($table)->num_rows();
        return $countRows;
    }
    function editAssignPhase($data, $jobid, $phase_id)
    {
        $this->db->where('phase_id', $phase_id);
        $this->db->where('job_id', $jobid);
        $this->db->update('tbl_assignments', $data);
    }
    function sumHourMin($data)
    {
        $this->db->where('dp_id', $this->session->userdata('sessdp_id'));
        $this->db->join('tbl_daily_accomplishment', 'tbl_daily_accomplishment.d_id = tbl_daily_accomplishment_diff.daily_acc_id');
        $this->db->select_sum($data);
        $return = $this->db->get('tbl_daily_accomplishment_diff')->row();
        return $return;
    }
    function delete($table, $id, $what_id = "id")
    {
        $this->db->where($what_id, $id);
        $this->db->delete($table);
    }
    function enc($string)
    {
        $key = 'jasonyaesodelapeña052894';
        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
        return $encrypted;
    }    
    function dec($string)
    {
        $key = 'jasonyaesodelapeña052894';
        $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
        return $decrypted;
    }
}