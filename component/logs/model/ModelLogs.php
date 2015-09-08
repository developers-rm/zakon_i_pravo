<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelLogs
 *
 * @author s.novoseletskiy
 */
class ModelLogs extends Model {
    
    public function InsertLog($param = array()) {
        $this->add($param);
    }
}
