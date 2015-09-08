<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VHContent
 *
 * @author n.tereschenko
 */
class VHContent {
	public static function MakeDate($date){
		$d=WithDate::DateTimeToDate($date);
		$d_arr = explode('-', $d);
		$d_arr = array_reverse($d_arr);
		return implode('.', $d_arr);
	}
}
