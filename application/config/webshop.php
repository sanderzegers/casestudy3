<?php

$CI =& get_instance();
$CI->load->helper('url');


// Load default settings from global config file. Shared with Backend.
include $_SERVER['DOCUMENT_ROOT'].'/config.inc';

/*
|--------------------------------------------------------------------------
| Path of image articles
|--------------------------------------------------------------------------
| This is the path where are all the article images are located.
|
| Default: base_url().'imagearticles/';
|
*/

$config['articleImage'] = base_url().$strImagePath;


/*
|--------------------------------------------------------------------------
| Name of default picture
|--------------------------------------------------------------------------
| If there are no pictures for the article, show this single picture.
| This picture should be located under imagearticles.
|
| Default: base_url()."images/products/mouse1.jpg"
|
*/

$config['defaultArticleImage'] = base_url().$strDefaultImage;

/*
|--------------------------------------------------------------------------
| Path of images used by the css template
|--------------------------------------------------------------------------
| 
|
| Default: base_url().'images/';
|
*/

$config['templateImage'] = base_url().'images/';


/*
|--------------------------------------------------------------------------
| Global currency setting. 
|--------------------------------------------------------------------------
| 
|
| Default: 'CHF';
|
*/

$config['currency'] = $strCurrency;

/*
|--------------------------------------------------------------------------
| Path to the email Template
|--------------------------------------------------------------------------
| 
|
| Default: base_url().'images/';
|
*/

$config['emailTemplate'] = $_SERVER['DOCUMENT_ROOT'].$strEmailTemplate;

?>
