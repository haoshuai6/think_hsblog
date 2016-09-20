<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 系统回收站
 */
class RecycleController extends AdminBaseController{
    private $db_Articles,$db_Article_category,$db_Tag;
    public function __construct(){
        parent::__construct();
        $this->db_Tag = M ('Tag');
        $this->db_Articles = M ('Articles');
        $this->db_Article_category = M ('Article_category');
    }
    //文章回收站
    public function article(){
        $show_array['a_state'] = array('eq',C('ARTICLE_RECYCLE')) ;
        $article_list = $this->db_Articles->where($show_array)->select();
        if(!empty($article_list) && is_array($article_list)){
            foreach ($article_list as $k => $v) {
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
}
