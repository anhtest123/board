<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Board_model');
		$this->load->helper('url');
	}	 
	 
    public function index() {
		$this->list();
    }

	// 게시글 리스트
	public function list($bnumber=1, $search=0, $page = 0)		
	{
		if(rawurldecode($search))
		{
			$this->db->like('title',rawurldecode($search));
		}
		$list_num = $this->db->get_where('board',array('bnumber' => $bnumber))->num_rows();

		$data['list'] = $this->Board_model->get_list($bnumber, rawurldecode($search), $page);
		$data['page'] = $this->page($bnumber, $list_num, $search);
		
        $this->load->view('header');
        $this->load->view('nav');
        $this->load->view('board_v', $data);
        $this->load->view('footer');
	}
 
    // 게시판 글쓰기 폼 화면
    public function write($bnumber) {
		if($this->session->userdata('logged_in'))
		{
			$modal['view'] = array('action' => '', 'validation' => TRUE,'bnumber'=>'');

			$this->load->view('header');
			$this->load->view('nav');
			$this->load->view('modal_view',$modal);
			$this->load->view('write'); // 글쓰기 뷰
			$this->load->view('footer');  
		}
		else
		{
			redirect('/Main/login');
		}
    }
	 
	// 글쓰기 뷰에서 입력한 데이터(제목, 내용, 작성자)를 Model에 전송하고 
	// 결과값을 리턴하여, 성공/실패 메시지를 보여주는 뷰로 이동한다
	public function add($bnumber) {
		$title = $this->input->post('title');
		$content = $this->input->post('content');
		$author = $this->input->post('author');

		
		 
		// board 모델을 이용해서 게시물을 등록하도록 작성
		$result = $this->Board_model->insert($title, $content, $author, $bnumber);
	 
			$modal['view'] = array('action' => 'add', 'validation' => $result,'bnumber'=>$bnumber);

			$this->load->view('header');
			$this->load->view('modal_view',$modal);
			$this->load->view('footer');	 
	}

	// 게시글 보기
	public function view($bnumber, $no) {
		$data['view'] = $this->Board_model->get_view($no);
		$modal['view'] = array('action' => '', 'validation' => TRUE, 'bnumber'=>$bnumber);
	 
		$this->load->view('header');
		$this->load->view('modal_view',$modal);
		$this->load->view('nav');
		$this->load->view('view', $data);
		$this->comment_list($no);
		$this->load->view('footer');
	}

	// 게시글 수정
	public function update($bnumber, $no) {
		$title = $this->input->post('title');
		$content = $this->input->post('content');
		$author = $this->input->post('author');
		
		$result = $this->Board_model->update($no, $title, $content, $author);
		$modal['view'] = array('action' => 'update', 'validation' => $result, 'bnumber'=>$bnumber); 
		
	 
			$this->load->view('header');
			$this->load->view('modal_view',$modal);
			$this->load->view('footer');          
	}

	// 게시글 수정 폼 화면
	public function modify($bnumber, $no) {
		$data['view'] = $this->Board_model->get_view($no);
		 	 
		$this->load->view('header');
		$this->load->view('nav');
		$this->load->view('modify', $data);
		$this->load->view('footer');          
	}

	// 게시글 삭제
	public function delete($bnumber, $no) {
	 
		$result = $this->Board_model->delete($no);
		$modal['view'] = array('action' => 'delete', 'validation' => $result, 'bnumber' => $bnumber); 
		
		$this->load->view('header');
		$this->load->view('modal_view',$modal);
		$this->load->view('footer'); 
	}

	// 게시글 삭제 화면	
	public function remove($no) {
		$data['view'] = $this->Board_model->get_view($no);
		 	 
		$this->load->view('header');
		$this->load->view('nav');
		$this->load->view('remove', $data);
		$this->load->view('footer');          
	}

	// 페이징
	public function page($bnumber, $list_num, $search)
	{
		$this->load->library('pagination');

		$config['base_url'] = '/bbs/Main/list/'.$bnumber.'/'.$search.'/';
		$config['total_rows'] = $list_num;
		$config['per_page'] = 10;
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] =  '<li><a class="page-link"><strang>';
		$config['cur_tag_close'] =' </strang></a></li>';

		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';

		$config['last_tag_open'] =  '<li>';
		$config['last_tag_close'] =' </li>';

		$config['attributes'] = array('class' => 'page-link');

		$this->pagination->initialize($config);

		return $this->pagination->create_links();
	}

	// login
	public function login()
	{
		$data = $this->input->post();
		$modal['view'] = array('action' => '', 'validation' => TRUE, 'bnumber' => '');
		
		if($this->input->is_ajax_request()){

			$row = $this->Board_model->login($data);
			
			$row == NULL ? $passwordResult = false : $passwordResult = password_verify($data['password'], $row['pw']);

			if($passwordResult)
			{
				$json = json_encode(array('validation_result' => 'Login OK', 'guide_text' => $row['nickname']."님 환영합니다."));

				$sessiondata = array(
					'nickname'  => $row['nickname'],
					'logged_in' => TRUE
				);
			
				$this->session->set_userdata($sessiondata);
			}
			else
			{
				$json = json_encode(array('validation_result' => 'Login Fail', 'guide_text' => '아이디 또는 비밀번호가 올바르지 않습니다.'));    
			}
		
			echo $json;
		}
		else
		{
			$this->load->view('header');
			$this->load->view('modal_view',$modal);
			$this->load->view('login_view');
			$this->load->view('footer');
		}
			
	}

	// 회원가입
	public function signup()
	{
		$data = $this->input->post();
		$modal['view'] = array('action' => '', 'validation' => TRUE, 'bnumber' => '');

		if($this->input->is_ajax_request())
		{
			$row = $this->Board_model->signup($data);

			($row == NULL) || ($row === true) ? $checkResult = true : $checkResult = false;

			if($checkResult)
			{
				$json = json_encode(array('validation_result' => true));
			}
			else
			{
				$json = json_encode(array('validation_result' => false));    
			}

			echo $json;
		}
		else
		{
			$this->load->view('header');
			$this->load->view('modal_view',$data);
			$this->load->view('signup_view');
			$this->load->view('footer');
		}
	}	

	public function logout()
	{
		$sessiondata = array(
			'nickname'  => '',
			'logged_in' => FALSE
		);
		$this->session->set_userdata($sessiondata);
		redirect('/Main');
	}

	public function upload_image()
	{
		// 사용자가 업로드 한 파일을 디렉토리에 저장한다.
		$config['upload_path'] = './images';
		// git,jpg,png 파일만 업로드를 허용한다.
		$config['allowed_types'] = 'gif|jpg|png';
		// 허용되는 파일의 최대 사이즈
		$config['max_size'] = '100';
		// 이미지인 경우 허용되는 최대 폭
		$config['max_width']  = '1024';
		// 이미지인 경우 허용되는 최대 높이
		$config['max_height']  = '768';
		$this->load->library('upload', $config);

		if( ! $this->upload->do_upload("upload"))
		{
			echo $this->upload->display_errors();
		}
		else
		{
			$CKEditorFuncNum = $this->input->get('CKEditorFuncNum');

			$data = $this->upload->data('file_name');
			$filename = $data;	

			$url = '/bbs/images/'.$filename;

			echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction('".$CKEditorFuncNum."', '".$url."', '전송에 성공했습니다.')</script>";
		}
	}

	// 댓글 보기 (5개만)
	public function comment_list($board_no, $show=0)
	{
		// $data['list'] = $this->Board_model->get_comment($board_no, $show);
		$this->load->view('comment_view');
	}
	
	// 댓글 추가로 보기 (5개씩 증가) 1000개 까지
	public function comment_view_more()
	{
		$board_no = $this->input->post('board_no');
		$show = $this->input->post('show');

		if($this->input->is_ajax_request()){
			
			$result = $this->Board_model->get_comment($board_no, $show);
			$total_comment = $this->db->get_where('comment',array('board_no' => $board_no),1000,0)->num_rows();

			
			array_push($result,array('tatal_comment'=>$total_comment));

			if($result)
			{	
				$json = json_encode($result);
				echo $json;
			}
		}
	}

	public function comment_add()
	{
		$comment = $this->input->post('comment');
		$writer = $this->input->post('writer');
		$board_no = $this->input->post('board_no');

		if($this->input->is_ajax_request()){
			
			$result = $this->Board_model->comment_insert($comment, $writer, $board_no);
			
			if($result)
			{	
				$json = json_encode($result['0']);
				echo $json;
			}
		}
	}
}