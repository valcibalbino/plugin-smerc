<?php
/**
 * Sistema de Atribuição de Aulas
 *
 * @package sistema-de-atribuicao-de-aulas\includes
 * @version 0.1.0
 */
 
// Segurança
defined( 'ABSPATH' ) || exit;
 
// Segurança: Verificar compatibilidade da versão do wordpress
function smerc_compativel(){
    if(version_compare(get_bloginfo('version'), '5.4', '<')){
        wp_die(__('Você precisa atualizar o wordpress para utilizar o plugin Sistema de Atribuição de Aulas', 'sistema-de-atribuicao-de-aulas'));
    }
}
// Ativação do Plugin
function smerc_activation_hook() {
	global $wpdb;
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	$charset_collate = $wpdb->get_charset_collate();

	// Criação Tabelas
	$table_name = $wpdb->prefix."smerc_classes";
	
	$sql = "CREATE TABLE $table_name (
	ID bigint(20) NOT NULL AUTO_INCREMENT,
	data TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	id_usuario bigint(20) NOT NULL,
	id_escola bigint(20) NOT NULL,
	etapa varchar(50) NOT NULL,
	classe vchar(50) NOT NULL,
	turma vchar(2),
	quantidade_aulas int(11),
	periodo vchar(25),
	horario vchar(50),
	situação vchar(25),
	professor_livre vchar(100),
	motivo_livre vchar(25),
	professor_quadro1 vchar(100),
	motivo_quadro1 vchar(25),
	professor_quadro2 vchar(100),
	motivo_quadro2 vchar(25),
	professor_contratado vchar(100),
	motivo_contatado vchar(25),
	escola_sede
	escola_constituicao
	escola_ampliacao_jorn
	escola_suplementar
	dias_htpc
	horarios_htpc
	observacao text
	status
	professor_atribuido
	professor_sede
	efetivo_jornada
	efetivo_ampliacao
	efetivo_suplementar
	contratado_carga_horaria
	contratado_ampliacao
	PRIMARY KEY  (ID)
	) $charset_collate;";	

	dbDelta( $sql );	
		
	// Registrar Versão e Opções
	add_option( 'smerc_versao', '0.1.0' );
	//update_option('smerc_versao', '1.0.0');
	//add_option( 'smerc_btnnovo', 'imagem' ); // imagem ou classico

}

// Desativação do Plugin
function smerc_deactivate_hook() {
	update_option('smerc_versao', '1.0.0');
}

function smerc_unistall_hook() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'smerc_aulas';
    $sql = "DROP TABLE IF EXISTS $table_name;";
    $wpdb->query( $sql );
}

///////////////////////////////////////////////////////////////////////////////
// Adicionar uma função de usuário personalizada
$result = add_role ('supervisor', __ ('Supervisor'), array ());
// SUPERVISOR - Adicionar um papel de usuário personalizado
$result = add_role ('supervisor', __ ('Supervisor'), array ('read' => true, // habilitar este recurso de leitura
'edit_posts' => false, // Permitir usuário pode editar suas próprias postagens
'edit_pages' => false, // Permite ao usuário editar páginas
'edit_others_posts' => false, // Permite que o usuário edite outras postagens não apenas his own
'create_posts' => false, // Permite ao usuário criar novos artigos 
'manage_categories' => false, // Permite ao usuário gerenciar as categorias de artigos 
'publish_posts' => false, // Permite ao usuário postar, caso contrário, as postagens permanecem no modo rascunho 
'edit_themes' => false, // O usuário não pode editar um tema 
'install_plugins' => false, // O usuário não pode adicionar novos plug-ins 
'update_plugin' => false, // O usuário não pode atualizar os plug-ins 
'update_core' => false // o usuário não pode executar as atualizações do WordPress
));
// DIRETOR - Adicionar uma função de usuário personalizada
//$result = add_role ('diretor', __ ('Diretor'), array ());
// Adicionar um papel de usuário personalizado

$result = add_role ('diretor', __ ('Diretor'), array ('read' => true, // habilitar este recurso de leitura
'edit_posts' => false, // Permitir usuário pode editar suas próprias postagens
'edit_pages' => false, // Permite ao usuário editar páginas
'edit_others_posts' => false, // Permite que o usuário edite outras postagens não apenas his own
'create_posts' => false, // Permite ao usuário criar novos artigos 
'manage_categories' => false, // Permite ao usuário gerenciar as categorias de artigos 
'publish_posts' => false, // Permite ao usuário postar, caso contrário, as postagens permanecem no modo rascunho 
'edit_themes' => false, // O usuário não pode editar um tema 
'install_plugins' => false, // O usuário não pode adicionar novos plug-ins 
'update_plugin' => false, // O usuário não pode atualizar os plug-ins 
'update_core' => false, // o usuário não pode executar as atualizações do WordPress
'smerc_atribuicao' => true
));

// remove_role ('diretor', __ ('Diretor'), array ())


?>