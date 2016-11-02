<?php

class draftingzone extends CI_Controller{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
    }

    function index()
    {
        if ($this->input->post('login')) {
            unset($_POST['login']);
            $err_msg = array("err_msg" => "Invalid Username/Password.");
            $password = $this->tdz_model->enc($_POST['password']);
            $this->db->where('username', $_POST['username']);
            $this->db->where('password', $password);
            $query = $this->db->get('tbl_user');


            if ($query->num_rows() > 0)
            {
                foreach ($query->result() as $value) {
                    $name = $value->name;
                    $dp_id = $value->id;
                    $this->db->where('id', $value->account_type);
                    $acc_type = $this->db->get('tbl_account_type')->result();
                    foreach ($acc_type as $val) {
                        $session_acc = $val->account_type;
                        $homepage = $val->home_page;
                        $id = $val->id;
                    }
                }
                $sessdp_id = array('sessdp_id' =>$dp_id);
                $sessionLog = array('sessionLog' => $name);
                $sessionid = array('sessionid' => $id);
                $session_acc = array('session_acc' => $session_acc);
                $data['sessdp_id'] = $this->session->set_userdata($sessdp_id);
                $data['sessionLog'] = $this->session->set_userdata($sessionLog);
                $data['session_acc'] = $this->session->set_userdata($session_acc);
                $data['sessionid'] = $this->session->set_userdata($sessionid);
                redirect(base_url($homepage), $data);
            }
            else
            {
                $data['sessionLog'] = $this->session->set_userdata($err_msg);
                redirect(base_url('login'), $data);
            }

        }    
        $segment = $this->uri->segment(1);
        $uri = (!empty($segment)) ? "_view" : "content_view";
        $this->data['security_question'] = $this->db->get('tbl_questions')->result();
        $this->data['load_page'] = $segment.$uri;
        $this->data['projects_page'] = $this->db->get('tbl_projects_page')->result();
        $this->load->view('draftingzone_view', $this->data);

    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url(''));
    }
    function notfound()
    {
        $this->load->view('pagenotfound');
    }
    function displayArray($ar, $color = "000"){
        echo '<pre style="z-index:9999;color:#'.$color.'">';
        print_r($ar);
        echo '</pre><br style="clear:both;" /><br />';
    }
    function pageLoader($load, $data, $dataTitle)
    {
        $link = $this->uri->segment(1);
        $this->data['pageTitle'] = $this->tdz_model->pageTitle($link);
        $this->data['load_page'] = $load;
        $count = count($data);
        for($i = 0; $i<$count; $i++){
            $this->data[$dataTitle[$i]] = $data[$i];
        }
        $this->data['headerLinks'] = $this->tdz_model->headerLinks($this->session->userdata('sessionid'));
        foreach ($this->data['headerLinks'] as  $value) {
            $this->db->where('tbl_pages.parent_id', $value->id);
            $this->db->join('tbl_page_per_account', 'tbl_page_per_account.page_id = tbl_pages.id', 'LEFT OUTER');
            $this->db->where('tbl_page_per_account.account_type', $this->session->userdata('sessionid'));
            $this->db->join('tbl_page_titles', 'tbl_page_titles.id = tbl_pages.page_title_id', 'LEFT OUTER');
            $this->data['subLinks'] = $this->db->get('tbl_pages')->result();
        }
        $this->load->view('backend/header', $this->data);
    }
    function forgot_pass(){
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where('username', $_POST['username']);
        $this->db->where('question', $_POST['security_question']);
        $this->db->where('answer', $_POST['answer']);
        $data1 = $this->db->get()->row();
        if(!empty($data1->id)) {
            $new_pass = $this->tdz_model->enc($_POST['new_pass']);
            $new_user_pass = array('password' => $new_pass);
            $this->db->where('id', $data1->id);
            $this->db->update('tbl_user', $new_user_pass);
            echo "1";
        }else {
            echo "0";
        }        
    }
}
