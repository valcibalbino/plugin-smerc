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
//include( plugin_dir_path( __FILE__ ) . 'includes/forms.php'); //formulários PHP

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
    add_menu_page('Atribuição Classes', 'Classe Atribuição', 'read', 'smerc_classe_page', 'smerc_classe_page');
    add_menu_page('Lista Classes', 'Classe Lista', 'read', 'smerc_lista_page', 'smerc_lista_page');
    add_menu_page('Classes form', 'Classes form', 'read', 'smerc_form_page', 'smerc_form_page');
}
function smerc_render_page(){
    include ( plugin_dir_path( __FILE__ ) . 'includes/smerc-config.php');
}

function smerc_classe_page(){
    include ( plugin_dir_path( __FILE__ ) . 'includes/form-classe.php');
}
function smerc_lista_page(){
    include ( plugin_dir_path( __FILE__ ) . 'includes/form-lista.php');
}
function smerc_form_page(){
    include ( plugin_dir_path( __FILE__ ) . 'includes/forms.php');
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













// Função para adicionar as páginas ao painel
function adicionar_paginas_coloridas() {
    // Adicionar página com fundo azul
    add_menu_page(
        null, // Título da página
        'SMERC', // Texto do menu
        'read', // Capacidade necessária para visualizar o item de menu
        'pagina-classe', // Slug do menu
        null, // Função de callback para exibir o conteúdo da página
        'dashicons-admin-site', // Ícone do menu (opcional)
        2 // Posição do menu
    );

    add_submenu_page(
        'pagina-classe', // Slug do menu pai
        'Atribuir classe', // Título da página
        'Atribuir classe', // Texto do menu
        'read', // Capacidade necessária para visualizar o item de menu
        'pagina-classe', // Slug do menu
        'exibir_pagina_classe', // Função de callback para exibir o conteúdo da página
    );

    // Adicionar página com fundo amarelo
    add_submenu_page(
        'pagina-classe', // Slug do menu pai
        'Listar classes', // Título da página
        'Listar classes', // Texto do menu
        'read', // Capacidade necessária para visualizar o item de menu
        'pagina-lista', // Slug do menu
        'exibir_pagina_lista' // Função de callback para exibir o conteúdo da página
    );

    add_submenu_page(
        null, // Slug do menu pai (null para não exibir no menu)
        'Link Verde', // Título da página
        'Link Verde', // Texto do menu
        'read', // Capacidade necessária para visualizar o item de menu
        'pagina-aux', // Slug do menu
        'exibir_pagina_aux' // Função de callback para exibir o conteúdo da página
    );
}

// Função de callback para exibir o conteúdo da Atribuir Classe
function exibir_pagina_classe() {
    include_once(plugin_dir_path( __FILE__ ) . 'includes/form-classe.php');
}

// Função de callback para exibir o conteúdo da página amarela
function exibir_pagina_lista() {
    include_once(plugin_dir_path( __FILE__ ) . 'includes/form-lista.php');
}

// Função de callback para exibir o conteúdo da página amarela
function exibir_pagina_aux() {
    include_once(plugin_dir_path( __FILE__ ) . 'includes/visualizar.php');
}

// Ação para adicionar as páginas ao painel do WordPress
add_action('admin_menu', 'adicionar_paginas_coloridas');











?>