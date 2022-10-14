<?php
/*
Plugin Name: Apiki - Favoritar POST
Description: API Favorita de desfavoria post, esta api devera vi com dois parametros id do post e id do usuario, exemplo meudominio/wp-json/api/apiki/postfavorido/?postID=1&userID=5 version: 1.0
Author: TECH LEAD - Rogério Lopes
Author URI: https://www.linkedin.com/in/rogerio-tech-lead/
License: GPL2
*/
// inclui as rotinas do plugin
require_once plugin_dir_path(__FILE__) . '/includes/DB.php'; //Gera a tabela
require_once plugin_dir_path(__FILE__) . '/includes/API.php'; // api favoriza o post
//meudominio/wp-json/api/apiki/postfavorido/?postID=1&userID=5
DB::gera_tabela();
API::start();

?>