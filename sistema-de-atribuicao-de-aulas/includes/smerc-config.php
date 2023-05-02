<?php
	global $current_user; wp_get_current_user();
	session_start();
?>
	
	<div class="wrap">
        <h2>Configurações</h2>
        <p class="description"> Está é uma página de configurações do plugin SME</p>
        <p class="description">Usuário atual: <?php echo $current_user->display_name; ?></p>
		<p class="description"><?php echo plugin_dir_url(__FILE__); ?></p>
        <p class="description"><?php echo "<a href='../wp-admin/options-general.php?page=bld_config_page'>xxx</a>"; ?></p>
		<form action="../wp-admin/options-general.php?page=bld_config_page" method="post" id="bld-admin-form">
			<table>
			<tr>
				<td>Botão:</td> 
				<td> <input type="radio" id="classico" name="bld-botao" value="classico">
				<label for="classico">Clássico</label><br>
				<input type="radio" id="Imagem" name="bld-botao" value="Imagem">
				<label for="Imagem">Imagem</label></td>
			</tr>
			</table>
			<button type="submit" form="bld-admin-form" value="Submit">Atualizar configurações</button>
		</form>
    </div>