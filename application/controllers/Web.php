<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Images_model', 'Works_model', 'Team_model'));
		$this->load->helper(array('form','html'));
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{	
		$data['head']=$this->top_template();
		$data['footer']=$this->bottom_template();
		// Check core/MY_Controller.php for the top functions. 
		$data['header']=$this->header();
		$data['services']=$this->services();
		$data['portfolio']=$this->portfolio();
		$data['about']=$this->about();
		$data['team']=$this->team();
		$data['clients']=$this->clients();
		$data['contact']=$this->contact();
	
		$this->load->view('view_main',$data);
	}

	public function email(){

		if ($_POST['submit_contact']) {
			$this->load->library('form_validation');
			// Validation Rules
			$config_validation = array(
	               array(
	                     'field'   => 'email', 
	                     'label'   => 'Email', 
	                     'rules'   => 'trim|required|valid_email'
	                  ),
	               array(
	                     'field'   => 'name', 
	                     'label'   => 'Name', 
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'location', 
	                     'label'   => 'Location', 
	                     'rules'   => 'trim|required'
	                  ),   
	               array(
	                     'field'   => 'message', 
	                     'label'   => 'Message', 
	                     'rules'   => 'required'
	                  )
	        );

			$this->form_validation->set_rules($config_validation);
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger" style="background:none; 
  border:none" >', '</div>');
			// Check to see if validation OR upload failed
			if ($this->form_validation->run() == FALSE){
				
				$this->index();
			}
			else{
				// Fix for date and time
				date_default_timezone_set('America/Argentina/Buenos_Aires');
				// Get data from Form
				$data['email']=$this->input->post('email');
				$data['name']=$this->input->post('name');
				$data['location']=$this->input->post('location');
				$data['message']=$this->input->post('message');
				// Update client data to DB
				$this->load->model('Clients_model');
				$this->Clients_model->set_client($data['email'],$data['name'], $data['location']);
				
				// Email config

				    // $this->load->library('email');
				    
				// Mandrill

				    $this->load->config('mandrill');

					$this->load->library('mandrill');

					$mandrill_ready = NULL;

				try {

					$this->mandrill->init( $this->config->item('mandrill_api_key') );
					$mandrill_ready = TRUE;
					
				} catch(Mandrill_Exception $e) {

					$mandrill_ready = FALSE;
					
				}

				if( $mandrill_ready ) {

					//Send us some email!
					$email = array(
						'html' => '<h2>Message:</h2><p>'.$data['message']."</p><br><h4>Customer's location: ". $data['location'].'<h4>', //Consider using a view file
						'text' => $data['message']."Customer's location: ". $data['location'],
						'subject' => 'estudiokemelman.com.ar - Formulario de contacto',
						'from_email' => $data['email'],
						'from_name' => $data['name'],
						'to' => array(array('email' => 'martin@estudiokemelman.com.ar' )) //Check documentation for more details on this one
						//'to' => array(array('email' => 'joe@example.com' ),array('email' => 'joe2@example.com' )) //for multiple emails
						);

					$result = $this->mandrill->messages_send($email);
					
				}
				   
				    if($result){
					$data['sent'] = "Your email was sent correctly";		
					}else{
					$data['fail'] = "there was a problem sending the email: ".show_error($this->email->print_debugger());
					}	
			
				
				// email config params
				// $config = array('protocol' => 'smtp',
				// 			'smtp_host' => 'smtp.mandrillapp.com',
				// 			'smtp_port' => 2525,
				// 			'smtp_user' => 'social@jaddel.com',
				// 			'smtp_pass' => 'GVNAGR1NFAzbReB3M9Pjlw'
				// 			);
				
				// call email library and pass config
				// $this->load->library('email', $config);
				// fix for starting an email
				// $this->email->set_newline("\r\n");
				// Filling out headers of email and message
				// $this->email->from($data['email']);
				// $this->email->to('juandel@gmail.com');
				// $this->email->subject('jaddel.com- contact form');
				// $this->email->message($data['message']."\nCustomer's location: ". $data['location']);

				// Send email and check if it was send 
				// if($this->email->send()){
				// 	$data['sent'] = "Your email was sent correctly";		
				// }else{
				// 	$data['fail'] = "there was a problem sending the email: ".show_error($this->email->print_debugger());
				// }	
			}

			
			$data['head']=$this->top_template();
			$data['footer']=$this->bottom_template();
			$this->load->view('email_confirm', $data);
		}
		
	}

	private function header()
	{	
		$this->load->helper('html');
		$images= $this->Images_model->get_image_names();
		$images_names = array();
		
		foreach ($images as $value) {
			$images_names[] = $value['name'];		
		}

		$data['files_in_directory']= scandir('img/slider/');
				
		$data['images']= $images_names;
		return $this->load->view('sec_header',$data, TRUE);

	}
	
	private function services()
	{
		return $this->load->view('sec_services',NULL, TRUE);
	}

	private function portfolio()
	{	
		// Get all works
		$data['in_works'] = $this->Works_model->get_works();
		// Get images from DB where work_id equals works id
		$work_id = 0;
		foreach ($data['in_works'] as $key) {
			$images = array();
			$images[] = ($this->Images_model->get_image_works($key['id']));
			
			$work_id = $key['id'];
			// For each work image brought from DB add to array  
			foreach ($images as $image) {
				$key['images']=$image;
			}
			// add array of images to global array of works ($data )
			$data['works'][]=$key;
		}
		foreach ($data['works'] as $key => $value) {
			if ($value['category']=='vivienda_unifamiliar') {
				$data['vivienda_unifamiliar'][] = $value;
			}elseif ($value['category']=='vivienda_multifamiliar') {
				$data['vivienda_multifamiliar'][] = $value;
			}elseif ($value['category']=='varios') {
				$data['varios'][] = $value;
			}else{
				$data['en_procesos'][] = $value;
			}

		}

		return $this->load->view('sec_portfolio',$data, TRUE);
	}

	private function about()
	{
		return $this->load->view('sec_about',NULL,TRUE);
	}

	private function team()
	{
		$data['team_members'] = $this->Team_model->get_team_members();
		return $this->load->view('sec_team',$data,TRUE);
	}

	public function add_team_member(){
		$data['head']=$this->top_template();
		$data['footer']=$this->bottom_template();
		
		if (isset($_POST['submit_team_member'])){
			// Get data from Form
			$data['name']=$this->input->post('name');
			$data['position']=$this->input->post('position');
			$data['facebook']=$this->input->post('facebook');
			$data['linkedin']=$this->input->post('linkedin');

			
			$this->load->library('image_lib');

			// Set config for file upload
			$config['upload_path'] = './img/team/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['overwrite']=TRUE;
			$config['max_size']	= '800';
			$config['max_width']  = '225';
			$config['max_height']  = '225';

			// Load upload Library
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('image_path'))
                {
                        $data['error'] = $this->upload->display_errors();

                        $this->load->view('add_team_member', $data);                }
                else
                {
                        $data['upload_data'] = $this->upload->data();
                        $data['image_path'] = $data['upload_data']['file_name'];  
                }

                $this->Team_model->add_team_member($data['name'], $data['position'], $data['facebook'], $data['linkedin'], $data['image_path']);

                $this->load->view('add_team_member', $data);
		}else{
			$this->load->view('add_team_member', $data);
		}
	}

	public function update_member($id){
		$data['head']=$this->top_template();
		$data['footer']=$this->bottom_template();

		$data['team_member'] = $this->Team_model->get_team_member($id);

		if (isset($_POST['submit_team_member_edit'])){
			// Get data from Form
			$data['name']=$this->input->post('name');
			$data['position']=$this->input->post('position');
			$data['facebook']=$this->input->post('facebook');
			$data['linkedin']=$this->input->post('linkedin');
			
			$this->load->library('image_lib');

			// Set config for file upload
			$config['upload_path'] = './img/team/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['overwrite']=TRUE;
			$config['max_size']	= '800';
			$config['max_width']  = '225';
			$config['max_height']  = '225';

			// Load upload Library
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('image_path')){
                        $data['error'] = $this->upload->display_errors();
                        $data['image_path'] = $data['team_member']['image_path'];
                        $this->load->view('update_team_member', $data);                }
            else
            {
                    $data['upload_data'] = $this->upload->data();
                    $data['image_path'] = $data['upload_data']['file_name'];  
            }

            $this->Team_model->update_team_member($data['name'], $data['position'], $data['facebook'], $data['linkedin'], $data['image_path'], $id );
            
            $this->load->view('update_team_member', $data);
		}else{
			$this->load->view('update_team_member', $data);
		}
	}
	public function delete_team_member($id=NULL)
	{

		$data['head']=$this->head;
		$data['footer']=$this->footer;

		$data['team_member_id']=$id;

		if (isset($id)) {

			$data['team_member'] = $this->Team_model->get_team_member($id);
			print_r($data['team_member']);
		}

			
	// 		if($this->Works_model->delete_works($id)){
	// 			$data['confirm'] = "Work was Deleted from works table";
	// 			if ($this->Amenities_model->delete_amenities($id)) {
	// 				$data['confirm'] = "all amenities were Deleted from amenities table";
	// 			}
	// 			if ($this->Images_model->delete_images($id)) {
	// 				$data['confirm'] = "Work was Deleted from images table and works table";
					
	// 				foreach ($data['images'] as $image) {
	// 					$ext = explode('.', $image['name']);
 //        				$filename_ext = "./img/uploads/".$ext[0]."_thumb.".$ext[1];
	// 					$filename = "./img/uploads/".$image['name'];
	// 		            if (is_file($filename)) {
	// 		                @unlink($filename);
	// 		                @unlink($filename_ext);
	// 		                $data['error']['not_deleted'] = "the file was deleted succesfully";
	// 		            }else{
	// 		                $data['error']['not_deleted'] = "the filename: ".$filename." is not a file. Can't erase";
	// 		            }
	// 				}

	// 			}else{
	// 				$data['confirm'] = "Could not delete images of work from images table but could delete from works.";
	// 			}

	// 		}else{
	// 			$data['confirm'] = "Could not delete work from works table. Something went wrong";
	// 		}
			
	// 	}else{
	// 		$data['error']['no_id'] = "No ID for work to delete";
	// 	}
		

		$this->load->view('delete_work', $data);
	}

	private function clients()
	{
		return $this->load->view('sec_clients',NULL,TRUE);
	}


	private function contact()
	{

		return $this->load->view('sec_contact',NULL,TRUE);
	}


}

