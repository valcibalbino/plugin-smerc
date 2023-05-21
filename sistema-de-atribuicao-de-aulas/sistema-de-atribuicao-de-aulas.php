<?php
/*
 * Plugin Name:       Sistema de Atribuição de Aulas - SMERC
 * Plugin URI:        http://191.252.133.116/~pi/plugin
 * Description:       Sistema de Gestão de Atribuição de Aulas permite aos gestores receber e gerenciar informações relativas as demandas de aulas das escolas..
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            Equipe Projeto Integrador
 * Author URI:        http://191.252.133.116/~pi/autor
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        http://191.252.133.116/~pi/plugin
 * Text Domain:       smerc
 */
 
// Segurança
//date_default_timezone_set('America/Sao_Paulo');
defined('ABSPATH') || exit;

// Incluir funções
include( plugin_dir_path( __FILE__ ) . 'includes/functions.php'); //funções PHP
include( plugin_dir_path( __FILE__ ) . 'includes/forms.php'); //formulários PHP

// Registar Plugin para correr na ativação/desativação/desinstalação
register_activation_hook( __FILE__, 'smerc_compativel' ); // Verificar compatibilidade
register_activation_hook( __FILE__, 'smerc_activation_hook' ); // Criar Tabelas e Registros
add_action( 'deactivate_plugin', 'smerc_deactivate_hook' ); // Ação ao desativar plugin
register_uninstall_hook( __FILE__, 'smerc_unistall_hook' ); // Apagar Tabelas e Registros


////////////////////////////////////////////////
// Setup Menu
add_action('admin_menu', 'smerc_register_menus');
// Menu config plugin
function smerc_register_menus(){
    add_menu_page('Configuração', 'Configuração SMERC', 'manage_options', 'smerc_config_page', 'smerc_render_page');
    add_menu_page('Atribuição Aulas', 'Aula Atribuição', 'manage_options', 'smerc_aula_page', 'smerc_aula_page');
    add_menu_page('Atribuição Classes', 'Classe Atribuição', 'read', 'smerc_classe_page', 'smerc_classe_page');
}
function smerc_render_page(){
    include ( plugin_dir_path( __FILE__ ) . 'includes/smerc-config.php');
}
function smerc_aula_page(){
    include ( plugin_dir_path( __FILE__ ) . 'includes/form-aula.php');
}
function smerc_classe_page(){
    include ( plugin_dir_path( __FILE__ ) . 'includes/form-classe.php');
}


/////////////////////////////////////////////////
function exibir_formulario_classe(){
    include ( plugin_dir_path( __FILE__ ) . 'includes/form-classe.php');
}


// Adiciona um shortcode para exibir o formulário em uma página específica
add_shortcode( 'exibir_formulario_aula', 'exibir_formulario_aula' );
add_shortcode( 'exibir_formulario_classe', 'exibir_formulario_classe' );

//Redirecionar página do menu principal na abertura
add_filter('login_redirect', 'redirect_to_specific_page');




?>