<?php
/**
 * Sistema de Atribuição de Classes
 *
 * @package sistema-de-atribuicao-de-aulas\includes
 * @version 0.1.0
 */
 
// Segurança
//defined( 'ABSPATH' ) || exit;

// Dados iniciais do usuário
$aux = wp_get_current_user();
$_POST['aux'] = $aux->get('user_firstname')." ".$aux->get('user_lastname');
//=$aux->id;


// Função para exibir o formulário
function exibir_formulario_classe2() {
  wp_enqueue_style( 'bootstrap.min.css', plugins_url( 'css/bootstrap.min.css' , __FILE__ ) );
  wp_enqueue_style( 'style.css', plugins_url( 'css/style.css' , __FILE__ ) );
  wp_enqueue_script( 'bootstrap.min.js', plugins_url( 'js/bootstrap.min.js' , __FILE__ ) );
  wp_enqueue_script( 'script.js', plugins_url( 'js/script.js' , __FILE__ ) );

    // Verifica se o formulário foi enviado
    if ( isset( $_POST['submit'] ) ) {
        // Processa os dados do formulário aqui
        // Exibe a mensagem de confirmação ou erro apropriada
    }
    
    // Código HTML para o formulário
    ?>


<div class="container theme-showcase" role="main" >
			<div class="page-header">
				<h1>Atribuir Classe</h1>
			</div>			
			<?php
				if($_SERVER['REQUEST_METHOD']=='POST'){
					$request = md5(implode($_POST));
					if(isset($_SESSION['ultima_request']) && $_SESSION['ultima_request'] == $request){
						echo "Usuário já foi inserido";
					}else{	
						$_SESSION['ultima_request'] = $request;
						$nome = $_POST['nome'];
						$cpf = $_POST['cpf'];
						$_SESSION['nome'] = $nome;
						$_SESSION['cpf'] = $cpf;						
						$result_dados_pessoais = "INSERT INTO usuarios (nome, cpf) VALUES ('$nome', '$cpf')";
						$resultado_dados_pessoais= mysqli_query($conn, $result_dados_pessoais);
						//ID do usuario inserido
						$ultimo_id = mysqli_insert_id($conn);	
						echo $ultimo_id;
					}
				}
			?>
			<div>

			  <!-- Nav tabs -->
			  <ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#dados_iniciais" aria-controls="home" role="tab" data-toggle="tab">Dados Iniciais</a></li>
				<li role="presentation"><a href="#dados_da_classe" aria-controls="dados_da_classe" role="tab" data-toggle="tab">Dados da Classe</a></li>
				<li role="presentation"><a href="#periodo_horario" aria-controls="periodo_horario" role="tab" data-toggle="tab">Período e Horário</a></li>
				<li role="presentation"><a href="#situacao_classe" aria-controls="situacao_classe" role="tab" data-toggle="tab">Situação da classe</a></li>
				<li role="presentation"><a href="#htpc" aria-controls="htpc" role="tab" data-toggle="tab">Dias e horários HTPC</a></li>
				<li role="presentation"><a href="#fim" aria-controls="fim" role="tab" data-toggle="tab">Finalização</a></li>
			  </ul>

			  <!-- Tab panes -->
			  <div class="tab-content">

        <!-- Primeira Aba !-->
				<div role="tabpanel" class="tab-pane active" id="dados_iniciais">
					<div style="padding-top:20px;">
						<form class="form-horizontal" action="" method="POST">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nome do responável pelo preenchimento:</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="id_usuario" id="id_usuario" required>
                                    <input type="text" name='nomex' class="form-control" id="nomex"  value="<?php echo $_POST['aux']; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Unidade de Ensino:</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="id_escolar" id="nome" required>
                                    <input type="text" name='nome_unidade' class="form-control" id="nome_unidade" placeholder="Nome da Unidade de Ensino" value="<?php // if(isset($_SESSION['cpf'])){ echo $_SESSION['cpf']; } ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Etapa de Ensino:</label>
                                <div class="col-sm-10">
                                  <input type="radio" name="etapa" id="Educação_infantil" required  Onclick="smercDiv(['eefi','eejai'],['einf'])">
                                  <label for="Educação Infantil">Educação infantil</label><br>
                                  <input type="radio" name="etapa" id="Ensino_Fundamental" required  Onclick="smercDiv(['einf','eejai'],['eefi'])">
                                  <label for="Ensino Fundamental I">Ensino Fundamental I</label><br>
                                  <input type="radio" name="etapa" id="EJA I" required  Onclick="smercDiv(['einf','eefi'],['eejai'])">
                                  <label for="EJA I">EJA I</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                <a href="#dados_da_classe" aria-controls="dados_da_classe" role="tab" data-toggle="tab"><button type="button" class="btn btn-success">Próximo</button></a>
                                </div>
                            </div>
                        </form>
					</div>
				</div>

        <!-- Segunda Aba !-->
				<div role="tabpanel" class="tab-pane" id="dados_da_classe">
					<div style="padding-top:20px;">
					 <form class="form-horizontal"  action="" method="POST">

                            <div class="form-group" id="einf">
                                <label class="col-sm-2 control-label">Educação Infantil:</label>
                                <div class="col-sm-10">
                                  <input type="radio" id="berçario-I" name="Educação Infantil" value="Berçario I">
                                  <label for="berçario-I">Berçario I</label><br>
                                  <input type="radio" id="berçario-II" name="Educação Infantil" value="Berçario II">
                                  <label for="berçario II">Berçario II</label><br>
                                  <input type="radio" id="Maternal-I" name="Educação Infantil" value="Maternal I">
                                  <label for="Maternal-I">Maternal I</label><br> 
                                  <input type="radio" id="Maternal-II" name="Educação Infantil" value="Maternal II">
                                  <label for="Maternal-II">Maternal II</label><br>
                                  <input type="radio" id="Infantil-I" name="Educação Infantil" value="Infantil I">
                                  <label for="Infantil-I">Infantil I</label><br>
                                  <input type="radio" id="Infantil-II" name="Educação Infantil" value="Infantil II">
                                  <label for="Infantil-II">Infantil II</label><br>
                                  <input type="radio" id="Multisseriada" name="Educação Infantil" value="Multisseriada">
                                  <label for="Multisseriada">Multisseriada</label><br>
                                  <input type="radio" id="PEI-EI" name="Educação Infantil" value="PEI-EI">
                                  <label for="PEI-EI">PEI-EI</label>
                                </div>
                            </div>

                            <div class="form-group" id="eefi">
                                <label class="col-sm-2 control-label">Ensino Fundamental I:</label>
                                <div class="col-sm-10">
                                  <input type="radio" id="1º ano" name="classe-ef" value="1º Ano">
                                  <label for="1º ano">1º Ano</label><br>
                                  <input type="radio" id="2º ano" name="classe-ef" value="2º Ano">
                                  <label for="2º ano">2º Ano</label><br>
                                  <input type="radio" id="3º ano" name="classe-ef" value="3º Ano">
                                  <label for="3º ano">3º Ano</label><br>
                                  <input type="radio" id="4º ano" name="classe-ef" value="4º Ano">
                                  <label for="4º ano">4º Ano</label><br>
                                  <input type="radio" id="5º ano" name="classe-ef" value="5º Ano">
                                  <label for="5º ano">5º Ano</label><br>
                                  <input type="radio" id="Multisseriada" name="classe-ef" value="Multisseriada">
                                  <label for="Multisseriada">Multisseriada</label>
                                </div>
                            </div>

                            <div class="form-group" id="eejai">
                                <label class="col-sm-2 control-label">EJA I:</label>
                                <div class="col-sm-10">
                                  <input type="radio" id="1º termo" name="classe-eja" value="1º termo">
                                  <label for="1º termo">1º termo</label><br>
                                  <input type="radio" id="2º termo" name="classe-eja" value="2º termo">
                                  <label for="2º termo">2º termo</label><br>
                                  <input type="radio" id="3º termo" name="classe-eja" value="3º termo">
                                  <label for="3º termo">3º termo</label><br>
                                  <input type="radio" id="4º termo" name="classe-eja" value="4º termo">
                                  <label for="4º termo">4º termo</label><br>
                                  <input type="radio" id="Multisseriada" name="classe-eja" value="Multisseriada">
                                  <label for="Multisseriada">Multisseriada</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Assinale a turma a ser atribuida:</label>
                                <div class="col-sm-10">
                                <select id="turma" name="turma">
                                      <option value=""></option>
                                      <option value="A">A</option>
                                      <option value="B">B</option>
                                      <option value="C">C</option>
                                      <option value="D">D</option>
                                      <option value="E">E</option>
                                      <option value="F">F</option>
                                      <option value="G">G</option>
                                      <option value="H">H</option>
                                      <option value="I">I</option>
                                      <option value="J">J</option>
                                    </select>
                                    </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Informe o total de aulas com alunos:</label>
                                <div class="col-sm-10">
                                  <input type="radio" id="quantidade15" name="quantidade" value="15">
                                  <label for="quantidade15">15</label><br>
                                  <input type="radio" id="quantidade18" name="quantidade" value="18">
                                  <label for="quantidade18">18</label><br>
                                  <input type="radio" id="quantidade20" name="quantidade" value="20">
                                  <label for="quantidade20">20</label><br>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <a href="#dados_iniciais" aria-controls="home" role="tab" data-toggle="tab"><button type="button" class="btn btn-success">Anterior</button></a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="#periodo_horario" aria-controls="periodo_horario" role="tab" data-toggle="tab"><button type="button" class="btn btn-success">Próximo</button></a>
                                </div>
                            </div>
                        </form>
					</div>
				</div>

        <!-- Terceira Aba !-->
				<div role="tabpanel" class="tab-pane" id="periodo_horario">
					<div style="padding-top:20px;">
					 <form class="form-horizontal"  action="" method="POST">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Escolha o período das Aulas:</label>
                                <div class="col-sm-10">
                                  <input type="radio" id="manha" name="periodo" value="manha" Onclick="smercDiv(['ptarde','pnoite'],['pmanha'])">
                                  <label for="manha">Manhã</label><br>
                                  <input type="radio" id="tarde" name="periodo" value="tarde" Onclick="smercDiv(['pmanha','pnoite'],['ptarde'])">
                                  <label for="tarde">Tarde</label><br>
                                  <input type="radio" id="noite" name="periodo" value="noite" Onclick="smercDiv(['ptarde','pmanha'],['pnoite'])">
                                  <label for="noite">Noite</label>
                                </div>
                            </div>

                            <div class="form-group" id="pmanha">
                                <label class="col-sm-2 control-label">Selecione o horário da manhã:</label>
                                <div class="col-sm-10">
                                  <input type="radio" id="horario1" name="horario" value="7h00-11h00">
                                  <label for="horario1">7h00 às 11h00</label><br>
                                  <input type="radio" id="horario2" name="horario" value="7h00-11h30">
                                  <label for="horario2">7h00 às 11h30</label><br>
                                  <input type="radio" id="horario3" name="horario" value="7h30-11h30">
                                  <label for="horario3">7h30 às 11h30</label><br>
                                  <input type="radio" id="horario4" name="horario" value="7h30-12h00">
                                  <label for="horario4">7h30 às 12h00</label>
                                </div>
                            </div>

                            <div class="form-group" id="ptarde">
                                <label class="col-sm-2 control-label">Selecione o horário da tarde:</label>
                                <div class="col-sm-10">
                                  <input type="radio" id="horario1" name="horariotarde" value="13h00-17h00">
                                  <label for="horario1">13h00 às 17h00</label><br>
                                  <input type="radio" id="horario2" name="horariotarde" value="13h00-17h30">
                                  <label for="horario2">13h00 às 17h30</label>
                                </div>
                            </div>

                            <div class="form-group" id="pnoite">
                                <label class="col-sm-2 control-label">Selecione o horário da noite:</label>
                                <div class="col-sm-10">
                                  <input type="radio" id="horario1" name="horarionoite" value="19h00-21h40">
                                  <label for="horario1">19h00 às 21h40</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <a href="#dados_da_classe" aria-controls="dados_da_classe" role="tab" data-toggle="tab"><button type="button" class="btn btn-success">Anterior</button></a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="#situacao_classe" aria-controls="situacao_classe" role="tab" data-toggle="tab"><button type="button" class="btn btn-success">Próximo</button></a>
                                </div>
                            </div>
                        </form>
					</div>
				</div>

        <!-- Quarta Aba !-->       
				<div role="tabpanel" class="tab-pane" id="situacao_classe">
					<div style="padding-top:20px;">
					 <form class="form-horizontal"  action="" method="POST">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Assinale a situação da classe:</label>
                                <div class="col-sm-10">
                                    <select id="situação" name="situação" onchange="smercDiv(['substituição', 'livre'], [this.value])">
                                      <option value=""></option>
                                      <option value="livre">Livre</option>
                                      <option value="substituição">Substituição</option>
                                    </select>
                                </div>
                            </div>

                            <div  id="livre">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Livre - Escolha o motivo:</label>
                                <div class="col-sm-10">
                                  <select id="motivo" name="motivo">
                                    <option value=""></option>
                                    <option value="aposentadoria">Aposentadoria</option>
                                    <option value="exoneracao">Exoneração</option>
                                    <option value="outro">Outro</option>
                                  </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Livre - Nome do professor Titular da classe:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="professor-titular" name="professor-titular">
                                </div>
                            </div>
                            </div>

                            <div id="substituição">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nome do(a) professor(a) Quadro 1</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="nome-quadro-1" name="nome-quadro-1">
                                  </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Motivo de afastamento do Quadro 1</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="motivo-quadro-1" name="motivo-quadro-1">
                                  </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nome do(a) professor(a) Quadro 2</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="nome-quadro-2" name="nome-quadro-2">
                                  </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Motivo de afastamento do Quadro 2</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="motivo-quadro-1" name="motivo-quadro-1">
                                  </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nome do(a) professor(a) Contratado(a)</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="nome-contratado" name="nome-contratado">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Motivo de afastamento do Contratado(a)</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="motivo-contratado" name="motivo-contratado">
                                  </div>
                            </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <a href="#periodo_horario" aria-controls="periodo_horario" role="tab" data-toggle="tab"><button type="button" class="btn btn-success">Anterior</button></a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="#htpc" aria-controls="htpc" role="tab" data-toggle="tab"><button type="button" class="btn btn-success">Próximo</button></a>
                                </div>
                            </div>
                        </form>
					</div>
				</div>

        <!-- Quinta Aba !-->
				<div role="tabpanel" class="tab-pane" id="htpc">
					<div style="padding-top:20px;">
					 <form class="form-horizontal"  action="" method="POST">
                            <div class="form-group">
                                <div class="col-sm-10">
                                  <label for="dias_htpc">Selecione o dia da semana e horário de HTPC:</label><br>
                                  <select name="select">
                                    <option value="valor0" selected></option>
                                    <option value="segunda-feira">segunda-feira</option>
                                    <option value="terça-feira">terça-feira</option>
                                    <option value="quarta-feira">quarta-feira</option>
                                    <option value="quinta-feira">quinta-feira</option>
                                    <option value="sexta-feira">sexta-feira</option>
                                  </select>
                                  Início <input type="time" name="hora01" value="18:00"> e términio <input type="time" name="hora02" value="18:50">
                                </div>
                                <div class="col-sm-10">
                                  <br>
                                  <label for="dias_htpc">Se houver, selecione o segundo dia da semana e horário de HTPC:</label><br>
                                  <select name="select">
                                    <option value="valor0" selected></option>
                                    <option value="segunda-feira">segunda-feira</option>
                                    <option value="terça-feira">terça-feira</option>
                                    <option value="quarta-feira">quarta-feira</option>
                                    <option value="quinta-feira">quinta-feira</option>
                                    <option value="sexta-feira">sexta-feira</option>
                                  </select>
                                  Início <input type="time" name="hora01" value="18:00"> e términio <input type="time" name="hora02" value="18:50">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <a href="#situacao_classe" aria-controls="situacao_classe" role="tab" data-toggle="tab"><button type="button" class="btn btn-success">Anterior</button></a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="#fim" aria-controls="fim" role="tab" data-toggle="tab"><button type="button" class="btn btn-success">Próximo</button></a>
                                </div>
                            </div>
                        </form>
					</div>
				</div>


        <!-- Primeira Aba !-->
				<div role="tabpanel" class="tab-pane" id="fim">
					<div style="padding-top:20px;">
          <label for="fim">Confira todas as informações:</label>


                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <a href="#htpc" aria-controls="htpc" role="tab" data-toggle="tab"><button type="button" class="btn btn-success">Enviar</button></a>
                                </div>
                            </div>
				  </div>
			  </div>

			</div>
		</div>








		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>




    <?php
}
exibir_formulario_classe2();
?>