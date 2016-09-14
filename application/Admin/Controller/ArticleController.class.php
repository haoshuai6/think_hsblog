<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 后台首页
 */
class ArticleController extends AdminBaseController{
    private $db_Articles,$db_Article_category,$db_Tag;
    public function __construct(){
        parent::__construct();
        $this->db_Tag = M ('Tag');
        $this->db_Articles = M ('Articles');
        $this->db_Article_category = M ('Article_category');
    }
    // 文章首页
    public function show(){
        $show_array['a_state'] = array('neq',C('ARTICLE_RECYCLE')) ;
        $article_list = $this->db_Articles->where($show_array)->select();
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
    public function add(){
        if(IS_POST){
            if ($this->db_Articles->autoCheckToken($_POST)){
                $article = I('post.');
                $ac_str = '';
                $article['a_title'] = $article['title'];
                $article['a_is_top'] = $article['top'];
                $article['a_author'] = $article['author'];
                $article['a_state'] = $article['state'];
                $article['a_keywords'] = $article['keywords'];
                $article['a_is_comment'] = $article['comment'];
                $article['a_is_original'] = $article['original'];
                $ac_array = $article['select_ac'];
                if(!empty($ac_array) && is_array($ac_array)){
                    foreach ($ac_array as $k => $v){
                        $ac_str .= $v .',';
                    }
                    $ac_str =  rtrim($ac_str, ',');
                    $article['a_category_id'] = $ac_str;
                }
                $article['a_is_original'] = $article['original'];
                $article['a_content'] = htmlspecialchars_decode($article['content']);
                $result = $this->db_Articles->add($article);
                if ($result) {
                    $this->success("文章发布成功",U('Admin/Article/show'),'',1);
                } else {
                    $this->error("文章发布失败",U('Admin/Article/show'),'',1);
                }
            }else{
                $this->error("TP令牌验证错误",U('Admin/Article/show'),'',1);

            }
        }else{
            //文章分类
            $category_list = $this->db_Article_category->select();
            $this->assign("category_list",$category_list);
            $this->display();
        }
    }
    public function edit(){
        if(IS_POST){
            if ($this->db_Articles->autoCheckToken($_POST)){
                $article_id = I('post.id');
                $article_info = $this->db_Articles->getByA_id($article_id);
                if(empty($article_info)){
                    $this->error("无法获取原文章",U('Admin/Article/show'),'',1);
                }
                $article_edit = I('post.');
                $ac_str = '';
                $article_edit['a_title'] = $article_edit['title'];
                $article_edit['a_is_top'] = $article_edit['top'];
                $article_edit['a_author'] = $article_edit['author'];
                $article_edit['a_state'] = $article_edit['state'];
                $article_edit['a_keywords'] = $article_edit['keywords'];
                $article_edit['a_is_comment'] = $article_edit['comment'];
                $article_edit['a_is_original'] = $article_edit['original'];
                $ac_array = $article_edit['select_ac'];
                if(!empty($ac_array) && is_array($ac_array)){
                    foreach ($ac_array as $k => $v){
                        $ac_str .= $v .',';
                    }
                    $ac_str =  rtrim($ac_str, ',');
                }
                if($article_info['a_category_id'] != $ac_str){
                    $article_edit['a_category_id'] = $ac_str;
                }
                $article_edit['a_is_original'] = $article_edit['original'];
                $article_edit['a_content'] =  htmlspecialchars_decode($article_edit['content']);
                $result = $this->db_Articles->where(array('a_id'=>$article_id))->save($article_edit);
                if ($result) {
                    $this->success("修改成功",U('Admin/Article/show'),'',1);
                } else {
                    $this->error("修改失败",U('Admin/Article/show'),'',1);
                }
            }else{
                $this->error("TP令牌验证错误",U('Admin/Article/show'),'',1);
            }
        }else {
            $a_id = I('get.a_id');
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
    //修改状态,放入回收站
    public function del(){
        if(IS_POST){
            $json_array = array();
            $del_id = I('post.a_id');
            $article_info = $this->db_Articles->getByA_id($del_id);
            if(!empty($article_info) && $article_info['a_state'] !=  C('ARTICLE_RECYCLE')){
                $this->db_Articles->where(array('a_id'=>$del_id))->save(array('a_state'=>C('ARTICLE_RECYCLE')));
                $json_array['msg'] = 'true';
            }else{
                $json_array['msg'] = 'false';
            }
            echo json_encode($json_array);
        }
    }
    public function category_show(){
        $category_list = $this->db_Article_category->select();
        $this->assign("category_count",count($category_list));
        $this->assign("category_list",$category_list);
        $this->display();
    }
    public function category_add(){
        if(IS_POST){
            if ($this->db_Article_category->autoCheckToken($_POST)){
                $category = I('post.');
                $category['ac_name'] = $category['name'];
                $category['ac_sort'] = intval($category['sort']);
                $category['ac_description'] = $category['description'];
                $result = $this->db_Article_category->add($category);
                if ($result) {
                    $this->success("分类添加成功",U('Admin/Article/category_show'),'',1);
                } else {
                    $this->error("分类添加失败",U('Admin/Article/category_show'),'',1);
                }
            }else{
                $this->error("TP令牌验证错误",U('Admin/Article/category_show'),'',1);

            }
        }else{
            $this->display();
        }
    }
    public function tag_show(){
        $tag_list = $this->db_Tag->select();
        $this->assign("tag_count",count($tag_list));
        $this->assign("tag_list",$tag_list);
        $this->display();
    }
    public function tag_add(){
        if(IS_POST){
            if ($this->db_Tag->autoCheckToken($_POST)){
                $tag= I('post.');
                $tag['ht_name'] = $tag['name'];
                $tag['ht_sort'] = intval($tag['sort']);
                $result = $this->db_Tag->add($tag);
                if ($result) {
                    $this->success("标签添加成功",U('Admin/Article/tag_show'),'',1);
                } else {
                    $this->error("标签添加失败",U('Admin/Article/tag_show'),'',1);
                }
            }else{
                $this->error("TP令牌验证错误",U('Admin/Article/tag_show'),'',1);
            }
        }else{
            $this->display();
        }
    }
}
