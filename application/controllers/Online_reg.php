<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Online_reg extends Bodhi_Controller {

	public function index()
	{		
die('<div style="font-weight:bold;text-align:center;font-size: 20px;margin: auto;margin-top:16%;width:700px;">We are sorry to inform you that the online registration for events have been closed. But, you can always go for our spot registration. Be there when it happens :)</div>');
		if($this->session->userdata('user_id') > 0)
		{
			redirect(base_url().'online-register/step2');
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required|alpha_space|min_length[3]');
        $this->form_validation->set_rules('college', 'College', 'required|min_length[3]');
        $this->form_validation->set_rules('dept', 'Department', 'alpha_space|max_length[3]');
        $this->form_validation->set_rules('dept-text', 'Department', 'alpha_space|max_length[30]');		
		$this->form_validation->set_rules('cno', 'Contact Number', 'required|numeric|min_length[5]|max_length[15]');
		$this->form_validation->set_rules('ce', 'Contact Email', 'required|valid_email|min_length[6]');
		$ret = array("status" => false, "result" => "");
		$data["result"] = "";
	
		if(!$this->input->post("dept-text") && !$this->input->post("dept") && $_POST)
		{
			$ret["result"] = $data["result"] = "<li>You need to specify department.</li>";
		}
		
		if ($this->form_validation->run() === false)
		{
			$ret["result"] .= $data["result"] .= validation_errors('<li>','</li>');
		} 
		else if(!$ret["status"] && $ret["result"] == "")
		{
			if($this->input->post("dept-text"))
			{
				$dept = $this->input->post("dept-text");
			}
			else
			{
				$dept = $this->input->post("dept");
			}
			$ret["status"] = true;
		    $posts = $this->input->post(NULL, TRUE);
			$query = $this->db->query("SELECT user_id, auth_key FROM online_regs WHERE cno=".$posts['cno']." OR email='".$posts['ce']."' LIMIT 1");
			if($query->num_rows() == 0)
			{
				$this->db->trans_start();
				$regt = time();
				$query = $this->db->query("INSERT INTO online_regs(username,name,email,user_regdate,college,dept,cno) VALUES('','".$posts['name']."', '".$posts['ce']."', ".$regt.", '".$posts['college']."', '".strtoupper($dept)."', ".$posts['cno'].")");
				$id = $this->db->insert_id();
				$uname = "bodhi".$id;
				$key = md5($uname.$regt);
				$this->session->set_userdata('user_id', $id);
				$query = "UPDATE online_regs SET username='".$uname."', auth_key='".$key."' WHERE user_id=".$id;
				$this->db->trans_complete();
								
				$msg = 'Dear  '.$posts['name'].',
<br><br>
You have successfully completed the step 1 registration for Bodhi 2013
National Level Technical and Cultural Fest organised by
VJCET,Vazhakulam.
<br><br>
Your Details are as follows :<br>
Email : '.$posts['ce'].'<br>
Phone No: '.$posts['cno'].'<br>
College : '.$posts['college'].'<br>
Department : '.strtoupper($dept).'<br>
<br>
<b>Your Bodhi 2013 ID : <i>'.$uname.'</i></b><br>
<br><br>
At anytime you can update your event registration here : <a href="www.bodhiofficial.in/online-register/step2/'.$key.'">www.bodhiofficial.in/online-register/step2/'.$key.'</a>
<br><br>
Thank You,<br>
Bodhi 2k13 Team<br>
<br>
For more details visit <a href="www.bodhiofficial.in">www.bodhiofficial.in</a> or drop a mail to
webmaster@bodhiofficial.in <i>for hugs or bugs</i>.
<br><br><br>
Like us of fb :- <a href="https://www.facebook.com/bodhiofficial">https://www.facebook.com/bodhiofficial</a>';
				$this->load->library('email');

				$this->email->from('support@bodhiofficial.in', 'Bodhi2k13');
				$this->email->to($posts['ce']);
				$this->email->subject('Bodhi 2013 - Registration details');
				$this->email->message($msg);
				$this->email->send();
		
				if($this->db->query($query) && !$this->input->is_ajax_request())
				{
					redirect(base_url().'online-register/step2');
				}
			}
			else
			{
				$usd = $query->result_array();
				redirect(base_url().'online-register/step2/'.$usd[0]["auth_key"]);
			}
		}
		if(!$this->input->is_ajax_request())
		{
			$this->load->view('online_reg/step1',$data);
		}
		else
		{
			$this->output->append_output(json_encode($ret));
		}
	}
	
	public function step2($key = '')
	{	
die('<div style="font-weight:bold;text-align:center;font-size: 20px;margin: auto;margin-top:16%;width:700px;">We are sorry to inform you that the online registration for events have been closed. But, you can always go for our spot registration. Be there when it happens :)</div>');
		if((!$this->session->userdata('user_id') ||  $this->session->userdata('user_id') == '0') && $key == '')
		{
			redirect(base_url().'online-register/step1');
		} 
		$this->load->library('form_validation');
		$this->form_validation->set_rules('events', 'Events', 'required');
		$data = array();
		$data["egroups"] = array();
		$data["error"] = true;
		$data["param_key"] = $key;
		
			if($this->session->userdata('user_id'))
			{
				$where = " user_id = ".$this->session->userdata('user_id');
			}
			else 
			{
				$where = " auth_key = '".$key."'";
			}
			$query = $this->db->query("SELECT * FROM online_regs WHERE ".$where." LIMIT 1");
			$data["rows"] = $query->num_rows();
			$data["usd"] = $query->result_array();
			
		if($_POST && $this->form_validation->run() === true)
		{
			$data["error"] = false;
			
			$datas =array();
			$pevents = $this->input->post("events"); 
		    //$query = $this->db->query("INSERT INTO event_regs(events,user_id) VALUES('".serialize($pevents)."',".$this->session->userdata('user_id').")");			
			$this->db->trans_start();
			if($key != '')
			{
				$this->db->query("DELETE FROM event_regs WHERE user_id = ".$data["usd"][0]["user_id"]);
				$sub = 'Bodhi 2013 : Your Registration has been Updated';
			}
			else
			{
				$sub = 'Bodhi 2013 : Your Registration is Complete';
			}
			
			$query = $this->db->query("SELECT * FROM events");
			$te = $query->result_array();
			$data["events"] = array();
		
			foreach($te as $k => $v)
			{
				$data["events"][$v["event_id"]] = $v["event_name"];
			}
			
			$event_reged = '<ol>';
			for($i=0; $i<count($pevents); $i++) 
			{
				$datas[$i] = array(
					'event' => $pevents[$i], 
					'user_id' => $data["usd"][0]["user_id"]
				);
				$event_reged .= '<li>'.$data["events"][$pevents[$i]].'</li>';
			}
			$event_reged .= '</ol>';
			$this->db->insert_batch('event_regs', $datas);
			$this->db->trans_complete();
			
				$msg = 'Dear  '.$data["usd"][0]['name'].',
<br><br>
Thank you for registering for Bodhi 2k13 , National Level Technical
and Cultural Fest organised by VJCET,Vazhakulam.
<br><br>
The events you registered for are mentioned below :<br>
'.$event_reged.'
<br><br>
Note: <i>Please don\'t forget to bring your College ID Card. College ID
Card is a must for you to participate in Events. Registration Fees and
other details will be mailed to you soon.</i>
<br><br>
<b>Your Bodhi 2013 ID : <i>'.$data["usd"][0]['username'].'</i></b><br>
<br><br>
At anytime you can update your event registration here : <a href="www.bodhiofficial.in/online-register/step2/'.$data["usd"][0]['auth_key'].'">www.bodhiofficial.in/online-register/step2/'.$data["usd"][0]['auth_key'].'</a>
<br><br>
Thank You,<br>
Bodhi 2k13 Team<br>
<br>
For more details visit <a href="www.bodhiofficial.in">www.bodhiofficial.in</a> or drop a mail to
webmaster@bodhiofficial.in <i>for hugs or bugs</i>.
<br><br><br>
Like us of fb :- <a href="https://www.facebook.com/bodhiofficial">https://www.facebook.com/bodhiofficial</a>';
				$this->load->library('email');

				$this->email->from('support@bodhiofficial.in', 'Bodhi2k13');
				$this->email->to($data["usd"][0]['email']);
				$this->email->subject($sub);
				$this->email->message($msg);
				$this->email->send();
			
			$this->session->set_userdata('user_id',0); 
		}
		else if($this->form_validation->run() === false)
		{				
			$query = $this->db->get('event_groups');
			$row = $query->result();
			$i = 0;
			
			foreach($row as $k => $v)
			{
			   $data["egroups"][$i]["id"] = $v->group_id;
			   $data["egroups"][$i]["name"] = $v->group_name;
			   $query = $this->db->get_where('events', "group_id = ".$v->group_id);
			   $data["egroups"][$i]["events"] = $query->result();
			   $i++;
			}
			
			$data["user_regs"] = array();
			if($data["rows"]>0) {
			if(!$this->session->userdata('user_id'))
			{
				$where = " user_id = ".$data["usd"][0]["user_id"];
			}
			$query = $this->db->query("SELECT * FROM event_regs WHERE ".$where." LIMIT 100");
			$data["user_regs"] = $query->result_array();
			}
		}
		$this->load->view('online_reg/step2',$data);
	}
}