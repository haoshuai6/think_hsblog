<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 后台首页
 */
class ArticleController extends AdminBaseController{
    private $db_Articles,$db_Article_category,$db_Tag,$db_Article_tag;
    public function __construct(){
        parent::__construct();
        $this->db_Tag = M ('Tag');
        $this->db_Articles = D ('Articles');
        $this->db_Article_tag = D ('Article_tag');
        $this->db_Article_category = D ('Article_category');

    }
    // 文章首页
    public function show(){
        $show_array['a_state'] = array('neq',C('ARTICLE_RECYCLE')) ;
        $article_list = $this->db_Articles->where($show_array)->select();
        if(!empty($article_list) && is_array($article_list)){
            foreach ($article_list as $k => $v){
                //分类
                $ac_array['ac_id'] = array('eq',$v['a_category_id']);
                $category_info = $this->db_Article_category->where($ac_array)->select();
                $article_list[$k]['category_info'] =  $category_info;
                //标签
                $tag_array['at_article_id'] = $v['a_id'];
                $tag_id_list = $this->db_Article_tag->where($tag_array)->select();
                $tag_id_str = '';
                foreach ($tag_id_list as $key => $val){
                    $tag_id_str .= $val['at_tag_id'].',';
                }
                $tag_id_str =  rtrim($tag_id_str, ',');

                $tag_list_array['ht_id'] = array('in',$tag_id_str);
                $tag_list = $this->db_Tag->where($tag_list_array)->select();
                $article_list[$k]['tag_info'] =  $tag_list;
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
            $rules = array (
                array('a_title','require','文章标题必须'),
                array('a_category_id','require','文章分类必须'),
                array('a_author','require','文章作者必须'),
                array('a_content','require','文章内容必须'),
            );
            $article = I('post.');
            $article['a_title'] = $article['title'];
            $article['a_is_top'] = $article['top'];
            $article['a_author'] = $article['author'];
            $article['a_state'] = $article['state'];
            $article['a_keywords'] = $article['keywords'];
            $article['a_description'] = $article['description'];

            $article['a_is_comment'] = $article['comment'];
            $article['a_is_original'] = $article['original'];

            $article['a_category_id'] = $article['select_ac'];

            $article['a_is_original'] = $article['original'];
            $article['a_content'] = htmlspecialchars_decode($article['content']);


            //获取文章内容中的图片 加水印
            $image_path = get_ueditor_image_path($article['a_content']);
            if(!empty($image_path)){
                // 添加水印
                if(C('WATER_TYPE')!=0){
                    foreach ($image_path as $k => $v) {
                        add_water('.'.$v);
                    }
                }
            }

            if ($this->db_Articles->validate($rules)->create($article)){
                $result = $this->db_Articles->add($article);
                if ($result) {
                    $tag_array = $article['select_tag'];
                    if(!empty($tag_array) && is_array($tag_array)){
                        $add_array = '';
                        foreach ($tag_array as $k => $v){
                            $add_array['at_article_id']= $result;
                            $add_array['at_tag_id']= $v;
                            $this->db_Article_tag->add($add_array);
                        }
                    }
                    $this->success("文章发布成功",U('Admin/Article/show'),'',1);
                } else {
                    $this->error("文章发布失败",U('Admin/Article/show'),'',1);
                }
            }else{
                $this->error($this->db_Articles->getError(),'',1);
            }
        }else{
            //文章分类
            $category_list = $this->db_Article_category->select();
            $this->assign("category_list",$category_list);
            //文章标签
            $tag_list = $this->db_Tag->select();
            $this->assign("tag_list",$tag_list);
            $this->display();
        }
    }
    public function edit(){
        if(IS_POST){
            $rules = array (
                array('a_title','require','文章标题必须'),
                array('a_category_id','require','文章分类必须'),
                array('a_author','require','文章作者必须'),
                array('a_content','require','文章内容必须'),
            );
            $article_id = I('post.id');
            $article_info = $this->db_Articles->getByA_id($article_id);
            if(empty($article_info)){
                $this->error("无法获取原文章",U('Admin/Article/show'),'',1);
            }
            $article_edit = I('post.');

            $article_edit['a_title'] = $article_edit['title'];
            $article_edit['a_is_top'] = $article_edit['top'];
            $article_edit['a_author'] = $article_edit['author'];
            $article_edit['a_state'] = $article_edit['state'];
            $article_edit['a_keywords'] = $article_edit['keywords'];
            $article_edit['a_description'] = $article_edit['description'];

            $article_edit['a_is_comment'] = $article_edit['comment'];
            $article_edit['a_is_original'] = $article_edit['original'];

            $article_edit['a_category_id'] = $article_edit['select_ac'];

            $article_edit['a_is_original'] = $article_edit['original'];
            $article_edit['a_content'] =  htmlspecialchars_decode($article_edit['content']);
            //获取文章内容中的图片 加水印
            $image_path = get_ueditor_image_path($article_edit['a_content']);
            if(!empty($image_path)){
                // 添加水印
                if(C('WATER_TYPE')!=0){
                    foreach ($image_path as $k => $v) {
                        add_water('.'.$v);
                    }
                }
            }
            if ($this->db_Articles->validate($rules)->create($article_edit)){
                $result = $this->db_Articles->where(array('a_id'=>$article_id))->save($article_edit);
                if ($result !== false) {
                    $this->db_Article_tag->where(array('at_article_id'=>$article_id))->delete();
                    $tag_array = $article_edit['select_tag'];
                    if(!empty($tag_array) && is_array($tag_array)){
                        $edit_array = '';
                        foreach ($tag_array as $k => $v){
                            $edit_array['at_article_id'] = $article_id;
                            $edit_array['at_tag_id'] = $v;
                            $this->db_Article_tag->add($edit_array);
                        }
                    }
                    $this->success("修改成功",U('Admin/Article/show'),'',1);
                } else {
                    $this->error("修改失败",U('Admin/Article/show'),'',1);
                }
            }else{
                $this->error($this->db_Articles->getError(),'',1);
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
            //文章标签
            $tag_list = $this->db_Tag->select();
            $this->assign("tag_list",$tag_list);
            //已经选中的标签
            $tag_list_info = $this->db_Article_tag->where(array('at_article_id'=>$a_id))->select();
            $tag_list_select = '';
            foreach ($tag_list_info as $k => $v){
                $tag_list_select .= $v['at_tag_id'].',';
            }
            $tag_list_select =  rtrim($tag_list_select, ',');
    
            $this->assign("tag_list_select",$tag_list_select);
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

    //从回收站,彻底删除
    public function del_completely(){
        if(IS_POST){
            $json_array = array();
            $del_id = I('post.a_id');
            $article_info = $this->db_Articles->getByA_id($del_id);
            if(!empty($article_info) && $article_info['a_state'] ==  C('ARTICLE_RECYCLE')){
                $this->db_Articles->where(array('a_id'=>$del_id))->delete();
                $json_array['msg'] = 'true';
            }else{
                $json_array['msg'] = 'false';
            }
            echo json_encode($json_array);
        }
    }
    //从回收站,还原文章
    public function a_restore(){
        if(IS_POST){
            $json_array = array();
            $restore_id = I('post.a_id');
            $article_info = $this->db_Articles->getByA_id($restore_id);
            if(!empty($article_info) && $article_info['a_state'] !=  C('ARTICLE_NORMAL')){
                $this->db_Articles->where(array('a_id'=>$restore_id))->save(array('a_state'=>C('ARTICLE_NORMAL')));
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
    public function category_edit(){
        if(IS_POST){
            $rules = array (
                array('ac_name','require','分类名称必须'),
                array('ac_description','require','分类描述必须'),
            );
            $category_id = I('post.id');
            $category_info = $this->db_Article_category->getByAc_id($category_id);
            if(empty($category_info)){
                $this->error("无法获取原分类",U('Admin/Article/category_show'),'',1);
            }
            $category_edit = I('post.');
            $category_edit['ac_name'] = $category_edit['name'];
            $category_edit['ac_sort'] =  intval($category_edit['sort']);
            $category_edit['ac_description'] = $category_edit['description'];
            if ($this->db_Article_category->validate($rules)->create($category_edit)){
                $result = $this->db_Article_category->where(array('ac_id'=>$category_id))->save($category_edit);
                if ($result !== false) {
                    $this->success("分类修改成功",U('Admin/Article/category_show'),'',1);
                } else {
                    $this->error("分类修改失败",U('Admin/Article/category_show'),'',1);
                }
            }else {
                $this->error($this->db_Article_category->getError(),'',1);
            }
        }else {
            $ac_id = I('get.ac_id');
            if(empty($ac_id)){
                $this->error("无法获取原分类",U('Admin/Article/category_show'),'',1);
            }
            $category_info = $this->db_Article_category->getByAc_id($ac_id);
            if(empty($category_info)){
                $this->error("无法获取原分类",U('Admin/Article/category_show'),'',1);
            }
            $this->assign("category_info",$category_info);
            $this->display();
        }
    }
    public function category_add(){
        if(IS_POST){
            $rules = array (
                array('ac_name','require','分类名称必须'),
                array('ac_description','require','分类描述必须'),
            );
            $category = I('post.');
            $category['ac_name'] = $category['name'];
            $category['ac_sort'] = intval($category['sort']);
            $category['ac_description'] = $category['description'];
            if ($this->db_Article_category->validate($rules)->create($category)){
                $result = $this->db_Article_category->add($category);
                if ($result) {
                    $this->success("分类添加成功", U('Admin/Article/category_show'), '', 1);
                } else {
                    $this->error("分类添加失败", U('Admin/Article/category_show'), '', 1);
                }
            }else {
                $this->error($this->db_Article_category->getError(),'',1);
            }
        }else{
            $this->display();
        }
    }
    //删除分类[有文章不可删除]
    //by haoshuai_it 20160918 未完成，目前分类只能修改不能删除
    public function category_del(){
        if(IS_POST){
            $json_array = array();
            $del_id = I('post.ac_id');
            $category_info = $this->db_Article_category->getByAc_id($del_id);
            if(!empty($category_info) && $category_info['ac_state'] !=  C('ARTICLE_CATEGORY_NORMAL')){
                // 判断该分类下有无已发布文章
                //$article_info = $this->db_Articles->where(array(''=>))->select();
                $this->db_Article_category->where(array('ac_id'=>$del_id))->delete();
                $json_array['msg'] = 'true';
            }else{
                $json_array['msg'] = 'false';
            }
            echo json_encode($json_array);
        }
    }
    public function tag_show(){
        $tag_list = $this->db_Tag->select();
        $this->assign("tag_count",count($tag_list));
        $this->assign("tag_list",$tag_list);
        $this->display();
    }

    public function tag_edit(){
        if(IS_POST){
            $rules = array (
                array('ht_name','require','标签名称必须'),
            );
            $tag_id = I('post.id');
            $tag_info = $this->db_Tag->getByHt_id($tag_id);
            if(empty($tag_info)){
                $this->error("无法获取原标签",U('Admin/Article/tag_show'),'',1);
            }
            $tag_edit = I('post.');
            $tag_edit['ht_name'] = $tag_edit['name'];
            $tag_edit['ht_sort'] = intval($tag_edit['sort']);
            if ($this->db_Tag->validate($rules)->create($tag_edit)){
                $result = $this->db_Tag->where(array('ht_id' => $tag_id))->save($tag_edit);
                if ($result !== false) {
                    $this->success("标签修改成功", U('Admin/Article/tag_show'), '', 1);
                } else {
                    $this->error("标签修改失败", U('Admin/Article/tag_show'), '', 1);
                }
            }else {
                $this->error($this->db_Tag->getError(),'',1);
            }
        }else {
            $ht_id = I('get.ht_id');
            if(empty($ht_id)){
                $this->error("无法获取原标签",U('Admin/Article/tag_show'),'',1);
            }
            $tag_info = $this->db_Tag->getByHt_id($ht_id);
            if(empty($tag_info)){
                $this->error("无法获取原标签",U('Admin/Article/tag_show'),'',1);
            }
            $this->assign("tag_info",$tag_info);
            $this->display();
        }
    }

    public function tag_add(){
        if(IS_POST){
            $rules = array (
                array('ht_name','require','标签名称必须'),
            );
            $tag= I('post.');
            $tag['ht_name'] = $tag['name'];
            $tag['ht_sort'] = intval($tag['sort']);
            if ($this->db_Tag->validate($rules)->create($tag)){
                $result = $this->db_Tag->add($tag);
                if ($result) {
                    $this->success("标签添加成功", U('Admin/Article/tag_show'), '', 1);
                } else {
                    $this->error("标签添加失败", U('Admin/Article/tag_show'), '', 1);
                }
            }else {
                $this->error($this->db_Tag->getError(),'',1);
            }
        }else{
            $this->display();
        }
    }
}
