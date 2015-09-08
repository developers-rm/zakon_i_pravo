<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelResponses
 *
 * @author s.novoseletskiy
 */
class ModelResponses extends Model {

    public function DownloadFile(array $file, array $params, $file_extend) {
        if (!file_exists("img/responses/{$params["form_number"]}/"))
            mkdir("img/responses/{$params["form_number"]}/", 0777);

        $upload = WithImage::I()->UploadFile($file["data"]["tmp_name"], "img/responses/{$params["form_number"]}/attachment.{$file_extend}");

        if ($upload == true) {
            WithImage::I()->CropTo("img/responses/{$params["form_number"]}/attachment.{$file_extend}", "img/responses/{$params["form_number"]}/attachment.{$file_extend}", array("x" => 280, "y" => 280));
            return true;
        } else {
            echo "Произошла ошибка при загрузке файла";
        }
    }
    
    public function GetActiveItems($pId, $page = 0, $itemsPerPage = 0, $orderBy = '', $orderType = 0) {
	if ($itemsPerPage)
            $limit = (0 + ($page - 1) * $itemsPerPage) . ",$itemsPerPage";
	else
            $limit = 0;
            $where = "`p_id` = {$pId} and `active` = 1";

            return $this->GetItems($where, $limit);
    }

    public function AddResponse(array $params) {
        $add = $this->add(array("name" => $params["name"], 
                                "voice" => $params["voice"], 
                                "text" => $params["text"], 
                                "number_response" => $params["number"],
                                "timepost" => time()));
        return $add;
    }

}
