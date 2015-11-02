<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Bodhi_Controller {

	public function index()
	{
		if(!$this->input->cookie('is_admin1'))
		{
			redirect(base_url().'admin/login');
		}
		$data = array();
		/*
		      $q="select events.event_name as event,count(`event_regs`.reg_id) as num, 0 from `event_regs`,`events`  where `event_regs`.event=events.event_id group by `event_regs`.event order by num desc";

 $query = "(select 0,count(user_id) as num,0 from `online_regs`) 
 union ($q limit 0,5 ) 
 union (SELECT name as event,college as num,0 FROM `online_regs` order by user_id desc limit 0,5)
 union (select college as event , count(*) as num,0 from `online_regs` where LOWER(college) not like '%viswajyothi%' group by college order by num desc limit 0,5)
 union (select event_name as event , stopped as num, group_id as groupe from `events` where stopped=1 )";

    
	    $result2 = $this->db->query($query); 
		$data["e"] = $result2->result_array();

		$result2 = $this->db->query($q); 
		$data["a"] = $result2->result_array();
		
			$query = $this->db->get('event_groups');
			$tres = $query->result();
			foreach($tres as $k => $v)
			{
				$data["groups"][$v->group_id] = $v->group_name;
			}
*/
        $q="select events.event_name as event,count(`event_regs`.reg_id) as num from `event_regs`,`events`,`online_regs`  where `event_regs`.user_id=`online_regs`.user_id and `online_regs`.confirm=1 and `event_regs`.event=events.event_id group by `event_regs`.event order by num desc";

		$result2 = $this->db->query("select count(user_id) as num from `online_regs` where confirm=1");
		$data["total"] = $result2->result_array();
	
		$result2 = $this->db->query($q." limit 0,5");
		$data["recently"] = $result2->result_array();
		
		$result2 = $this->db->query("SELECT name as event,college as num FROM `online_regs` where confirm=1 order by user_id desc limit 0,5");
		$data["top_eve"] = $result2->result_array();
		
		$result2 = $this->db->query("select college as event , count(*) as num from `online_regs` where LOWER(college) not like '%viswajyothi%' and confirm=1 group by college order by num desc limit 0,5");
		$data["top_external"] = $result2->result_array();
		
		$result2 = $this->db->query("select event_name as event , stopped as num from `events` where stopped=1");
		$data["stopped"] = $result2->result_array();
		
		$result2 = $this->db->query($q);
		$data["whole"] = $result2->result_array();

		$this->load->view('admin/header',$data);
		$this->load->view('admin/home',$data);
		$this->load->view('admin/footer',$data);
	}
		
	public function del_regs($id = 0)
	{
		if(!$this->input->cookie('is_admin1'))
		{
			redirect(base_url().'admin/login');
		}
		
		if($id==0)
		{
			echo 'no one here!';
			return;
		}
		$this->db->trans_start();
		$this->db->query("DELETE FROM event_regs WHERE user_id = ".$id);
		$this->db->query("DELETE FROM online_regs WHERE user_id = ".$id);
		$this->db->trans_complete();
		redirect(base_url().'admin/view-registrations');
	}
	
	public function confirm_reg($id = 0)
	{
		if(!$this->input->cookie('is_admin1'))
		{
			redirect(base_url().'admin/login');
		}
		
		if($id==0)
		{
			echo 'registration for user not found!';
			return;
		}
		$this->db->query("UPDATE online_regs SET confirm = 1 WHERE user_id = ".$id);
		redirect(base_url().'admin/edit-reg/'.$id.'?confirm=true');
	}
	
	public function login()
	{
		if($this->input->cookie('is_admin1'))
		{
			redirect(base_url().'admin/');
		}
		$data = array();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Usermame', 'required|min_length[3]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]');
		
		if ($this->form_validation->run() === false)
		{
			
		}
		else
		{	
			if($this->input->post('username')=="badmin" && $this->input->post('password')=="pass#*me2vjcet")
			{
				setcookie('is_admin1','yes',time()+3600*24);
				redirect(base_url().'admin');
			}
		}
		
		//$this->load->view('admin/header',$data);
		$this->load->view('admin/login',$data);
		//$this->load->view('admin/footer',$data);
	}
	
	public function view_regs($page = 0)
	{
		if(!$this->input->cookie('is_admin1'))
		{
			redirect(base_url().'admin/login');
		}
		$limit = 20;
		$this->load->library('pagination');
		$data = array();

		$config['base_url'] = base_url().$this->uri->slash_segment(1,'both').$this->uri->slash_segment(2);
		$config['total_rows'] = $this->db->count_all('online_regs');
		$config['per_page'] = $limit; 
		$config['num_links'] = 50;
		$config['page_query_string'] = FALSE;
		$config['full_tag_open'] = '<p class="pages">';
		$config['full_tag_close'] = '</p>';
		$config['num_tag_open'] = '<span>';
		$config['num_tag_close'] = '</span>';
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<div>';
		$config['first_tag_close'] = '</div>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<div>';
		$config['last_tag_close'] = '</div>';
		
		$config['next_tag_open'] = '<span>';
		$config['next_tag_close'] = '</span>';
				$config['prev_tag_open'] = '<span>';
		$config['prev_tag_close'] = '</span>';
		$data['current_page'] = $page+1;

		$this->pagination->initialize($config); 

		$data["pages"] = $this->pagination->create_links();

		$query = $this->db->query("SELECT * FROM events");
		$te = $query->result_array();
		
		$query = $this->db->query("SELECT * FROM event_groups");
		$tg = $query->result_array();
		$data["events"] = array();
		
		foreach($tg as $k => $v)
		{
			$data["groups"][$v["group_id"]] = $v["group_name"];
		}
		
		foreach($te as $k => $v)
		{
			$data["events"][$v["event_id"]] = array("event_name" => $v["event_name"], "group_id" => $v["group_id"]);
		}
		
		$query = $this->db->query("SELECT * FROM online_regs LIMIT ".$page.", ".$limit);
		$data["regs"] = $query->result_array();
		foreach($data["regs"] as $k => $v)	
		{
			$query = $this->db->query("SELECT * FROM event_regs WHERE user_id = '".$v["user_id"]."' LIMIT 100");
			$data["regs"][$k]["reg_for_events"] = $query->result_array();
		}
		$this->load->view('admin/header',$data);
		$this->load->view('admin/view_regs',$data);
		$this->load->view('admin/footer',$data);
	}
	
	public function create_reg()
	{
		if(!$this->input->cookie('is_admin1'))
		{
			redirect(base_url().'admin/login');
		}
		
		$data = array();
		$data["egroups"] = array();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required|alpha_space|min_length[3]');
        $this->form_validation->set_rules('college', 'College', 'required|min_length[3]');
        $this->form_validation->set_rules('dept', 'Department', 'alpha_space|max_length[3]');
        $this->form_validation->set_rules('dept-text', 'Department', 'alpha_space|max_length[30]');		
		$this->form_validation->set_rules('cno', 'Contact Number', 'required|numeric|min_length[5]|max_length[15]|is_unique[online_regs.cno]');
		$this->form_validation->set_rules('ce', 'Contact Email', 'valid_email|min_length[6]|is_unique[online_regs.email]');
		$this->form_validation->set_rules('events', 'Events', 'required');
		$data["result"] = "";
		$data["done"] = "";
		$pevents = $this->input->post("events"); 
		
		/*	$query = $this->db->query("SELECT * FROM events");
			$te = $query->result_array();
			$data["events"] = array();
		
			foreach($te as $k => $v)
			{
				$data["events"][$v["event_id"]] = array("name" => $v["event_name"], "cost" => $v["cash"]);
			} */
			$cash = array();
			$query = $this->db->get('event_groups');
			$row = $query->result();
			$i = 0;
			
			foreach($row as $k => $v)
			{
			   $data["egroups"][$i]["name"] = $v->group_name;
			   $query = $this->db->get_where('events', "group_id = ".$v->group_id);
			   $data["egroups"][$i]["events"] = $query->result();
			   foreach($data["egroups"][$i]["events"] as $k => $v)
			   {
					$cash[$v->event_id] = $v->cash;
			   }
			   $i++;
			}

		if(!$this->input->post("dept-text") && !$this->input->post("dept") && $_POST)
		{
			$data["result"] = "You need to specify department.";
		}	
		if ($this->form_validation->run() === false)
		{
			$data["result"] .= validation_errors();
		}
		else if($this->input->post("dept-text") || $this->input->post("dept"))
		{
			if($this->input->post("dept-text"))
			{
				$dept = $this->input->post("dept-text");
			}
			else
			{
				$dept = $this->input->post("dept");
			}
		    $posts = $this->input->post(NULL, TRUE);

				$this->db->trans_start();
				$regt = time();
				 
				$query = $this->db->query("INSERT INTO online_regs(username,name,email,user_regdate,college,dept,cno,confirm) VALUES('','".$posts['name']."', '".$posts['ce']."', ".$regt.", '".$posts['college']."', '".strtoupper($dept)."', ".$posts['cno'].", ".$posts['confirm'].")");
				$id = $this->db->insert_id(); 
				$uname = "bodhi".$id;
				$key = md5($uname.$regt);
				$query = "UPDATE online_regs SET username='".$uname."', auth_key='".$key."' WHERE user_id=".$id;
				if($this->db->query($query))
				{
					$tot_cash = 0;
					for($i=0; $i<count($pevents); $i++) 
					{
						$datas[$i] = array(
							'event' => $pevents[$i], 
							'user_id' => $id
						);
						$tot_cash += $cash[$pevents[$i]];
					}
					if($this->db->insert_batch('event_regs', $datas))
					{
						$this->db->trans_complete();
						$data["done"] = "Created new registration for <i>".$posts['name']."</i>. Bodhi id is <i>".$uname."</i>.<br><span style=\"color: #5F2112;\"> Registration fee calculated :- ".$tot_cash.'Rs</span>';
						unset($_POST); unset($_REQUEST); 
					}
				}
		}
		
	    $this->load->view('admin/header',$data);
		$this->load->view('admin/create_reg',$data);
		$this->load->view('admin/footer',$data);
	}
	
	public function search()
	{
		if(!$this->input->cookie('is_admin1'))
		{
			redirect(base_url().'admin/login');
		}
		
		$data = array();
		
		if($_POST && $this->input->post($this->input->post("factor")) !="")
		{
			$factor = $this->input->post("factor");
			$query = $this->db->query("SELECT user_id FROM online_regs WHERE ".$factor."='".$this->input->post($factor)."' LIMIT 1");
			if($query->num_rows()>0)
			{
				//$id = $query->result_array()[0]["user_id"];
				$res = $query->result_array();
				$id = $res[0]["user_id"];
				redirect(base_url().'admin/edit-reg/'.$id);
			}
		}
		
	    $this->load->view('admin/header',$data);
		$this->load->view('admin/search',$data);
		$this->load->view('admin/footer',$data);
	}
		
	public function edit_reg($id = 0)
	{
	    if(!$this->input->cookie('is_admin1'))
		{
			redirect(base_url().'admin/login');
		}
		
		$data = array();
		$data["no_user"] = false;
		$data["result"] = "";
		$data["done"] = "";
		
		if($id == 0)
		{
			$data["no_user"] = true;
		}
		else
		{
			$query = $this->db->query("SELECT * FROM online_regs WHERE user_id=".$id." LIMIT 1");
			$data["user"] = $query->result_array();			
								
			if($query->num_rows()==0)
			{
				$data["no_user"] = true;
			}
			else
			{
			/*	$data["events"] = array();
				$query = $this->db->query("SELECT * FROM events");
				$te = $query->result_array();
				
				foreach($te as $k => $v)
				{
					$data["events"][$v["event_id"]] = $v["event_name"];
				} */
			
				$cash = array();
				$query = $this->db->get('event_groups');
				$row = $query->result();
				$i = 0;
			
				foreach($row as $k => $v)
				{
					$data["egroups"][$i]["name"] = $v->group_name;
					$query = $this->db->get_where('events', "group_id = ".$v->group_id);
					$data["egroups"][$i]["events"] = $query->result();
					foreach($data["egroups"][$i]["events"] as $k => $v)
					{
						$cash[$v->event_id] = $v->cash;
					}
					$i++;
				}
				
				if($_POST)
				{
					$this->load->library('form_validation');
					$u="";
					if($data["user"][0]["username"] != $this->input->post("username"))
					{
						$u = '|is_unique[online_regs.username]';
					}
					$this->form_validation->set_rules('username', 'Bodhi id', 'required|min_length[3]'.$u);
					$this->form_validation->set_rules('name', 'Name', 'required|alpha_space|min_length[3]');
					$this->form_validation->set_rules('college', 'College', 'required|min_length[3]');
					$this->form_validation->set_rules('dept', 'Department', 'alpha_space|max_length[3]');
					$this->form_validation->set_rules('dept-text', 'Department', 'alpha_space|max_length[30]');		
					$this->form_validation->set_rules('cno', 'Contact Number', 'required|numeric|min_length[5]|max_length[15]');
					$this->form_validation->set_rules('ce', 'Contact Email', 'valid_email|min_length[6]');
					$this->form_validation->set_rules('events', 'Events', 'required');
					$pevents = $this->input->post('events');
					
					if(!$this->input->post("dept-text") && !$this->input->post("dept") && $_POST)
					{
						$data["result"] = "You need to specify department.";
					}	
					if ($this->form_validation->run() === false)
					{
						$data["result"] .= validation_errors();
					}
					else if($this->input->post("dept-text") || $this->input->post("dept"))
					{
						if($this->input->post("dept-text"))
						{
							$dept = $this->input->post("dept-text");
						}
						else
						{
							$dept = $this->input->post("dept");
						}
						$posts = $this->input->post(NULL, TRUE);

						$this->db->trans_start();
						$this->db->query("DELETE FROM event_regs WHERE user_id = ".$id);
						for($i=0; $i<count($pevents); $i++) 
						{
							$datas[$i] = array(
								'event' => $pevents[$i], 
								'user_id' => $id
							);
						} 	$posts['confirm'] = 1;
							$data["user"][0]["confirm"] = 1;
						$this->db->insert_batch('event_regs', $datas);
						$query = $this->db->query('UPDATE online_regs SET username = "'.$posts['username'].'", name="'.$posts['name'].'", email="'.$posts['ce'].'", college="'.$posts['college'].'", dept="'.strtoupper($dept).'", cno='.$posts['cno'].', confirm='.$posts['confirm'].' WHERE user_id = '.$id);
						$this->db->trans_complete();
						$data["done"] = "Updated registration for <i>".$posts['name']."</i>";
					}
				
				}
				}

					$query = $this->db->query("SELECT * FROM event_regs WHERE user_id = '".$id."' LIMIT 100");
					$data["reg_for_events"] = $query->result_array();
									$tot_cash = 0;
									foreach($data["reg_for_events"] as $k => $v)
									{
										$tot_cash += $cash[$v["event"]];
									}
									$data["total_cash"] = $tot_cash;
		}
		
	    $this->load->view('admin/header',$data);
		$this->load->view('admin/edit_reg',$data);
		$this->load->view('admin/footer',$data);
	}
	
	public function view_by_group($id = 0, $page = 0)
	{
		if(!$this->input->cookie('is_admin1'))
		{
			redirect(base_url().'admin/login');
		}
		$data = array();
		$data['id'] = $id;
		
		$query = $this->db->query("SELECT * FROM events");
		$te = $query->result_array();
		
		$query = $this->db->query("SELECT * FROM event_groups");
		$tg = $query->result_array();
		$data["events"] = array();
		
		foreach($tg as $k => $v)
		{
			$data["groups"][$v["group_id"]] = $v["group_name"];
		}
		
		foreach($te as $k => $v)
		{
			$data["events"][$v["event_id"]] = array("event_name" => $v["event_name"], "group_id" => $v["group_id"]);
		}

		if($id==0)
		{
		
		}
		else
		{
		$query = $this->db->query("SELECT c.*,b.group_name,d.group_id FROM event_groups b, online_regs c, events d, event_regs a WHERE b.group_id = d.group_id and d.event_id = a.event and a.event = ".$id."  and c.user_id = a.user_id and c.confirm = 1");

		$limit = 10;
		$this->load->library('pagination');

		$config['base_url'] = base_url().$this->uri->slash_segment(1,'trailing').$this->uri->slash_segment(2,'trailing').$this->uri->slash_segment(3);
		$config['uri_segment'] = 4;
		$config['total_rows'] = $query->num_rows();
		$config['per_page'] = $limit; 
		$config['num_links'] = 50;
		$config['page_query_string'] = FALSE;
		$config['full_tag_open'] = '<p class="pages">';
		$config['full_tag_close'] = '</p>';
		$config['num_tag_open'] = '<span>';
		$config['num_tag_close'] = '</span>';
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<div>';
		$config['first_tag_close'] = '</div>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<div>';
		$config['last_tag_close'] = '</div>';
		
		$config['next_tag_open'] = '<span>';
		$config['next_tag_close'] = '</span>';
		$config['prev_tag_open'] = '<span>';
		$config['prev_tag_close'] = '</span>';
		$data['current_page'] = $page+1;

		$this->pagination->initialize($config);
		$data["pages"] = $this->pagination->create_links();
		
		$query = $this->db->query("SELECT c.*,b.group_name,d.group_id FROM event_groups b, online_regs c, events d, event_regs a WHERE b.group_id = d.group_id and d.event_id = a.event and a.event = ".$id."  and c.user_id = a.user_id and c.confirm = 1 LIMIT ".$page.", ".$limit);
		$data["regs"] = $query->result_array();

		foreach($data["regs"] as $k => $v)	
		{
			$query = $this->db->query("SELECT * FROM event_regs WHERE user_id = '".$v["user_id"]."' LIMIT 100");
			$data["regs"][$k]["reg_for_events"] = $query->result_array();
		}
		
		}
		
	    $this->load->view('admin/header',$data);
		$this->load->view('admin/group_by',$data);
		$this->load->view('admin/footer',$data);
	}
	
	public function stop_reg()
	{
		if(!$this->input->cookie('is_admin1'))
		{
			redirect(base_url().'admin/login');
		}
		
		$data = array();
		
			$query = $this->db->query("SELECT * FROM events");
			$te = $query->result_array();
			$data["events"] = array();
		
			foreach($te as $k => $v)
			{
				$data["events"][$v["event_id"]] = $v["event_name"];
			}
			
			$query = $this->db->get('event_groups');
			$row = $query->result();
			$i = 0;
			
			foreach($row as $k => $v)
			{
			   $data["egroups"][$i]["name"] = $v->group_name;
			   $query = $this->db->get_where('events', "group_id = ".$v->group_id);
			   $data["egroups"][$i]["events"] = $query->result();
			   $i++;
			}
			$data["done"] = false;
			$data["error"] = "";
			$pevents = $this->input->post("events");
			if(!$pevents)
			{
				$pevents = array();
			}
		if($_POST)
		{ 
			if($_POST['pass'] == "master#*bodhi")
			{
				$q = array();
				foreach($pevents as $k=>$v)
				{
					$q[]= 'event_id = '.$v;
				}
				if($this->db->query("UPDATE events set stopped=0"))
				{
					if(count($q)>0)
					{
						$this->db->query("UPDATE events set stopped=1 WHERE ". implode($q, ' OR '));
					}
					$data["done"] = true;
				}
			}
			else
			{
				$data["error"] = "The master password you have entered seem to be wrong!";
			}
		}
	    $this->load->view('admin/header',$data);
		$this->load->view('admin/stop_reg',$data);
		$this->load->view('admin/footer',$data);
	}
	
	public function logout()
	{
			setcookie('is_admin1','yes',time()-3600*24);
			redirect(base_url().'admin');
	}
}