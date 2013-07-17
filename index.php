<?php
/***************************************************************************
 *                              MediaTeq CMS                               *
 *                          -----------------------                        *
 *   Copyright            : (C) 2013 The MediaTeq Team                     *
 *   Email                : info@mediaTeq.ir                               *
 *   Programmers          : Saeid Hatami  &  Mojtaba Amjadi                *
 *   Start Date           : 1392-02-20 ,Friday,2013-05-10                  * 
 ***************************************************************************/
	include_once("config.php");
    include_once("classes/database.php"); 
	include_once("classes/functions.php");
	error_reporting (E_ALL ^ E_NOTICE);	
	$theme = GetSettingValue('Site_Theme_Name',0);    
	include_once("./themes/{$theme}/main.php");	
?>