<?php
namespace Store\Frontend\Controllers;

use Store\Frontend\Models\Methods;
use Phalcon\Mvc\View;
use Phalcon\Paginator\Adapter\Model;

class ToolsController extends ControllerAuth
{

    public function indexAction()
    {
        $data = Methods::find(array('limit'=>array("offset"=>0,"number"=>10)));
        $cpage = $this->request->get('page','int');
        $pagination = new Model(array(
            'data'=>$data,
            'page'=>$cpage,
            'limit'=>10
        ));       
        $page = $pagination->getPaginate();
        $this->view->page = $page;
        
    }

    /*
     * 显示模块
     */
    public function addAction()
    {
        if ($this->request->isAjax()) {
            $list = new Methods();
            $list->method = $this->request->getPost('method', "string");
            $list->alias = $this->request->getPost('alias', "string");
            $list->pid = $this->request->getPost('pid', "int");
            $list->children = 0;
            $list->show = $this->request->getPost('show', "int");
            if ($list->save()) {
                
                if ($list->pid != 0) {
                    $ids = Methods::find(array(
                        "columns" => "id",
                        "condition" => "id=" . $list->pid
                    ))->toArray();
                    $idstr = implode(",", $ids->toArray());
                    $ids->children = $idstr;
                    if ($ids->save()) {
                        echo json_encode(array(
                            "status" => "suc",
                            "msg" => "添加成功"
                        ));
                        exit;
                    } else {
                        echo json_encode(array(
                            "status" => "fail",
                            "msg" => "添加失败"
                        ));
                        exit;
                    }
                }
                echo json_encode(array(
                    "status" => "suc",
                    "msg" => "添加成功"
                ));
            }
            $this->view->setRenderLevel(View::LEVEL_NO_RENDER);
        }
        $pid = $this->request->has('pid') ? $this->request->get('pid', 'int') : 0;
        $this->view->pid = $pid;
    }

    /*
     * 编辑模块
     */
    public function editAction()
    {
        if ($this->request->hasQuery('id')) {
            $id = $this->request->get('id', 'int');
            $data = Methods::findFirst("id=" . $id);
            $this->view->data = $data;
        }
        
        if ($this->request->isPost()) {
            $id = $this->request->get('id', 'int');
            $data = Methods::findFirst("id=" . $id);
            $data->method = $this->request->getPost('method', 'string');
            $data->method = $this->request->getPost('alias', 'string');
            $list->show = $this->request->getPost('show', "int");
            $data->save();
        }
    }

    /*
     * 删除方法
     */
    public function deleteAction()
    {
        $id = $this->request->get('id', 'int');
        $obj = Methods::findFirst($id);
        if ($obj->pid != 0) {
            foreach (Methods::find(array(
                'condition' => "id in({$obj->children})"
            )) as $method) {
                $method->delete();
            }
            echo "suc";
        } else {
            if ($obj->delete()) {
                echo "suc";
            }
        }
    }
}

