<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Area extends CI_Controller {



    public function ajax()
    {
        

        echo json_encode($this->db->select('id, name')->get_where('areas', array('pid'=>$this->input->get('pid')))->result());    
    }
    

}
