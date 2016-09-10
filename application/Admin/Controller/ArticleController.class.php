<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 后台首页
 */
class ArticleController extends AdminBaseController{
    private $db_Articles;
    public function __construct(){
        parent::__construct();
        $this->db_Articles = M ('Articles');
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
                    $this->success("文章发布成功",U('Admin/Article/article_list'),'',1);
                } else {
                    $this->error("文章发布失败",U('Admin/Article/article_list'),'',1);
                }
            }else{
                $this->error("TP令牌验证错误",U('Admin/Article/article_list'),'',1);

            }
        }else{
            $this->display();
        }
    }
    public function category_show(){
        $this->display();
    }
    public function category_add(){
        $this->display();
    }
}
