<?php
namespace Store\Frontend\Controllers;


use Store\Frontend\Models\Roles;
use Store\Frontend\Models\Admins;
use Store\Frontend\Models\Methods;
use Store\Extensions\Funs;

class AclController extends ControllerAuth
{
    //admin_acl,admin_role,admin_role_group

   /*
    * 权限列表
    */
    public function indexAction()
    {
        
    }
    
    /*
     * 权限列表
     */
    public function plistAction() {
        $data = Methods::find()->toArray();
        $acl = Funs::genTree5($data);
        $this->view->acl = $acl;
    }
    
    /**
     * 分配权限
     */    
    public function allotAction(){
        
    }

    /*
     * 创建角色组
     */
    public function groupAction() {
        $acl = new Roles();
        $acl->role = $this->request->get('role','string');
        $acl->alias = $this->request->get('alias','string');
        $acl->Privilege = $this->request->get('privilege','string');
        if ($acl->create()){
            echo json_encode(array('status'=>'suc','msg'=>'save suc'));
        }else{
            echo json_encode(array('status'=>'fail','msg'=>'save fail'));
        }
    }
    
    /*
     * 为角色组添加成员
     */
    public function rlistAction() {
        $admins = new Admins();
        $data = $admins->find()->toArray();
        $group = Roles::find(array("columns"=>"id,alias"))->toArray();
    }
    
    
    
}

