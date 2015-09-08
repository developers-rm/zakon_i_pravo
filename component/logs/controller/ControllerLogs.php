<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerLogs
 *
 * @author s.novoseletskiy
 */
class ControllerLogs extends Controller {
    
    protected function GetModel() {
        return parent::GetModel();
    }
    
    public function RunAction($param = array(), &$vParam = array(), &$vShab = array()) {
        $tracert = serialize($param["tracert"]);
        $this->GetModel()->InsertLog(array("error_text" => $tracert, "timepoint" => $param["timestamp"]));
    }
}
