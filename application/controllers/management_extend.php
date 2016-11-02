<?php
include('draftingzone.php');

class management_extend extends draftingzone{

    function __construct()
    {
        parent::__construct();
    }
    function clients()
    {  
        if ($_POST)
        {
            unset($_POST['submit']);
            $extra_fields = $this->tdz_model->getFields('tbl_client', array('id'));
            $this->tdz_model->insert_data('tbl_client', $_POST);
            redirect(base_url('clients'));
        }
        $city= $this->db->get('tbl_city')->result();
        $client = $this->db->get('tbl_client')->result();
        $load = "backend/management_area/clients_view";
        $this->pageLoader($load, $array = array($city, $client), $dataTitle = array('data', 'client'));
    }
    function staff()
    {
        if ($_POST)
        {
            unset($_POST['submit']);          
            $_POST['password'] = $this->tdz_model->enc($_POST['password']);
            $extra_fields = $this->tdz_model->getFields('tbl_user', array('id'));
            $this->tdz_model->insert_data('tbl_user', $_POST);
            redirect(base_url('staff'));
        }
        $this->db->where('id !=', 1);
        $accType = $this->db->get('tbl_account_type')->result();
        $question = $this->db->get('tbl_questions')->result();
        $this->db->join('tbl_account_type', 'tbl_account_type.id = tbl_user.account_type');
        $this->db->where('tbl_user.account_type !=', 1);
        $this->db->where('tbl_user.account_type !=', 6);
        $staff = $this->db->get('tbl_user')->result();
        $load = "backend/management_area/staff_view";
        $this->pageLoader($load, $array = array($accType, $question, $staff), $dataTitle = array('accType', 'question', 'staff'));
    }

}
