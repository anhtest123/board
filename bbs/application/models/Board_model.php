<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Board_model extends CI_Model {
 
    public function __construct() {
        parent::__construct();
        // codeigniter 의 database 기능을 사용하기 위한 라이브러리 호출
        $this->load->database();
    }
     
    // 입력한 게시물 정보를 database에 저장(Table에 새로운 row 삽입)
    public function insert($title, $content, $author, $bnumber) {
        $row = array(
            "title" => $title,
            "content" => $content,
            "author" => $author,
            "bnumber" => $bnumber
        );
 
        // 데이터를 테이블에 저장
        // insert를 실행한 후 결과값을 $resut에 저장한다
        // 데이터가 성공적으로 저장되면 true를 반환한다
        $result = $this->db->insert('board', $row);
        return $result;
    }

    //댓글 쓰기
    public function comment_insert($comment, $writer, $board_no) {
        $row = array(
            "comment" => $comment,
            "writer" => $writer,
            "board_no" => $board_no,
        );
 
        $this->db->insert('comment', $row);

        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('comment',1,0)->result_array();
        
        return $result;
    }

    //게시글 리스트 보기
    public function get_list($bnumber, $search, $page) {

        if($search)
        {
            $this->db->like('title',$search);
        }
        $where = array('bnumber' => $bnumber);
        
        $this->db->order_by('no', 'DESC'); // no 필드 내림차순
        $query = $this->db->get_where('board', $where, 10, $page); // $page 부터 10개 조회
        $result = $query->result_array(); // 결과를 array로 가져오기
        return $result;
    }

    //댓글 보기
    public function get_comment($board_no, $show) {
        $where = array('board_no' => $board_no);
        $this->db->order_by('id', 'DESC'); // no 필드 내림차순
        $query = $this->db->get_where('comment', $where,5,$show);  
        $result = $query->result_array(); // 결과를 array로 가져오기
        return $result;
    }

    // 게시글 자세히 보기
    public function get_view($no) {
        $where = array('no' => $no);
        $query = $this->db->get_where('board', $where);
        $result = $query->row_array(); 
        return $result;
    }

    // 게시글 수정
    public function update($no, $title, $content, $author) {
        // 수정할 데이터의 정보
        $row = array(
                "title" => $title,
                "content" => $content,
                "author" => $author
            );
        // 수정할 데이터의 번호를 조건으로 추가
        $where = array ("no" => $no);
     
        $result = $this->db->update('board', $row, $where);
        return $result;
    }

    // 게시글 삭제
    public function delete($no) {
        $where = array("no" => $no);
        $result = $this->db->delete('board', $where);
        return $result;
    }

    // 로그인
    public function login($data) {
        $where = array('id' => $data['login']);
        $query = $this->db->get_where('member', $where);
        $result = $query->row_array(); 
        return $result;
    }

    // 회원가입
    public function signup($data) {   
        if($data['action'] != 'signup')
        {
            $where = array('id' => $data[$data['action']]);
            $query = $this->db->get_where('member', $where);
            $result = $query->row_array(); 
        }
        else
        {
            $hashedPassword = password_hash($data['signup_password'], PASSWORD_DEFAULT);

            $row = array(
                "id" => $data['signup_ID'],
                "nickname" => $data['nickname'],
                "pw" => $hashedPassword
            );
            $result = $this->db->insert('member', $row);
        }
        return $result;
    }

}