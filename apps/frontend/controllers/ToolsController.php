<?php
namespace Store\Frontend\Controllers;

use Store\Frontend\Models\Methods;
class ToolsController extends ControllerAuth
{

   /*
    * 后台左侧
    */
    public function indexAction()
    {
        $data =;
        
    }
    
    /*
     * 显示模块
     */
    public function addAction() {
        if($this->request->isAjax()){
            $list = new Methods();
            $list->method = $this->request->getPost('name',"string");
            $list->alias = $this->request->getPost('alias',"string");
            $list->pid = $this->request->getPost('pid',"int");
            $list->children = 0;
            $id = $list->create();
            if ( $list->pid!=0 ){
                $ids = Methods::find(array("columns"=>"id","condition"=>"id=".$list->pid));
                $idstr = implode(",", $ids->toArray());
                $ids->children = $idstr;
                $ids->save();
            }
        }
    }

    /*
     * 添加模块
     */
    public function editAction() {
        if ($this->request->hasQuery('id')){
            $id = $this->request->get('id','int');
            $data = Methods::findFirst("id=".$id);
            $this->view->data = $data;
        }
        
        if ($this->request->isPost()){
            $id = $this->request->get('id','int');
            $data = Methods::findFirst("id=".$id);
            $data->method = $this->request->getPost('method','string');
            $data->method = $this->request->getPost('alias','string');
            $data->save();
        }
            
    }
    
    /*
     * 删除方法
     */
    public function deleteAction() {
        $id = $this->request->get('id','int');
        $obj = Methods::findFirst($id);
        if ($obj->pid!=0){
            foreach (Methods::find(array('condition'=>"id in({$obj->children})")) as $method){
                $method->delete();
            }
            echo "suc";
        }else {
            if ($obj->delete()){
                echo "suc";
            }
        }
    }
    
    
    
}

