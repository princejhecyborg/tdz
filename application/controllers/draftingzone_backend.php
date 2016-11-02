<?php
include('draftingzone.php');
class draftingzone_backend extends draftingzone{

    function __construct()
    {
        parent::__construct();
    }
    function backend()
    {
        $load = "backend/home";
        $this->pageLoader($load, $data= array(), $dataTitle = array());
    }

    function newjob()
    {  
        if($_POST)
        {
            unset($_POST['submit']);
            // for registration save
            $jobCode = $this->tdz_model->getJobCode($_POST['client_id']);
            $jobCode_extend = $this->tdz_model->getJobCodeExtend('get');
            $this->tdz_model->insert_data('tbl_registration', $_POST);
            $last_id = $this->db->insert_id();
            // for trackinglog save
            $post = array(
                    'registered_id'     => $last_id,
                    'is_urgent'         => 0,
                    'client_ref'        => $_POST['reference'],
                    'date'              => date('Y-m-d'),
                    'job_code'          => $jobCode.$jobCode_extend,
                    'job_name'          => $_POST['plan_name'],
                    'client_id'         => $_POST['client_id'],
                    'date_in'           => date('Y-m-d'),
                    'is_archive'        => 0,
                    'complete_date'     => '0000-00-00 00:00:00',
                    'cancel_date'       => '0000-00-00 00:00:00',
                    'admin_comment'     => '',
                    );
            $newJobcode = $jobCode_extend+1;
            $this->tdz_model->getJobCodeExtend($get = array('jobcode' => $newJobcode));
            $this->tdz_model->insert_data('tbl_trackinglog', $post);

            // for eta progress save
            $eta_status = $this->tdz_model->getRows('tbl_plan_type', $array = array('where' => array('id' => $_POST['plan_option'])));
            $eta_status = $eta_status->row();
            $eta_status_id = ($_POST['dp_id']==0) ? $eta_status->starting_status_id : $eta_status->starting_status_id+1;
            $etaPost = array('track_id' => $last_id, 'status_id' => $eta_status_id);
            $this->tdz_model->insert_data('tbl_eta_progress', $etaPost);
            $last_eta_id = $this->db->insert_id();

            // for assigning
            $getFirstphase = $this->tdz_model->getRows('tbl_phases', $data = array(
                    'where'             => array('plan_type_id'     => $_POST['plan_option']),
                    'order_by'          => array('plan_type_id'     => 'ASC'),
                    'limit'             => array('1'                => '')

                )
            );
            $getFirstphase = $getFirstphase->row();           
            $this->tdz_model->insert_data('tbl_assignments', $post = array(
                                                                        'eta_id'            => $last_eta_id,
                                                                        'job_id'            => $last_id, 
                                                                        'phase_id'          => $getFirstphase->id, 
                                                                        'dp_id'             => $_POST['dp_id'],
                                                                        'date_assigned'     => $date = (!empty($_POST['dp_id'])) ? date('Y-m-d') : "",
                                                                        'date_delivery'     => $date_delivery = (!empty($_POST['dp_id'])) ? date('Y-m-d', strtotime("+".$getFirstphase->on_time_limit." days")) : "",
                                                                        'actual_delivery'   => '0000-00-00',
                                                                        'time_up'           => '0.00',
                                                                        'checker_id'        => 0,
                                                                        'time_up_check'     => 0.00

                                                                    )
            );

            $extra_fields = $this->tdz_model->getFields('tbl_registration', array('id','notes'));
            if(count($extra_fields) > 0)
            {
                foreach($extra_fields as $fld){
                    if(array_key_exists($fld, $_POST)) {
                        $extra_post[$fld] = $_POST[$fld];
                        unset($_POST[$fld]);
                    }
                }
            }

            $notesArray = array(
                    'tdz_id'        => $last_id,
                    'user_id'       => $this->session->userdata('sessdp_id'),
                    'comments'      => $_POST['notes'],
                    'what_date'     => date('Y-m-d')
                );

                $this->tdz_model->insert_data('tbl_comments', $notesArray);

            // load view 
            redirect(base_url('trackinglog')); 
        }

        // for new job view
        $planType = $this->tdz_model->getRows('tbl_plan_type', $array = array('where' => array('is_for_edit' => 0)));
        $jobtype = $this->tdz_model->getRows('tbl_job_type', $array = array());
        $staff = $this->tdz_model->getRows('tbl_user', $array = array('where' => array('account_type' => 2, 'is_active' => 1)));
        $client = $this->tdz_model->getRows('tbl_client', $array=array());
        $load = "backend/tracking_area/newjob_view";
        $this->pageLoader($load, $data = array($client->result(), $staff->result(), $jobtype->result(), $planType->result()), $dataTitle = array('client', 'staff', 'jobtype', 'planType'));
    }

    function trackinglog()
    {
        $load = "backend/tracking_area/current_tracking_view";
        if (isset($_POST['jobsubmit']))
        {
            unset($_POST['jobsubmit']);
            $this->tdz_model->delete('tbl_trackinglog', $_POST['jobcode'], $whatid = 'job_code');
            redirect(base_url('trackinglog'));
        }
        if ($this->session->userdata('sessionid')==1)
        {
            $tracking = $this->tdz_model->getRows('tbl_trackinglog', $array = array(
                    'join'          => array(
                                    'type'              => 'LEFT OUTER',
                                    'tbl_eta_progress'  => 'tbl_eta_progress.track_id = tbl_trackinglog.id',
                                    'tbl_status'        => 'tbl_status.id = tbl_eta_progress.status_id',
                                    'tbl_color_state'   => 'tbl_color_state.name = tbl_status.color_state',
                                    'tbl_client'        => 'tbl_client.id = tbl_trackinglog.client',
                                    'tbl_registration'  => 'tbl_registration.id = tbl_trackinglog.tdz_id',
                                    'tbl_job_type'      => 'tbl_job_type.id = tbl_registration.plan_type',
                                    'tbl_user'          => 'tbl_user.id = tbl_registration.dp_id'
                                    ),
                    'order_by'      => array('tbl_trackinglog.id' => 'DESC'),
                    'where'         => array('datein LIKE' => '%2016-10%'),
                    // 'limit'         => array(20 => '')
                )
            );
            $unassigned = $this->tdz_model->countRows('tbl_trackinglog', $array = array(
                    'where'         => array("dp_id" => 0),  
                    'join'          => array(
                                        "tbl_registration"              => "tbl_registration.id = tbl_trackinglog.tdz_id",
                                    ),
                )
            );
            $urgent = $this->tdz_model->countRows('tbl_trackinglog', $array = array('where' => array('tdz_priority' => 1)));
            $this->pageLoader($load, $data = array($tracking->result(), $unassigned, $urgent), $dataTitle = array('tracking', 'unassigned', 'urgent'));
        }
        elseif ($this->session->userdata('sessionid')==2)
        {
            if (isset($_POST['start']))
            {
                unset($_POST['start']);
                $getJobID = $this->tdz_model->getRows('tbl_trackinglog', $array = array('where' => array('job_code'  => $_POST['getJobID'])));
                $getJobID = $getJobID->row();
                $start_array = array(
                        'job_id'    => $getJobID->id,
                        'eta_id'    => $getJobID->id,
                        'acc_id'    => $_POST['accomplishmentCode'],
                        'dp_id'     => $this->session->userdata('sessdp_id'),
                        'time_start'      => date('Y-m-d h:i.s A')
                    );
                $this->tdz_model->insert_data('tbl_daily_accomplishment', $start_array);
                $startLast_id = $this->db->insert_id();
                $startjob = $this->tdz_model->getRows('tbl_daily_accomplishment', $array = array(
                        'where'     => array('tbl_daily_accomplishment.d_id' => $startLast_id),
                        'join'      => array(
                                    'tbl_trackinglog'      => 'tbl_trackinglog.id=tbl_daily_accomplishment.job_id',
                                    'tbl_daily_accomplishment_code' => 'tbl_daily_accomplishment_code.id = tbl_daily_accomplishment.acc_id'
                                    )
                        )
                );
                $startjob = (isset($startjob)) ? $startjob->row() : $startjob->row();
            }
            else
            {
                $startjob = "";
            }

            // action either pending or finish
            if(isset($_POST['action']))
            {
                switch ($_POST['action'])
                {
                    case 'Pending':
                        $updateArray = array(
                                'status'            => $_POST['action']          
                            );
                        break;
                    case 'Finish':
                        $updateArray = array(
                                'time_end'          =>  date('Y-m-d h:i.s'),
                                'status'            => $_POST['action']
                            );
                        break;
                    default:
                        redirect(base_url('trackinglog'));
                        break;
                }
                $this->tdz_model->edit('tbl_daily_accomplishment', $updateArray, $_POST['d_id'], $whatid = "d_id");
                $forTotal = $this->tdz_model->getRows('tbl_daily_accomplishment', $array = array('where' => array('d_id' => $_POST['d_id'])));
                $forTotal = $forTotal->row();
                $end = new DateTIme($forTotal->time_end); 
                $first = new DateTIme($forTotal->time_start);
                $interval = $first->diff($end);
                $total = $interval->format("%h:%i");
                $hourmin = explode(':', $total);
                $hour = 12-$hourmin[0];
                $min = 60-$hourmin[1];
                $this->tdz_model->insert_data('tbl_daily_accomplishment_diff', $array = array('daily_acc_id' => $_POST['d_id'], 'hour_total' => $hour, 'min_total' => $min));
                unset($_POST);
                redirect(base_url('trackinglog'));
            }

            // viewing viewplan
            $tracking = $this->tdz_model->getRows('tbl_trackinglog', $array = array(
                    'join'          => array(
                                    'type'              => 'LEFT OUTER',
                                    'tbl_eta_progress'  => 'tbl_eta_progress.track_id = tbl_trackinglog.id',
                                    'tbl_status'        => 'tbl_status.id = tbl_eta_progress.status_id',
                                    'tbl_client'        => 'tbl_client.id = tbl_trackinglog.client_id',
                                    'tbl_registration'  => 'tbl_registration.id = tbl_trackinglog.tdz_id',
                                    'tbl_job_type'      => 'tbl_job_type.id = tbl_registration.plan_type',
                                    'tbl_user'          => 'tbl_user.id = tbl_registration.dp_id'
                                    ),
                    'where'         => array('tbl_registration.dp_id' => $this->session->userdata('sessdp_id')),
                )
            );
            $urgent = $this->tdz_model->countRows('tbl_trackinglog', $array = array(
                    'join'          => array(
                                    'tbl_registration' => 'tbl_registration.id =  tbl_trackinglog.registered_id',
                        ),
                    'where'         => array(
                                    'is_urgent' => 1,
                                    'dp_id'     => $this->session->userdata('sessdp_id')
                        )
                    )
            );
            $this->pageLoader($load, $data = array($tracking->result(), $urgent, $startjob), $dataTitle = array('tracking', 'urgent', 'startjob'));
        }   
    }

    function viewplan()
    {
        $id = $this->uri->segment(2);

        // for tracking result
        $trackingResult = $this->tdz_model->getRows('tbl_trackinglog', $array = array(
                'where'         => array('tbl_trackinglog.id' => $id),
                'join'          => array(
                                'type'                  => 'LEFT OUTER',
                                'tbl_eta_progress'      => 'tbl_eta_progress.track_id = tbl_trackinglog.id',
                                'tbl_status'            => 'tbl_status.id = tbl_eta_progress.status_id',
                                'tbl_registration'      => 'tbl_registration.id = tbl_trackinglog.tdz_id',
                                'tbl_job_type'          => 'tbl_job_type.id = tbl_registration.plan_type',
                                'tbl_user'              => 'tbl_user.id = tbl_registration.dp_id',
                                'tbl_client'            => 'tbl_client.id = tbl_trackinglog.client' 
                    )
            )
        );

        // for daily accomplishments
        $dailyaccomplishment = $this->tdz_model->getRows('tbl_daily_accomplishment', $array = array(
                'where'         => array('tbl_daily_accomplishment.dp_id'        => $this->session->userdata('sessdp_id')),
                'join'          => array(
                                'type'                             => 'LEFT OUTER',
                                'tbl_daily_accomplishment_diff'    => 'tbl_daily_accomplishment_diff.daily_acc_id = tbl_daily_accomplishment.d_id',
                                'tbl_trackinglog'                  => 'tbl_trackinglog.id = tbl_daily_accomplishment.job_id',
                                'tbl_daily_accomplishment_code'    => 'tbl_daily_accomplishment_code.id = tbl_daily_accomplishment.acc_id'
                    )
            )
        );
        $hour = $this->tdz_model->sumHourMin('hour_total');
        $min = $this->tdz_model->sumHourMin('min_total');
        if ($min->min_total>60)
        {
            $minHour = date('i.s', $min->min_total);
            $total = $hour->hour_total + $minHour;
        }
        else
        {
            $total = $hour->hour_total.".".$min->min_total;
        }

        // for drafting progress
       
        $draft_progress = $this->tdz_model->getRows('tbl_assignments', $array = array(
                'join'          => array(
                                'type'                  => 'LEFT OUTER',
                                'tbl_eta_progress'      => 'tbl_eta_progress.id = tbl_assignments.eta_id',
                                'tbl_phases'            => 'tbl_phases.id = tbl_assignments.phase_id',
                                'tbl_user'              => 'tbl_user.id = tbl_assignments.dp_id',
                    ),
                'where'         => array('job_id'       => $id)
            )
        );
        $row = $draft_progress->result();

        // $this->displayArray($row);exit;
        end($row);        
        $key = key($row);

        // to get the last and next phase
        $getlastPhase = $this->tdz_model->getRows('tbl_assignments', $array = array(
                'join'          => array(
                                'type'                  => 'LEFT OUTER',
                                'tbl_registration'      => 'tbl_registration.id = tbl_assignments.job_id',
                                'tbl_eta_progress'      => 'tbl_eta_progress.id = tbl_assignments.eta_id',
                                'tbl_phases'            => 'tbl_phases.id = tbl_assignments.phase_id',
                                'tbl_user'              => 'tbl_user.id = tbl_assignments.dp_id'
                    ),
                'where'         => array('job_id'               => $id),
                'order_by'      => array('tbl_assignments.id'   => 'DESC'),
                'limit'         => array(1                      => '')
            )
        );
        $getlastPhase = $getlastPhase->row();
        if (count($getlastPhase)>0)
        {
            $nextPhase = $this->tdz_model->getRows('tbl_plan_type_phases', $data = array(
                    'where'         => array('tbl_plan_type_phases.phase_id'       => $getlastPhase->phase_id+1) ,
                    )
                );
            $nextPhase = $nextPhase->row();
            // $this->displayArray($nextPhase);

            $nextTitle = $this->tdz_model->getRows('tbl_plan_type_phases', $data = array(
                    'where'         => array('tbl_plan_type_phases.plan_type_id'          => $nextPhase->phase_id),
                    'join'          => array('tbl_phases'                                 => 'tbl_phases.id = tbl_plan_type_phases.phase_id')
                )
            );
            $nextTitle = $nextTitle->row();

            // $this->displayArray($nextTitle);exit;



            // for next phase_id
            if (isset($_POST['nextphase']))
            {
                unset($_POST['nextphase']);
                $getFirstphase = $this->tdz_model->getRows('tbl_phases', $data = array(
                    'where'         => array('tbl_phases.id'       => $nextPhase->phase_id),
                    )
                );
                $getFirstphase = $getFirstphase->row();
                $nextPhase_array = array(
                    'eta_id'            => $id,
                    'job_id'            => $id,
                    'phase_id'          => $this->input->post('phase_id'),
                    'dp_id'             => $this->input->post('dp_id'),
                    'date_assigned'     => $date = (!empty($_POST['dp_id'])) ? date('Y-m-d') : "",
                    'date_delivery'     => $date_delivery = (!empty($_POST['dp_id'])) ? date('Y-m-d', strtotime("+".$getFirstphase->on_time_limit." days")) : "",
                );
                $this->tdz_model->insert_data('tbl_assignments', $nextPhase_array);
                $this->tdz_model->edit('tbl_eta_progress', $array = array('status_id' => $_POST['skip_status']), $id, $whatid = 'track_id');
                redirect(base_url('viewplan/'.$id));
            }

            if(isset($_POST['assignDP']))
            {
                unset($_POST['assignDP']);

                $getFirstphase = $this->tdz_model->getRows('tbl_phases', $data = array('where'=> array('id'     => $_POST['assign_id'])));
                $getFirstphase = $getFirstphase->row();
                $data = array(
                    'dp_id' => $_POST['dp_id'], 
                    'date_assigned' => date('Y-m-d'), 
                    'date_delivery' =>date('Y-m-d', strtotime("+".$getFirstphase->on_time_limit." days"))
                );
                $this->tdz_model->editAssignPhase($data, $id, $_POST['assign_id']);
                $this->tdz_model->edit('tbl_registration', $data = array('dp_id'=> $_POST['dp_id']), $id, $whatid ='id');
                $getEta = $this->tdz_model->getRows('tbl_eta_progress', $array = array('where' => array('track_id' => $id)));
                $getEta = $getEta->row();
                $this->tdz_model->edit('tbl_eta_progress', $data = array('status_id' => $getEta->status_id+1), $id, $whatid = 'id');

                // load view
                redirect(base_url('viewplan/'.$id));
            }
        }
        else
        {
            $nextPhase = '';
            $nextTitle = '';
        }

        if (isset($_POST['changeinfo']))
        {
            unset($_POST['changeinfo']);
            $update = $this->tdz_model->edit('tbl_trackinglog', $data = array('is_urgent' => $_POST['is_urgent']), $_POST['id']);
            redirect(base_url('viewplan/'.$id));
        }

        // for force finish
        if (isset($_POST['finish']))
        {
            unset($_POST['finish']);
            $update = array(
                'actual_delivery'       => $_POST['actual_delivery'],
                'time_up'               => $_POST['time_up'],
                'checker_id'            => $_POST['checker_id'],
                'time_up_check'         => $_POST['time_up_check'],
            );
            $post_Id = explode("-", $_POST['id']);
            $this->db->where('job_id', $post_Id[0]);
            $this->db->where('phase_id', $post_Id[1]);
            $this->db->update('tbl_assignments', $update);
            $this->tdz_model->edit('tbl_eta_progress', $array = array('status_id' => $_POST['skip_status']), $id, $whatid = 'track_id');

            redirect(base_url('viewplan/'.$id));
        }

        // for skip process
        if (isset($_POST['skip_status']))
        {
            $this->tdz_model->edit('tbl_eta_progress', $array = array('status_id' => $_POST['skip_status']), $id, $whatid = 'track_id');
            $newphase = $this->tdz_model->getRows('tbl_status', $array = array('where'   => array('id'   => $_POST['skip_status'])));
            $newphase = $newphase->row();
            $insertArray = array(
                    'eta_id'    => $id,
                    'job_id'    => $id,
                    'phase_id'  => $newphase->next_phase,
                );
            $this->tdz_model->insert_data('tbl_assignments', $insertArray);
            redirect(base_url('viewplan/'.$id));
        }


        // for comments view
        $comments_view = $this->tdz_model->getRows('tbl_comments', $array = array(
                'where'         => array('tdz_id'       => $id),
                'join'          => array('tbl_user'     => 'tbl_user.id = tbl_comments.user_id'),
                'order_by'      => array('what_date'    => 'ASC'),
                )
        );
        // end of comments view

        $staff = $this->tdz_model->getRows('tbl_user', $array = array('where' => array('account_type' => 2, 'is_active' => 1)));
        $trackingResult = $trackingResult->row();
        $headerview = " - ".$trackingResult->job_code." ".$trackingResult->job_name;
        $load = "backend/tracking_area/viewplan_view";
        $this->pageLoader($load, $data = array($headerview,$trackingResult, $draft_progress, $staff, $nextTitle, $key, $dailyaccomplishment, $total, $comments_view), $dataTitle = array('headerview', 'trackingResult', 'draft_progress', 'staff','nextTitle', 'key', 'dailyaccomplishment','total','comments_view'));
    }

    function urgentjobs()
    {
        $this->data['urgent'] = $this->tdz_model->getRows('tbl_trackinglog', $array = array(
                'where'     => array('is_urgent' => 1),
                'join'      => array('tbl_registration' => 'tbl_registration.id = tbl_trackinglog.tdz_id')
            )
        );
        $this->data['count'] = $this->tdz_model->countRows('tbl_trackinglog', $array);
        $this->load->view('backend/pdf_files/urgentjobs_view', $this->data);
    }

    function unassigned()
    {
        $this->data['unassigned'] = $this->tdz_model->getRows('tbl_registration', $array = array(
                'where'     => array('dp_id' => 0),
                'join'      => array('tbl_trackinglog' => 'tbl_trackinglog.tdz_id = tbl_registration.id')
            )
        );
        $this->data['count'] = $this->tdz_model->countRows('tbl_registration', $array);
        $this->load->view('backend/pdf_files/unassignedjobs_view', $this->data);
    }

    function jobedit()
    {
        $id = $this->uri->segment(2);
        if (isset($_POST['submit']))
        {
            unset($_POST['submit']);
            $extra_fields = $this->tdz_model->getFields('tbl_registration', array('id'));
            $updatejob = $this->tdz_model->edit('tbl_registration', $_POST, $id);
            $this->data['successmsg'] = $this->session->set_userdata(array('successmsg' => 'Job updated successfully!'));
            redirect(base_url('jobedit/'.$id, $this->data));
        }
        $trackingResult = $this->tdz_model->getRows('tbl_trackinglog', $array = array(
                'where'         => array('tbl_trackinglog.id' => $id),
                'join'          => array(
                                'type'                  => 'LEFT OUTER',
                                'tbl_eta_progress'      => 'tbl_eta_progress.track_id = tbl_trackinglog.id',
                                'tbl_status'            => 'tbl_status.id = tbl_eta_progress.status_id',
                                'tbl_registration'      => 'tbl_registration.id = tbl_trackinglog.tdz_id',
                                'tbl_job_type'          => 'tbl_job_type.id = tbl_registration.plan_type',
                                'tbl_user'              => 'tbl_user.id = tbl_registration.dp_id' 
                    )
            )
        );
        $trackingResult = $trackingResult->row();
        $headerview = " - ".$trackingResult->job_code." ".$trackingResult->job_name;
        $jobtype = $this->tdz_model->getRows('tbl_job_type', $array = array());
        $staff = $this->tdz_model->getRows('tbl_user', $array = array('where' => array('account_type' => 2, 'is_active' => 1)));
        $client = $this->tdz_model->getRows('tbl_client', $array=array());
        $load = "backend/tracking_area/editjob_view";
        $this->pageLoader($load, $data = array($headerview, $staff->result(), $client->result(), $trackingResult, $jobtype->result()), $dataTitle = array('headerview','staff', 'client', 'trackingResult', 'jobtype'));
    }

    function getaccomplishments($id)
    {
        $accomplishments = $this->tdz_model->getRows('tbl_daily_accomplishment_code', $array = array('where' => array('plan_type_id' => $id)));
        echo json_encode($accomplishments->result());
    }
    function addcomment()
    {
        $commentArray = array(
            'tdz_id'        => $_POST['tdz_id'],
            'user_id'       => $this->session->userdata('sessdp_id'),
            'comments'      => $_POST['comment'],
            'what_date'     => date('Y-m-d h:i.s'),
            );
        $this->tdz_model->insert_data('tbl_comments', $commentArray);
        $last = $this->db->insert_id();
        $comments_view = $this->tdz_model->getRows('tbl_comments', $array = array(
                'where'         => array('tdz_id'       => $_POST['tdz_id'], 'tbl_comments.id' => $last),
                'join'          => array('tbl_user'     => 'tbl_user.id = tbl_comments.user_id'),
                'order_by'      => array('what_date'    => 'ASC')
                )
        );
        echo json_encode($comments_view->result());
    }
    function jobques()
    {
        $load = 'backend/tracking_area/jobques_view';
        $this->pageLoader($load, $data = array(), $dataTitle = array());
    }

}
