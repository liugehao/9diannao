<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {
 
    public function render($template, $data=array())
    {
        $this->db->order_by('id', 'asc');
        $data['categories'] = $this->db->get('categories');
		$this->load->view('header',$data);
		$this->load->view('nav');
		$this->load->view($template);
        $this->load->view('footer');
    }

	public function index()
	{
	  $data['products'] = $this->db->order_by('id', 'desc')->get('products', 30 , 0)->result();
	  
	  $this->render('product/index', $data);
	}

    public function add()
    {
    	
        if($_SERVER["REQUEST_METHOD"] == 'GET'){
        	$this->render('product/add');
        }
        if($_SERVER["REQUEST_METHOD"] == 'POST'){
        	$a=$this->db->insert('products', array(
        			'title'=>$this->input->post('title'),
        			'body'=>$this->input->post('body'),
        			'phone'=>$this->input->post('phone'),
        			'contact'=>$this->input->post('contact'),
        			'city'=>$this->input->post('city'),
        			'county'=>$this->input->post('county'),
        			'address'=>$this->input->post('address'),
        			'category'=>$this->input->post('category'),
        			'userid'=>0,
        			'created'=>date("Y-m-d H:i:s"),
        			'price'=>$this->input->post('price'),
        	));
        	
        	$id = $this->db->insert_id();
        	$path = __DIR__.'/../../files/'.date("Ym");
	        
        	for($i=0;$i<count($_FILES['file']['name']);$i++){
        		if(!file_exists($path)) mkdir($path, 766);
        		
        		$newfilename = $path.'/'.microtime($get_as_float = true).'.'.array_pop(explode('.',$_FILES['file']['name'][$i]));
        		move_uploaded_file($_FILES['file']['tmp_name'][$i], $newfilename);
        		$this->db->insert('myfiles', array('product_id'=>$id,
        				'path'=>array_pop(explode('files/',$newfilename)),
        				'size'=>$_FILES['file']['size'][$i],
        				'type'=>$_FILES['file']['type'][$i],
        				'created'=>date("Y-m-d H:i:s"),
        		));
        		
        	}
        	
        }
        
    }
	public function view($id=10)
	{
		$data['product'] = $this->db->where('id', $id)
    		->get('products')->row();
		
		if(!count($data['product']))
		{
            $this->session->set_flashdata('flashdata', '没有找到要信息！');
			show_404('404.html' );
		}

		

		#$this->db->where("id ={$tmp[0]->city} OR id ={$tmp[0]->county}");#id字符后必须有空格
		#var_dump($this->db->get('areas')->result());
		#var_dump($tmp);
		
		$tmp = $this->db->where('id', $data['product']->city)
			->or_where('id', $data['product']->county)
			->get('areas')
			->result();

		$data['category'] = $this->db->where("id", $data['product']->category)->get('categories')->row();
		$data['city'] = $tmp[0];
		$data['county'] = $tmp[1];
		#images
		$data['pic'] = $this->db->where('product_id', $id)
			->get('myfiles')
			->result();
		
		$this->render('product/view', $data);
	}  

	public function lst($lb=0, $category=13, $page=0)
	{
	    
	    if($lb)
        {
            $field = 'userid';
            $category = $this->session->userdata('uid');
            $data['category'] = '我发布的信息';
            $config['base_url'] = base_url("mine");
        }
        else {
            $field = 'category';
            $data['category'] = $this->db->where('id', $category)->get('categories')->row()->title;
            $config['base_url'] = base_url("list/{$category}");
        }
		$config['num_tag_open'] = '<button class="btn">';		
		$config['num_tag_close'] = '</button>';
		
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] =  '<button class="btn">';		
		$config['next_tag_close'] = '</button>';
		
		$config['first_link'] = 'First';
		$config['first_tag_open'] =  '<button class="btn">';
		$config['first_tag_close'] = '</button>';
		
		$config['last_link'] = 'Last';
		$config['last_tag_open'] =  '<button class="btn">';
		$config['last_tag_close'] = '</button>';
		
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] =  '<button class="btn">';
		$config['prev_tag_close'] = '</button>';
		
		$config['cur_tag_open'] = '<button class="btn" disable>';
		$config['cur_tag_close'] = '</button>';
		
		
		$this->load->library('pagination');		
		
		
		$config['per_page'] = 20;
		$config['cur_page'] = $page;
		$config['total_rows'] = $this->db->where($field, $category)
			->from('products')
			->count_all_results();
	
		$data['products'] = $this->db->where($field, $category)
			->get('products', $config['per_page'], $page)
			->result();
		#var_dump($this->db);		
		$this->pagination->initialize($config);		
		
		$data['pagelist'] = $this->pagination->create_links();
		$this->render('product/list', $data);
		
		
	}
    public function edit($id)
    {
        
        $data['product'] = $this->db->where('id', $id)->get('products')->row();
        if(!$data['product'])
        {
            $this->session->set_flashdata('flashdata', '没有找到要编辑的信息！');
            show_404('404.html');
        }
        $data['province'] = $this->db->where('pid', 0)->get('areas')->result();
        $data['city'] = $this->db->where('pid', $data['product']->province)->get('areas')->result();
        $data['county'] = $this->db->where('pid', $data['product']->city)->get('areas')->result();
        $this->render('product/edit', $data);
            
    }
    public function search()
    {
      if($this->input->get('page'))
	{
	  $config['cur_page'] = (int)substr($_GET['page'], 1);
	  unset($_GET['page']);
	}
	else
	  {
	    $config['cur_page'] = 0;
	  }

      $querystring = '';
      foreach($_GET as $k=>$v)
	$querystring .= "{$k}={$v}&";
      //$config['enable_query_strings'] = TRUE;//无效
      //$config['page_query_strings'] = TRUE;

      $config['num_tag_open'] = '<button class="btn">';		
      $config['num_tag_close'] = '</button>';
      
      $config['next_link'] = '&gt;';
      $config['next_tag_open'] =  '<button class="btn">';		
      $config['next_tag_close'] = '</button>';
      
      $config['first_link'] = 'First';
      $config['first_tag_open'] =  '<button class="btn">';
      $config['first_tag_close'] = '</button>';
      
      $config['last_link'] = 'Last';
      $config['last_tag_open'] =  '<button class="btn">';
      $config['last_tag_close'] = '</button>';
      
      $config['prev_link'] = '&lt;';
      $config['prev_tag_open'] =  '<button class="btn">';
      $config['prev_tag_close'] = '</button>';
      
      $config['cur_tag_open'] = '<button class="btn" disable>';
      $config['cur_tag_close'] = '</button>';
	
		
		
      $config['per_page'] = 20;


      $this->search_where();

      $rows = $this->input->get('rows');
      if(!$rows)
	{
	  $rows = $this->db->from('products')
					->count_all_results();
	  
	}
      $config['base_url'] = base_url("/product/search/?{$querystring}rows={$rows}&page=");
      $config['total_rows'] = $rows;
      $this->search_where();
      $data['products'] = $this->db->get('products', $config['per_page'], $config['cur_page'])
	->result();
      $this->load->library('pagination');
      $this->pagination->initialize($config);		
      
      $data['pagelist'] = $this->pagination->create_links();
      $this->render('product/search', $data);

    }
    private function search_where()
    {

      if($this->input->get('county'))
	$this->db->where('county', $this->input->get('county'));
      elseif($this->input->get('city'))
	$this->db->where('city', $this->input->get('city'));
      elseif($this->input->get('province'))
	$this->db->where('province', $this->input->get('province'));
      if($this->input->get('category'))
	$this->db->where('category', $this->input->get('category'));
      if($this->input->get('title'))
	$this->db->where("(title like '%{$this->input->get('title')}%' or body like '%{$this->input->get('title')}%')");
      if($this->input->get('price'))
	$this->db->where('price >=', $this->input->get('price'));
      if($this->input->get('price1'))
	$this->db->where('price <=', $this->input->get('price1'));
    }

}
