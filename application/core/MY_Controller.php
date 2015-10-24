<?php 

class MY_Controller extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
        }

    public function top_template()
    {
    	$data['head'] = $this->head();
    	$data['nav'] = $this->nav();
    	return $data;	
    }
     public function bottom_template()
    {
    	$data['footer'] = $this->footer();
    	$data['scripts'] = $this->scripts();
    	return $data;	
    }

    private function head()
	{
		return $this->load->view('sec_head',NULL,TRUE);
	}

	private function nav()
	{
		return $this->load->view('sec_nav',NULL, TRUE);
	}

	private function footer()
	{
		return $this->load->view('sec_footer',NULL,TRUE);
	}

	private function scripts()
	{
		return $this->load->view('sec_scripts',NULL,TRUE);
	}

}

?>