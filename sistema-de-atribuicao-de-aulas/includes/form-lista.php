<?php
session_start();

wp_enqueue_style( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' );
wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), '3.3.1', true );
wp_enqueue_script( 'popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', array(), '1.14.3', true );
wp_enqueue_script( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js', array('jquery', 'popper'), '4.1.3', true );

include( plugin_dir_path( __FILE__ ) . 'includes/functions.php'); //funções PHP

// Função para exibir a lista de usuários/classes
function exibir_lista_usuarios_classes() {
    if(isset( $_GET['pagina'] )){
        $pagina = $_GET['pagina'];
     } else {
        $pagina = 1;
     }

    //$pagina = 1; //filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
    $qnt_result_pg = 4; // filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT);
    // Calcular o início da visualização
    $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

    // Consultar no banco de dados
    $result_usuario = "SELECT *, DATE_FORMAT(data, '%d/%m/%Y - %H:%m') AS data_formatada, wp_smerc_classes.ID AS ID FROM wp_smerc_classes  INNER JOIN wp_smerc_escolas ON wp_smerc_classes.id_escola = wp_smerc_escolas.ID  ORDER BY wp_smerc_classes.ID DESC LIMIT $inicio, $qnt_result_pg";
    global $wpdb;
	$resultado_usuario = $wpdb->get_results($result_usuario);
   
    // Verificar se encontrou resultado na tabela "wp_smerc_classes"
    if ($resultado_usuario && count($resultado_usuario) > 0) {
        ?>
		<h2>Listar Classes</h2>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Professor</th>
                    <th>Classe</th>
                    <th>Situação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
				//echo '<script>alert("Qt de Linhas: '.count($resultado_usuario).'");</script>';
			
				
				$resultado_usuario = $wpdb->get_results($result_usuario);

				foreach ($resultado_usuario as $row_usuario) {
                    ?>
                    <?php echo '<tr class="table-'.cor($row_usuario->status).'">'; ?>
                        <td><?php echo $row_usuario->data_formatada; ?></td>
                        <td><?php echo $row_usuario->nome_professor_01; ?></td>
                        <td><?php echo $row_usuario->classe. " " . $row_usuario->turma. " - " . $row_usuario->periodo. "<br>" . $row_usuario->etapa; ?></td>
                        <td><?php echo $row_usuario->situacao. "<br>" . $row_usuario->quantidade_aulas. " aulas"; ?></td>
                        <td>
                            <?php
                            $url = add_query_arg( 'minha_variavel', $row_usuario->ID, admin_url( 'admin.php?page=pagina-aux' ) );
                            echo '<a href="' . esc_url( $url ) . '">';
                            ?>
                            <button type="button" class="btn btn-primary view_data" id="<?php echo $row_usuario->ID; ?>">Visualizar</button></a>
                            <!--button type="button" class="btn btn-outline-primary">Validar</button>
                            <button type="button" class="btn btn-outline-primary">Devolver</button>
                            <button type="button" class="btn btn-outline-primary">Publicar</button>
                            <button type="button" class="btn btn-outline-primary"  data-dismiss="modal">Atribuir</button!-->
                        </td>
                    </tr>
                    <?php
                } ?>
            </tbody>
        </table>
        <?php
        // Paginação - Somar a quantidade de usuários/classes
        $result_pg = "SELECT COUNT(*) AS num_result FROM wp_smerc_classes";

		global $wpdb;
		$resultado_pg = $wpdb->get_results($result_pg);
        $registros = $wpdb->get_var( "SELECT COUNT(*) FROM wp_smerc_classes" );
        $total_pg = ceil($registros / $qnt_result_pg);
    
        // Quantidade de páginas 
        echo '<nav aria-label="paginacao">';
        echo '<ul class="pagination">';
        echo '<li class="page-item">';
        $url = add_query_arg( 'pagina', 1, admin_url( 'admin.php?page=pagina-lista' ) );
        echo "<a href='" . esc_url( $url ) . "' class='page-link'>Primeira</a>";
        echo '</li>';
        
        if (($pagina-1) >= 1) {
            echo '<li class="page-item">';
            $url = add_query_arg( 'pagina', ($pagina-1), admin_url( 'admin.php?page=pagina-lista' ) );
            echo "<a href='" . esc_url( $url ) . "' class='page-link'>".($pagina-1)." </a></li>";
        }
        
        echo '<li class="page-item active">';
        $url = add_query_arg( 'pagina', $pagina, admin_url( 'admin.php?page=pagina-lista' ) );
        echo "<a href='" . esc_url( $url ) . "' class='page-link'>".($pagina)." </a></li>";
        
        if (($pagina+1) <= $total_pg) {
            $url = add_query_arg( 'pagina', ($pagina+1), admin_url( 'admin.php?page=pagina-lista' ) );
            echo "<li class='page-item'><a href='" . esc_url( $url ) . "' class='page-link'>".($pagina+1)." </a></li>";
        }
        
        echo '<li class="page-item">';
        $url = add_query_arg( 'pagina', $total_pg, admin_url( 'admin.php?page=pagina-lista' ) );
        echo "<a href='" . esc_url( $url ) . "' class='page-link'>Última</a>";
        echo '</li>';
        echo '</ul>';
        echo '</nav>';
} else {
    echo "<div class='alert alert-danger' role='alert'>Nenhum usuário encontrado!</div>";
}


}

exibir_lista_usuarios_classes();

$variavel = 3;
$url = add_query_arg( 'minha_variavel', $variavel, admin_url( 'admin.php?page=pagina-aux' ) );
echo '<a href="' . esc_url( $url ) . '">Ir para a página de destino</a>';

?>

<script>
			$(document).ready(function(){
                
                $(document).on('click','.view_data', function(){
					var user_id = $(this).attr("id");
					alert("ok33");
					//Verificar se há valor na variável "user_id".
					if(user_id !== ''){
						var dados = {
							user_id: user_id
						};
						$.post('http://191.252.133.116/~pi/wordpress/wp-admin/admin.php?page=pagina-aux', dados, function(retorna){
							//Carregar o conteúdo para o usuário
							$("#visul_usuario").html(retorna);
							$('#visulUsuarioModal').modal('show'); 
						});
					}
				});
			});
</script>