<?php
	global $current_user; wp_get_current_user();
	session_start();
?>
	
	<!--div class="card"!-->
	<div class="postbox-container-1">
        <h2>Configurações</h2>
        <p class="description"> Está é uma página de configurações do plugin SME</p>
        <p class="description">Usuário atual: <?php echo $current_user->display_name; ?></p>
		<p class="description"><?php echo plugin_dir_url(__FILE__); ?></p>
        <form action="../wp-admin/options-general.php?page=bld_config_page" method="post" id="bld-admin-form">
			<table>
			<tr>
				<td class = "text-center">Status do Sistema:</td> 
				<td class = "text-center"> <input type="radio" id="classico" name="bld-botao" value="classico">
				<label for="classico">Ativado</label><br>
				<input type="radio" id="Imagem" name="bld-botao" value="Imagem">
				<label for="Imagem">Desativado</label></td>
			</tr>
			</table>
			<button type="submit" form="bld-admin-form" value="Submit">Atualizar configurações</button>
		</form>
    </div>

	<div class="card"style="float:left;">
        <h2>Escolas</h2>
        <p class="description"> Carregar com os nomes das escolas</p>
    <!-- Formulario para enviar arquivo .csv -->
    	<form method="POST" action="" enctype="multipart/form-data">
        	<label>Arquivo Planilha.csv: </label><br>
        	<input type="file" name="arquivo" id="arquivo" accept="text/csv"><br><br>
        	<input type="submit" value="Enviar">
    	</form>
	</div>

	<div style="width:30px; float:left;">&nbsp;</div>

	<div class="card" style="float:left;">
        <h2>Classificação dos Professores</h2>
        <p class="description"> Carregar com os nomes dos professores e classificação</p>
    <!-- Formulario para enviar arquivo .csv -->
    	<form method="POST" action="" enctype="multipart/form-data">
        	<label>Arquivo Planilha.csv: </label><br>
        	<input type="file" name="arquivo" id="arquivo" accept="text/csv"><br><br>
        	<input type="submit" value="Enviar">
    	</form>
	</div>