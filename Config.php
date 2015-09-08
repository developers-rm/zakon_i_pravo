<?php

/**
 * Config of application
 *
 * @author Nikolay Tereschenko
 */
class Config {

// <editor-fold defaultstate="collapsed" desc="Syte config (domain, url & other)">
	/**
	 * Домен
	 * @var string
	 */
	const SITE_DOMAIN_NAME = 'zakon-i-pravo.region.media';

	/**
	 * Урл
	 * @var string
	 */
	const SITE_URL = 'http://zakon-i-pravo.region.media/';
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Data Base config ( login, password & other )">
	/**
	 * хост базы
	 * @var string
	 */
	const DB_HOST = "localhost";

	/**
	 * логин от базы
	 * @var str
	 */
	const DB_LOGIN = "zakon-i-pravo";

	/**
	 * пароль от базы
	 * @var str
	 */
	const DB_PASSWORD = "sjeQinfV";

	/**
	 * название базы
	 * @var str
	 */
	const DB_NAME = "zakon-i-pravo";
// </editor-fold>
	/**
	 * Директория для фотографий
	 * @var string
	 */
	const FOLDERS_OF_IMG = "/img/";
	const FOLDERS_OF_COMPOMEMT = "/component/";
	const ITEM_TEAMPLATE_PATH = '/component/main/view/admin/item/';

}
