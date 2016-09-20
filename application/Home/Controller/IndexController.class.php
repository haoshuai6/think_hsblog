<?php
namespace Home\Controller;
use Common\Controller\HomeBaseController;
class IndexController extends HomeBaseController {
    private $db_Articles,$db_Article_category,$db_Tag;
    public function __construct(){
        parent::__construct();
        $this->db_Tag = D ('Tag');
        $this->db_Articles = D ('Articles');
        $this->db_Article_category = D ('Article_category');

    }
    public function index(){
        $show_array['a_state'] = array('eq',C('ARTICLE_NORMAL'));
        $article_list = $this->db_Articles->where($show_array)->order(array('a_id'=>'desc'))->select();
        if(!empty($article_list) && is_array($article_list)){
            foreach ($article_list as $k => $v){
                $ac_array['ac_id'] = array('in',$v['a_category_id']);
                $category_info = $this->db_Article_category->where($ac_array)->select();
                $article_list[$k]['category_info'] =  $category_info;
            }
        }
        $category_list = $this->db_Article_category->select();
        $this->assign("article_count",count($article_list));
        $this->assign("article_list",$article_list);
        $this->assign("category_list",$category_list);
        $this->display();
    }
    public function article(){
        $a_id = I('get.id');
        if(empty($a_id)){
            $this->error("无法获取原文章",U('Admin/Article/show'),'',1);
        }
        $article_info = $this->db_Articles->getByA_id($a_id);
        if(empty($article_info)){
            $this->error("无法获取原文章",U('Admin/Article/show'),'',1);
        }
        $category_list = $this->db_Article_category->select();
        $this->assign("category_list",$category_list);
        $this->assign("article_info",$article_info);
        $this->display();
    }
}