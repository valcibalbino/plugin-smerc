<?php
/**
 * Sistema de Atribuição de Aulas
 *
 * @package sistema-de-atribuicao-de-aulas\includes
 * @version 0.1.0
 */
 
// Segurança
//defined( 'ABSPATH' ) || exit;

// Função para exibir o formulário
function exibir_formulario_aula() {
    // Verifica se o formulário foi enviado
    if ( isset( $_POST['submit'] ) ) {
        // Processa os dados do formulário aqui
        // Exibe a mensagem de confirmação ou erro apropriada
    }
    
    // Código HTML para o formulário
    ?>
    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        
        <label for="mensagem">Mensagem:</label>
        <textarea name="mensagem" id="mensagem" required></textarea>
        
        <input type="submit" name="submit" value="Enviar">
    </form>
    <?php
}

?>