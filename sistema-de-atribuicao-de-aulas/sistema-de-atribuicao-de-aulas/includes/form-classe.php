<?php
/**
 * Sistema de Atribuição de Classes
 *
 * @package sistema-de-atribuicao-de-aulas\includes
 * @version 0.1.0
 */
 
// Segurança
//defined( 'ABSPATH' ) || exit;

// Função para exibir o formulário
function exibir_formulario_classe2() {
    // Verifica se o formulário foi enviado
    if ( isset( $_POST['submit'] ) ) {
        // Processa os dados do formulário aqui
        // Exibe a mensagem de confirmação ou erro apropriada
    }
    
    // Código HTML para o formulário
    ?>
<script>
function nuvem(el) {
  var display = document.getElementById(el).style.display;
  if(display == "none")
    document.getElementById(el).style.display = 'block';
  else
    document.getElementById(el).style.display = 'none';
  }
</script>
<button onclick="nuvem('etapa')">Nuvem</button>
	
	
    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="id_escolar">id_escolar:</label>
        <input type="text" name="id_escolar" id="nome" required>

        <label for="id_usuario">Usuario:</label>
        <input type="text" name="id_usuario" id="nome" required>

        <label for="Educação Infantil">Educação infantil:</label>
        <input type="radio" name="etapa id="Educação_infantil required>

        <label for="Ensino Fundamental">Ensino Fundamental:</label>
        <input type="radio" name="etapa id="Ensino_Fundamental required>

        <label for="EJA I">EJA I:</label>
        <input type="radio" name="etapa id="EJA onclick="nuvem('etapa');" I required>
        <br>
		<div id="etapa">
        <label for="mensagem">Mensagem:</label>
        <textarea name="mensagem" id="mensagem" required></textarea>
        </div>
        <input type="submit" name="submit" value="Enviar">
    </form>
    <?php
}
exibir_formulario_classe2();
?>