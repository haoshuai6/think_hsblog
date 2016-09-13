<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 后台首页
 */
class ArticleController extends AdminBaseController{
    private $db_Articles,$db_Article_category,$db_tag;
    public function __construct(){
        parent::__construct();
        $this->db_Articles = M ('Articles');
        $this->db_Article_category = M ('Article_category');
        $this->db_Tag = M ('Tag');
    }
    // 文章首页
    public function show(){
        $article_list = $this->db_Articles->select();
        $this->assign("article_count",count($article_list));
        $this->assign("article_list",$article_list);
        $this->display();
    }
    public function add(){
        if(IS_POST){
            if ($this->db_Articles->autoCheckToken($_POST)){
                $article = I('post.');
                $article['a_title'] = $article['title'];
                $article['a_author'] = $article['author'];  
                $article['a_keywords'] = $article['keywords'];
                $article['a_content'] = htmlspecialchars_decode($article['editorValue']);
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
            $this->display();
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
