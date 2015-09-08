<?php

/**
 * Controller for index page( opens by default )
 *
 * @author Tereschenko Nikolay
 */
class ControllerIndex extends Controller {
        private $slovar = array("name" => "Имя", "phone" => "Телефон", 
                                "text" => "Сообщение", "services" => "Услуга");
	/**
	 * Return object of index model
	 * @return ModelIndex
	 */
	protected function GetModel() {
		return parent::GetModel();
	}

	/**
	 * Return object of content model
	 * @return ModelContentTree
	 */
	protected function GetModelContent() {
            return parent::GetModel('content');
	}
        
        public function SendFormAction($param = array(), &$vParam = array(), &$vShab = array()) {
            $to = isset($param["mail_to"]) ? $param["mail_to"] : "developers@region-media-yug.ru";
            $theme = isset($param["mail_theme"]) ? $param["mail_theme"] : "Форма обратной связи заполнена";

            foreach($param["mail"] as $index => $value) {
                $param["mail"]["data"][$index]["value"] = !empty($value) ? $value : "Не заполнялось";
                $param["mail"]["data"][$index]["label"] = $this->slovar[$index];
            }     
            $data["data"] = $param["mail"]["data"];
            
            $body_mail = view::template(ROOT_PATH."/component/index/view/forms/body/default.phtml", $data); 
            $result = MailSender::I()->SendMail($to, $theme, $body_mail);    
            
            if($result == true) {
                $shab_response = view::template(ROOT_PATH."/component/index/view/forms/response/default.phtml", array());
            } else {
                app::I()->StartModule("logs","Run",array("tracert" => debug_backtrace(), 
                                                         "timestamp" => time()));                
                $shab_response = view::template(ROOT_PATH."/component/index/view/forms/response/error.phtml", array());
            }
            
            echo $shab_response;
            die;
        }
        
	/**
	 * Actionf for index page
	 * @param array $param
	 * Parameters passed to the controller
	 * @param array $vParam
	 * Parameters passed to the view
	 * @param array $vShab
	 * An array of used templates
	 */
	public function IndexAction($param = array(), &$vParam = array(), &$vShab = array()) {
		$vParam['item'] = $this->GetModelContent()->GetItem(1);

		if ($vParam['item']) {
			$vParam['title'] = !empty($vParam['item']['title']) ? $vParam['item']['title'] : $vParam['item']['name'];
			$vParam['description'] = (isset($vParam['item']['description']) ? $vParam['item']['description'] : '');
			$vParam['keywords'] = (isset($vParam['item']['keywords']) ? $vParam['item']['keywords'] : '');
                }

		$vShab['content'] = $this->ViewPath . 'index_content.phtml';
	}
	/**
	 * Actionf for page 404
	 * @param array $param
	 * Parameters passed to the controller
	 * @param array $vParam
	 * Parameters passed to the view
	 * @param array $vShab
	 * An array of used templates
	 */
	public function NotFoundAction($param = array(), &$vParam = array(), &$vShab = array()) {
		header("HTTP/1.0 404 Not Found");
		$vParam['item'] = $this->GetModelContent()->GetItem(2);
		if ($vParam['item']) {
                    $vParam['title'] = "Страница не найдена";
                    $vParam['description'] = (isset($vParam['item']['description']) ? $vParam['item']['description'] : '');
                    $vParam['keywords'] = (isset($vParam['item']['keywords']) ? $vParam['item']['keywords'] : '');
		}
		$vShab['content'] = $this->ViewPath . '404.phtml';
	}

}
