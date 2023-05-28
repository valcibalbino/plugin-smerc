<?php
global $wpdb;
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
$charset_collate = $wpdb->get_charset_collate();

$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
$qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT);
$inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

$result_usuario = "SELECT *, DATE_FORMAT(data, '%d/%m/%Y - %H:%m') AS data_formatada FROM wp_smerc_classes INNER JOIN wp_smerc_escolas ON wp_smerc_classes.id_escola = wp_smerc_escolas.ID ORDER BY wp_smerc_classes.ID DESC LIMIT $inicio, $qnt_result_pg";
$resultado_usuario = $wpdb->get_results($result_usuario);

if ($resultado_usuario && count($resultado_usuario) > 0) {
    ?>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>Data</th>
                <th>Escola</th>
                <th>Classe</th>
                <th>Situação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($resultado_usuario as $row_usuario) {
                ?>
                <tr>
                    <th><?php echo $row_usuario->data_formatada; ?></th>
                    <td><?php echo $row_usuario->nome_escola; ?></td>
                    <td><?php echo $row_usuario->classe . " " . $row_usuario->turma . " - " . $row_usuario->periodo . "<br>" . $row_usuario->etapa; ?></td>
                    <td><?php echo $row_usuario->situacao . "<br>" . $row_usuario->quantidade_aulas . " aulas"; ?></td>
                    <td>
                        <button type="button" class="btn btn-outline-primary view_data" id="<?php echo $row_usuario->ID; ?>">Visualizar</button>
                        <button type="button" class="btn btn-outline-primary view_data">Validar</button>
                        <button type="button" class="btn btn-outline-primary view_data">Devolver</button>
                        <button type="button" class="btn btn-outline-primary view_data">Publicar</button>
                        <button type="button" class="btn btn-outline-primary view_data">Atribuir</button>
                    </td>
                </tr>
                <?php
            } ?>
        </tbody>
    </table>
    <?php
    $result_pg = "SELECT COUNT(ID) AS num_result FROM wp_smerc_classes";
    $resultado_pg = $wpdb->get_results($result_pg);
    $row_pg = $resultado_pg[0];

    $quantidade_pg = ceil($row_pg->num_result / $qnt_result_pg);
    $max_links = 2;

    echo '<nav aria-label="paginacao">';
    echo '<ul class="pagination">';
    echo '<li class="page-item">';
    echo "<span class='page-link'><a href='#' onclick='listar_usuario(1, $qnt_result_pg)'>Primeira</a> </span>";
    echo '</li>';
    for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
		if($pag_dep <= $quantidade_pg){
			echo "<li class='page-item'><a class='page-link' href='#' onclick='listar_usuario($pag_dep, $qnt_result_pg)'>$pag_dep</a></li>";
		}
	}
	echo '<li class="page-item">';
	echo "<span class='page-link'><a href='#' onclick='listar_usuario($quantidade_pg, $qnt_result_pg)'>Última</a></span>";
	echo '</li>';
	echo '</ul>';
	echo '</nav>';

}else{
	echo "<div class='alert alert-danger' role='alert'>Nenhum usuário encontrado!</div>";
}
