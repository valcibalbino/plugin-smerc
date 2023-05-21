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

	// Criação inicial de Tabelas /////////////

	// Tabela Classes
	$table_name = $wpdb->prefix."smerc_classes";
	$sql = "CREATE TABLE $table_name (
		ID BIGINT(20) NOT NULL AUTO_INCREMENT KEY,
		data TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
		id_usuario BIGINT(20) NOT NULL,
		id_escola BIGINT(20) NOT NULL,
		etapa VARCHAR(64) NOT NULL,
		classe VARCHAR(64) NOT NULL,
		turma VARCHAR(2),
		quantidade_aulas INT,
		periodo VARCHAR(32),
		horario VARCHAR(64),
		situacao VARCHAR(32),
		professor_livre VARCHAR(128),
		motivo_livre VARCHAR(32),
		professor_quadro1 VARCHAR(128),
		motivo_quadro1 VARCHAR(32),
		professor_quadro2 VARCHAR(128),
		motivo_quadro2 VARCHAR(32),
		professor_contratado VARCHAR(128),
		motivo_contratado VARCHAR(32),
		escola_sede VARCHAR(128),
		escola_constituicao VARCHAR(128),
		escola_ampliacao_jornada VARCHAR(128),
		escola_suplementar VARCHAR(128),
		dias_htpc VARCHAR(128),
		horarios_htpc VARCHAR(128),
		observacao TEXT,
		status VARCHAR(128),
		professor_atribuido VARCHAR(128),
		professor_sede VARCHAR(128),
		efetivo_jornada VARCHAR(128),
		efetivo_ampliacao VARCHAR(128),
		efetivo_suplementar VARCHAR(128),
		contratado_carga_horaria INT,
		contratado_ampliacao INT
	) $charset_collate;";	
	dbDelta( $sql );
	
	// Tabela Escola
	$table_name = $wpdb->prefix."smerc_escolas";
	$sql = "CREATE TABLE $table_name (
		ID BIGINT(20) NOT NULL AUTO_INCREMENT KEY,
		nome_escola VARCHAR(128) NOT NULL,
		id_usuario1 BIGINT(20) NOT NULL,
		id_usuario2 BIGINT(20) NULL,
		id_usuario3 BIGINT(20) NULL,
		id_usuario4 BIGINT(20) NULL
	) $charset_collate;";	
	dbDelta( $sql );
	
	// Tabela Professores
	$table_name = $wpdb->prefix."smerc_professores";
	$sql = "CREATE TABLE $table_name (
		id_user BIGINT(20) NOT NULL,
		id_escola BIGINT(20) NOT NULL,
		matricula BIGINT(20) NOT NULL KEY,
		categoria VARCHAR(64) NOT NULL,
		nome VARCHAR(128) NOT NULL,
		classificação INT NULL
	) $charset_collate;";	
	dbDelta( $sql );

	// Registrar Versão e Opções
    $option_name = 'smerc_versao';
    $option_value = '0.1.1';  // versão atual
    $current_value = get_option($option_name);

    if ( $current_value === false ) {
        // A opção 'smerc_versao' não existe, vamos adicioná-la.
        add_option( $option_name, $option_value );
    } else {
        // A opção 'smerc_versao' existe e vamos atualizá-la.
        update_option( $option_name, $option_value );
    }

}


// Desativação do Plugin
function smerc_deactivate_hook() {
	//
	//update_option('smerc_versao', '0.0.0');

}


// Desistalação do Plugin
function smerc_unistall_hook() {
    //global $wpdb;
    //$table_name = $wpdb->prefix . 'smerc_aulas';
    //$sql = "DROP TABLE IF EXISTS $table_name;";
    //$wpdb->query( $sql );
}


// redireciona para página 
function redirect_to_specific_page() {
    $redirect_to = admin_url('admin.php?page=smerc_classe_page');
    return $redirect_to;
}


///////////////////////////////////////////////////////////////////////////////
class SMERC_Classe {
	// Atributos privados

	public function setClasse() {
		// validar e gravar dados da classe no banco de dados
	}

	public function getClasse() {
		// Acessar dados 
	}
}

///////////////////////////////////////////////////////////////////////////////
class SMERC_Escola {
	// Atributos privados

	public function setEscola() {
		// Validar e gravar dados da escola no banco de dados
	}

	public function getEscola() {
		// Acessar dados
	}
}

///////////////////////////////////////////////////////////////////////////////
class SMERC_User {

	// Atributos privados

	public function setProfessor() {
		// validar e gravar dados do professor no banco de dados
	}

	public function getProfessor() {
		// Acessar dados
	}

	public function getEscola() {

	}
}

/*/////////////////////////////////////////////////////




/*//////////////////////////////////////////////////////////////////////////////


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