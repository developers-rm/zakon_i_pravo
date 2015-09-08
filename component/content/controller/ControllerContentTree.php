<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerContent
 *
 * @author user
 */
class ControllerContentTree extends Controller {
    private $shab_collection = array(6 => "services/service.read.phtml");
    /**
     *
     * @return ModelContentTree
     */
    protected function GetModel() {
        return parent::GetModel();
    }

    public function IndexAction($param = array(), &$vParam = array(), &$vShab = array()) {
        $vParam['item'] = $this->GetModel()->GetItem($param['id']);
        $vParam['items'] = $this->GetModel()->GetItems("p_id = {$param['id']}");
        if (!$vParam['item'])
            $this->NotFoundAction();
        else {
            $vParam['breadcrumbs'] = $this->GetModel()->MakeBreadcrumbs($param['id']);
            $vParam['title'] = !empty($vParam['item']['title']) ? $vParam['item']['title'] : $vParam['item']['name'];
            $vParam['description'] = (isset($vParam['item']['description']) ? $vParam['item']['description'] : '');
            $vParam['keywords'] = (isset($vParam['item']['keywords']) ? $vParam['item']['keywords'] : '');
            
            if ($vParam['item']['have_items']) {
                $page = isset($param['page']) && (int) $param['page'] ? (int) $param['page'] : 1;
                $vParam['items'] = $this->GetModel()->GetActiveItems(
                $param['id'], $page, $vParam['item']['items_per_page'], $vParam['item']['order_by'], $vParam['item']['order_type']
                );
            }
            $vParam['module_name'] = $this->ModuleName;
            if ($vParam['item']['shablon_name'])
                $vShab['content'] = $this->ViewPath . $vParam['item']['shablon_name'];
            else
                if(isset($this->shab_collection[$vParam['item']["p_id"]]))
                    $vShab['content'] = $this->ViewPath.$this->shab_collection[$vParam['item']["p_id"]];
                else
                    $vShab['content'] = $this->ViewPath . 'default.phtml';
        }
    }

}
