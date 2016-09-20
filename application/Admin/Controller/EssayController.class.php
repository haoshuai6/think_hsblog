<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 心情随笔 记录点滴
 */
class EssayController extends AdminBaseController{
    private $db_Articles,$db_Article_category,$db_Tag;
    public function __construct(){
        parent::__construct();
        $this->db_Tag = M ('Tag');
        $this->db_Articles = M ('Articles');
        $this->db_Article_category = M ('Article_category');
    }
    public function index(){
        $this->display();
    }
}
