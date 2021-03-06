<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerContent
 *
 * @author n.tereschenko
 */
class ControllerNews extends Controller {

    /**
     * Default action
     * @param array $param
     * Parameters passed to the controller
     * @param array $vParam
     * Parameters passed to the view
     * @param array $vShab
     * An array of used templates
     */
    
    protected function GetModel() {
        return parent::GetModel('content');
    }
    
    public function ReadNewsAction($param = array(), &$vParam = array(), &$vShab = array()) {
        
    }
    
    public function IndexAction($param = array(), &$vParam = array(), &$vShab = array()) {
        $vParam['item'] = $this->GetModel()->GetItem($param['id']);
        $vParam['items'] = $this->GetModel()->GetItems("p_id = {$param["id"]} and active = 1");
        
        if ($vParam['item']) {
            $vParam['title'] = !empty($vParam['item']['title']) ? $vParam['item']['title'] : $vParam['item']['name'];
            $vParam['description'] = (isset($vParam['item']['description']) ? $vParam['item']['description'] : '');
            $vParam['keywords'] = (isset($vParam['item']['keywords']) ? $vParam['item']['keywords'] : '');
        }
        
        $vShab['content'] = $this->ViewPath.'index.phtml';
    }
}
