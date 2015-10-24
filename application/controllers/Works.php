<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Works extends MY_Controller {

	private $head ;
	private $footer;


	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','html'));
		$this->load->model(array('Images_model', 'Works_model', 'Amenities_model'));
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" style="background-color:white; border:none">', 
													'</div>');
		$this->head= $this->top_template();
		$this->footer = $this->bottom_template();


	}

	public function index()
	{
		$data['head']=$this->head;
		$data['footer']=$this->footer;

		$this->load->view('create_work',$data);
	}

	public function resizeImage($path, $file){
		$config['image_library'] = 'gd2';
		$config['source_image'] = $path;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 800;
		$config['height'] = 450;
		$config['new_image']= $file;


		$this->image_lib->initialize($config);
		if (!$this->image_lib->resize())
		{
        	return $this->image_lib->display_errors();
		}
		$this->image_lib->clear();

	}

	public function show_work($id)
	{
		$data['head']=$this->head;
		$data['footer']=$this->footer;

		$data['work'] = $this->Works_model->get_work($id);
		$data['amenities_raw'] = $this->Amenities_model->get_amenities_for_project($id);
		// $data['amenities'] = array();
		// echo "nom:";
		// print_r(count($data['amenities_raw'][0]));

		
		// foreach ($data['amenities_raw'][0] as $a_key => $a_value) {
		// 	if ($a_key !='id' && $a_key != 'obra_id') {
		// 		$data['amenities'][$a_key] = $a_value;
		// 	}			
		// }
		
		$data['images'] = $this->Images_model->get_image_works($id);
		$this->load->view('show_work', $data);
	}

	public function create_work()
	{
		$data['head']=$this->head;
		$data['footer']=$this->footer;
		$data['amenities_list'] = $this->Amenities_model->get_amenities_fieldnames();

		if ($this->input->post('submit')) {
			// Validation Rules
			$config_validation = array(
	               array(
	                     'field'   => 'title', 
	                     'label'   => 'Title', 
	                     'rules'   => 'required'
	                  ),
	               array(
	                     'field'   => 'description', 
	                     'label'   => 'Description', 
	                     'rules'   => 'required'
	                  )
	        );

			$this->form_validation->set_rules($config_validation);
			// echo "<pre>";
			// print_r($_FILES);
			// echo "</pre>";
			// Check to see if validation OR upload failed
			if ($this->form_validation->run() == FALSE){
				
				$this->load->view('create_work', $data);
			}
			else
			{
				// Set title Data
				$data['title']=$this->input->post('title');
				$data['superficie'] = $this->input->post('superficie');
				$data['description']=$this->input->post('description');
				$data['location']=$this->input->post('location');
				$data['category']=$this->input->post('category');
				$data['lat']=$this->input->post('lat');
				$data['lng']=$this->input->post('lng');

				// Get array of amenities from form in view->create_work
				$data['amenities']=$this->input->post('amenities_radio');
				// echo "<pre>";
				// print_r($data);
				// echo "</pre>";
				
				
				// Load upload Library
				$this->load->library('upload');
				$this->load->library('image_lib');

				// Set config for file upload
				$config['upload_path'] = './img/uploads/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['overwrite']=TRUE;
				$config['max_size']	= '1600';
				$config['max_width']  = '1920';
				$config['max_height']  = '1080';
				

				// send config to upload library which uploads file
				$this->upload->initialize($config);
				// If title does NOT exist in WORKS insert Work data into WORK DB
				if (!$this->Works_model->check_title_exists($data['title'])) {
					$data['work_id']=$this->Works_model->insert_work($data['title'],$data['description'],$data['location'], $data['category'],$data['superficie'], $data['lat'],$data['lng']);
					$data['amenities_id'] = $this->Amenities_model->insert_amenities($data['amenities'],$data['work_id'] );
					
					$files = $_FILES['images'];
					$e =0;
					foreach ($files['name'] as $key => $value) {
						$_FILES['images']['name'] = $files['name'][$key];
		                $_FILES['images']['type'] = $files['type'][$key];
		                $_FILES['images']['tmp_name'] = $files['tmp_name'][$key];
		                $_FILES['images']['error'] = $files['error'][$key];
		                $_FILES['images']['size'] = $files['size'][$key];

						if (!$this->upload->do_upload('images')) {
							$data['error']= $this->upload->display_errors();
						}else{
							$data['upload_data'] = $this->upload->data();
							// Call function resizeImage from this controller
							$data['resize_error']=$this->resizeImage($data['upload_data']['full_path'], $data['upload_data']['file_path']);

							// Check to see if image is already in DB. If it's NOT, then Update
							if(!$this->Images_model->check_filename_exists($data['upload_data']['file_name'])){
								$this->Images_model->insert_image($data['upload_data']['file_name'], $data['upload_data']['file_path'],$data['work_id']);
									$e++;
									$data['db']= " Images loaded into DB: ".$e;	
								
							}else{
								$this->Amenities_model->delete_amenities($data['work_id']);
								$this->Works_model->delete_works($data['work_id']);
								$data['error'] = "An image with the name ".$data['upload_data']['file_name']. " already exists in DB";
							}
						}	
					}
				}else{
					$data['error']="Obra con este titulo ya existe en la base de datos: ".$data['title'].".";
				}

				
				// echo "<pre>";
				// print_r($data['upload_data']);
				// echo "</pre>";
				$data['feedback']['submit']="Obra agregada correctamente";
				$this->load->view('create_work', $data);
			}
		}else{
			
			$data['feedback']['create']= "Create Work";
			$this->load->view('create_work', $data);
		}
		
		// if (!$this->upload->do_upload())
		// {
		// 	$data['head']=$this->head();
		// 	$data['nav']=$this->nav();
		// 	$data['header']=$this->header();
		// 	$data['footer']=$this->footer();
		// 	$data['scripts']=$this->scripts();
		// 	$data['error']= $this->upload->display_errors();

		// 	$this->load->view('create_work', $data);
		// }
		// else
		// {
			// $data['head']=$this->head();
			// $data['nav']=$this->nav();
			// $data['header']=$this->header();
			// $data['footer']=$this->footer();
			// $data['scripts']=$this->scripts();
			// $data['upload_data'] = $this->upload->data();
			// $data['title']=$this->input->post('title');
			// print_r($data['upload_data']);

			// // Check to see if image is already in DB. If it's NOT, then Update
			// if(!$this->Images_model->check_filename_exists($data['upload_data']['file_name'])){
			// 	$this->Images_model->insert_image($data['upload_data']['file_name'], $data['upload_data']['file_path']);
			// }else{
			// 	$data['error'] = "An image with the same name already exists in DB";
			// }

			// $this->load->view('create_work', $data);
		// }
	}

	function update_work($id=NULL){
		$this->load->helper(array('file'));
		$data['head']=$this->head;
		$data['footer']=$this->footer;

		$data['work_id']=$id;
		$data['amenities_val'] = $this->Amenities_model->get_amenities_for_project($id);
				
		if ($id) {
			if ($this->input->post('submit')) {
	
				$config['upload_path'] = './img/uploads/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['overwrite']=TRUE;
				$config['max_size']	= '1600';
				$config['max_width']  = '1920';
				$config['max_height']  = '1080';
				// send config to upload library which uploads file
				$this->load->library('upload');
				$this->load->library('image_lib');
				$this->upload->initialize($config);
				
				// Validation Rules
				$config_validation = array(
	               array(
	                     'field'   => 'title', 
	                     'label'   => 'Title', 
	                     'rules'   => 'required'
	                  ),
	               array(
	                     'field'   => 'description', 
	                     'label'   => 'Description', 
	                     'rules'   => 'required'
	                  )
		        );
				$this->form_validation->set_rules($config_validation);
				// echo "<pre>";
				// print_r($_FILES);
				// echo "</pre>";
				// Check to see if validation OR upload failed
				if ($this->form_validation->run() == FALSE){
					$this->load->view('update_work', $data);
				}else{
					// Default value for superficie
					$data['superficie']=20;
					// Set title Data
					$data['title']=$this->input->post('title');
					$data['superficie'] = $this->input->post('superficie');
					$data['description']=$this->input->post('description');
					$data['category']=$this->input->post('category');
					$data['location']=$this->input->post('location');
					$data['lat']=$this->input->post('lat');
					$data['lng']=$this->input->post('lng');
					$data['amenities_radio']=$this->input->post('amenities_radio[]');
					$data['image_radio']= $this->input->post('image_radio[]');
					
		
					print_r($data['image_radio']);
					if (isset($data['image_radio'])) {
						foreach ($data['image_radio'] as $value) {
							$data['error']['remove_file'] = $this->Images_model->remove_work_id($value);
						}	
					}

					
					$this->Works_model->update_work($data['title'],
													$data['description'],
													$data['category'],
													$data['location'],
													$data['superficie'],
													$data['lat'],
													$data['lng'],
													$id);
					$this->Amenities_model->update_amenity($data['amenities_radio'],
														$id);
					
				}
				$files = $_FILES['images'];
				
				foreach ($files['name'] as $key => $value) {
					$_FILES['images']['name'] = $files['name'][$key];
	                $_FILES['images']['type'] = $files['type'][$key];
	                $_FILES['images']['tmp_name'] = $files['tmp_name'][$key];
	                $_FILES['images']['error'] = $files['error'][$key];
	                $_FILES['images']['size'] = $files['size'][$key];
					if (!$this->upload->do_upload('images')) {
						$data['error']['upload_file']= $this->upload->display_errors();
					}else{
						$data['upload_data'] = $this->upload->data();
						$data['resize_error']=$this->resizeImage($data['upload_data']['full_path'], $data['upload_data']['file_path']);

						// Check to see if image is already in DB. If it's NOT, then Update
						if(!$this->Images_model->check_filename_exists($data['upload_data']['file_name'])){
							$this->Images_model->insert_image($data['upload_data']['file_name'], $data['upload_data']['file_path'],$data['work_id']);
							$data['feedback']['db']= "Image loaded into DB";
						}else{
							$data['error']['db'] = "An image with the same name already exists in DB";
						}
					}	
				}
			}
			$data['amenities_val'] = $this->Amenities_model->get_amenities_for_project($id);
			$data['work'] = $this->Works_model->get_work($id);
			$data['images'] = $this->Images_model->get_image_works($id);

		}else{
			$data['error']['no_update'] = "<p> No work selected to update</p>";
		}

		$this->load->view('update_work', $data);
	}

	public function delete_work($id=NULL)
	{
		$data['head']=$this->head;
		$data['footer']=$this->footer;

		$data['work_id']=$id;

		if (isset($id)) {
			$data['images'] = $this->Images_model->get_image_works($id);
			// print_r($data['images']);
			
			if($this->Works_model->delete_works($id)){
				$data['confirm'] = "Work was Deleted from works table";
				if ($this->Amenities_model->delete_amenities($id)) {
					$data['confirm'] = "all amenities were Deleted from amenities table";
				}
				if ($this->Images_model->delete_images($id)) {
					$data['confirm'] = "Work was Deleted from images table and works table";
					
					foreach ($data['images'] as $image) {
						$ext = explode('.', $image['name']);
        				$filename_ext = "./img/uploads/".$ext[0]."_thumb.".$ext[1];
						$filename = "./img/uploads/".$image['name'];
			            if (is_file($filename)) {
			                @unlink($filename);
			                @unlink($filename_ext);
			                $data['error']['not_deleted'] = "the file was deleted succesfully";
			            }else{
			                $data['error']['not_deleted'] = "the filename: ".$filename." is not a file. Can't erase";
			            }
					}

				}else{
					$data['confirm'] = "Could not delete images of work from images table but could delete from works.";
				}

			}else{
				$data['confirm'] = "Could not delete work from works table. Something went wrong";
			}
			
		}else{
			$data['error']['no_id'] = "No ID for work to delete";
		}
		

		$this->load->view('delete_work', $data);
	}
}