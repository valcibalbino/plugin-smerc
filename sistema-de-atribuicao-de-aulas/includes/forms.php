<?php
/**
 * Sistema de Atribuição de Aulas
 *
 * @package sistema-de-atribuicao-de-aulas\includes
 * @version 0.1.0
 */
 
// Segurança
defined( 'ABSPATH' ) || exit;

wp_enqueue_style( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' );
wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), '3.3.1', true );
wp_enqueue_script( 'popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', array(), '1.14.3', true );
wp_enqueue_script( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js', array('jquery', 'popper'), '4.1.3', true );


echo "Teste - integridade";
exit;


global $wpdb; // Obtém a instância do objeto $wpdb
$table_name = $wpdb->prefix . 'smerc_professores'; // Obtém o nome completo da tabela

$dados = array( 
    'id_escola' => 3,
    'matricula' => 100234556,
    'categoria' => 'Quadro 1',
    'nome' => 'ze'
);

$formato = array(
    '%d', // $id_escola
    '%d', // $matricula
    '%s', // $categoria
    '%s' // $nome
);

$resultado = $wpdb->insert("wp_smerc_professores",
 ["id_escola" => 3,
  "matricula" => 1034,
   "categoria" => "ooooooi"],
    ["%d", "%d", "%s"]);

if ($resultado === false) {
    // Ocorreu um erro ao inserir os dados
    echo "Ocorreu um erro ao inserir os dados.";
    echo "<br>".$table_name;
} else {
    // Os dados foram inseridos com sucesso
    echo "Dados inseridos com sucesso.";
}
 echo "<br>Registro: ".$wpdb->insert_id."<br>";
?>
<a href="http://191.252.133.116/~pi/wordpress/wp-admin/admin.php?page=pagina-lista">teste</a>