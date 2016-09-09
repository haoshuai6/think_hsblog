<?php
namespace Admin\Model;
use Common\Model\BaseModel;
/**
* 文章model
*/
class ArticlesModel extends BaseModel{
    
    public function addArticle(){
        $data = I('post.');

        $article['a_author'] = $data['author'];
        $article['a_content'] = $data['editorValue'];
        $article['a_keywords'] = $data['keywords'];

        if($aid = $this->add($article)){
            var_dump('success');die;
            return $aid;
        }else{
            var_dump('asdfsdf');die;
            return false;
        }
    }

    // 修改
    public function editArticle(){

    }
    // 删除
    public function delArticle(){

        return true;
    }
    // 传递$map获取count数据
    public function getCountData($map=array()){
        return $this->where($map)->count();
    }

}

