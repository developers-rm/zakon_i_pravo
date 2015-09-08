<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerResponses
 *
 * @author s.novoseletskiy
 */
class ControllerResponses extends Controller {
    private $blacklist = array("html", "phtml", "php", "txt", "bmp");
     
    protected function GetModel() {
        return parent::GetModel('responses');
    }
    
    protected function GetModelContent() {
        return parent::GetModel('content');
    }
    
    public function DownloadFileAction($param = array(), &$vParam = array(), &$vShab = array()) {
        if(!isset($_FILES) || empty($_FILES)) {
            echo "Файл изображения не был передан";
            die;
        }

        $file_extend = array_pop(explode(".", $_FILES["data"]["name"]));
            
        if(!in_array($file_extend, $this->blacklist)) {
            $handler = $this->GetModel()->DownloadFile($_FILES, $param, $file_extend);
            if($handler === true) {
                echo "Файл успешно загружен, <a target='_blank' href='/img/responses/{$param["form_number"]}/attachment.{$file_extend}'>Посмотреть</a>";
            }
        } else {
            echo "Данный формат файла запрещён к загрузке";
        }
        
        die;
    }
    
    public function ReadAction($param = array(), &$vParam = array(), &$vShab = array()) {
        $vParam["item"] = $this->GetModelContent()->GetItem(9);
        $result = $this->GetModel()->GetItem($param["id"]);
        $vParam['item_response'] = $result;
        $vShab['content'] = $this->ViewPath."read.phtml";
    }
    
    public function AddResponseAction($param = array(), &$vParam = array(), &$vShab = array()) {
        $add = $this->GetModel()->AddResponse($param["data"]);
        if($add == true) {
            echo view::template(ROOT_PATH."/component/index/view/forms/response/response.phtml"); 
        }
        die;
    }
    
    public function IndexAction($param = array(), &$vParam = array(), &$vShab = array()) {
        $item = $this->GetModelContent()->GetItem($param["id"]);
        if ($item['have_items']) {
            $page = isset($param['page']) && (int) $param['page'] ? (int) $param['page'] : 1;
            $count = $this->GetModel()->GetCount();
            $vParam["responses"] = $this->GetModel()->GetActiveItems(
            0, $page, $item['items_per_page'], "", ""
            );
        }
        $vParam["item"] = $item;
        $vParam['pagenation'] = $this->GetModelContent()->MakePagenation($page, $count, $item['items_per_page'],
                                                                         array("url" => app::I()->MakeUrl("responses", "index", array("id" => $param["id"]))));
        $vParam['number_response'] = uniqid();
        $vShab['content'] = $this->ViewPath."index.phtml";
    }
}
