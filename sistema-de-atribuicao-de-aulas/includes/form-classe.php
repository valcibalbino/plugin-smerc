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
$_POST['userId'] = get_current_user_id();
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
				<li role="presentation" class="active"><a href="#dados_iniciais" aria-controls="dados_iniciais" role="tab" data-toggle="tab">Dados Iniciais</a></li>
				<li role="presentation"><a href="#dados_da_classe" aria-controls="dados_da_classe" role="tab" data-toggle="tab">Dados da Classe</a></li>
				<li role="presentation"><a href="#periodo_horario" aria-controls="periodo_horario" role="tab" data-toggle="tab">Período e Horário</a></li>
				<li role="presentation"><a href="#situacao_classe" aria-controls="situacao_classe" role="tab" data-toggle="tab">Situação da classe</a></li>
				<li role="presentation"><a href="#htpc" aria-controls="htpc" role="tab" data-toggle="tab">Dias e horários HTPC</a></li>
				<li role="presentation"><a href="#fim" aria-controls="fim" role="tab" data-toggle="tab"  Onclick="resumo();">Finalização</a></li>
			  </ul>

			  <!-- Tab panes -->
			  <div class="tab-content">

        <!-- Primeira Aba !-->
				<div role="tabpanel" class="tab-pane active" id="dados_iniciais">
					<div style="padding-top:20px;">
						<form id="atribuicao_classe" name="atribuicao_classe" class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                            <div class="row form-group">
                                <label class="col-sm-2 control-label">Nome do resposável pelo preenchimento:</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $_POST['userId']; ?>">
                                    <input readonly type="text" name='nome' class="form-control" id="nome"  value="<?php echo $_POST['aux']; ?>">
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-sm-2 control-label">Unidade de Ensino:</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="id_escolar" id="nome" required>
                                    <input readonly type="text" name='nome_unidade' class="form-control" id="nome_unidade" placeholder="Nome da Unidade de Ensino" value="">
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-sm-2 control-label">Etapa de Ensino:</label>
                                <div class="col-sm-10">
                                  <input type="radio" name="etapa" id="etapa1" value="Educação Infantil" Onclick="smercDiv(['eefi','eejai'],['einf'])">
                                  <label for="Educação Infantil">Educação infantil</label><br>
                                  <input type="radio" name="etapa" id="etapa2" value="Ensino Fundamental I" Onclick="smercDiv(['einf','eejai'],['eefi'])">
                                  <label for="Ensino Fundamental I">Ensino Fundamental I</label><br>
                                  <input type="radio" name="etapa" id="etapa3" value="EJA I" Onclick="smercDiv(['einf','eefi'],['eejai'])">
                                  <label for="EJA I">EJA I</label>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                <a href="#dados_da_classe" aria-controls="dados_da_classe" role="tab" data-toggle="tab"><button type="button" class="btn btn-primary">Próximo</button></a>
                                </div>
                            </div>
                        
					</div>
				</div>

        <!-- Segunda Aba !-->
				<div role="tabpanel" class="tab-pane" id="dados_da_classe">
					<div style="padding-top:20px;">
					

                            <div class="row form-group" id="einf">
                                <label class="col-sm-2 control-label">Educação Infantil:</label>
                                <div class="col-sm-10">
                                  <input type="radio" id="berçario-I" name="classeinfantil" value="Berçario I">
                                  <label for="berçario-I">Berçario I</label><br>
                                  <input type="radio" id="berçario-II" name="classeinfantil" value="Berçario II">
                                  <label for="berçario II">Berçario II</label><br>
                                  <input type="radio" id="Maternal-I" name="classeinfantil" value="Maternal I">
                                  <label for="Maternal-I">Maternal I</label><br> 
                                  <input type="radio" id="Maternal-II" name="classeinfantil" value="Maternal II">
                                  <label for="Maternal-II">Maternal II</label><br>
                                  <input type="radio" id="Infantil-I" name="classeinfantil" value="Infantil I">
                                  <label for="Infantil-I">Infantil I</label><br>
                                  <input type="radio" id="Infantil-II" name="classeinfantil" value="Infantil II">
                                  <label for="Infantil-II">Infantil II</label><br>
                                  <input type="radio" id="einfMultisseriada" name="classeinfantil" value="Multisseriada">
                                  <label for="Multisseriada">Multisseriada</label><br>
                                  <input type="radio" id="PEI-EI" name="classeinfantil" value="PEI-EI">
                                  <label for="PEI-EI">PEI-EI</label>
                                </div>
                            </div>

                            <div class="row form-group" id="eefi">
                                <label class="col-sm-2 control-label">Ensino Fundamental I:</label>
                                <div class="col-sm-10">
                                  <input type="radio" id="1º ano" name="classefundamental" value="1º Ano">
                                  <label for="1º ano">1º Ano</label><br>
                                  <input type="radio" id="2º ano" name="classefundamental" value="2º Ano">
                                  <label for="2º ano">2º Ano</label><br>
                                  <input type="radio" id="3º ano" name="classefundamental" value="3º Ano">
                                  <label for="3º ano">3º Ano</label><br>
                                  <input type="radio" id="4º ano" name="classefundamental" value="4º Ano">
                                  <label for="4º ano">4º Ano</label><br>
                                  <input type="radio" id="5º ano" name="classefundamental" value="5º Ano">
                                  <label for="5º ano">5º Ano</label><br>
                                  <input type="radio" id="efundMultisseriada" name="classe-fundamental" value="Multisseriada">
                                  <label for="Multisseriada">Multisseriada</label>
                                </div>
                            </div>

                            <div class="row form-group" id="eejai">
                                <label class="col-sm-2 control-label">EJA I:</label>
                                <div class="col-sm-10">
                                  <input type="radio" id="1º termo" name="classeeja" value="1º termo">
                                  <label for="1º termo">1º termo</label><br>
                                  <input type="radio" id="2º termo" name="classeeja" value="2º termo">
                                  <label for="2º termo">2º termo</label><br>
                                  <input type="radio" id="3º termo" name="classeeja" value="3º termo">
                                  <label for="3º termo">3º termo</label><br>
                                  <input type="radio" id="4º termo" name="classeeja" value="4º termo">
                                  <label for="4º termo">4º termo</label><br>
                                  <input type="radio" id="Multisseriada" name="classeeja" value="Multisseriada">
                                  <label for="Multisseriada">Multisseriada</label>
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-sm-2 control-label">Assinale a turma a ser atribuida:</label>
                                <div class="col-sm-10">
                                <select id="turma" name="turma" value=" ">
                                      <option value=" "></option>
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

                            <div class="row form-group">
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

                            <div class="row form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <a href="#dados_iniciais" aria-controls="home" role="tab" data-toggle="tab"><button type="button" class="btn btn-primary">Anterior</button></a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="#periodo_horario" aria-controls="periodo_horario" role="tab" data-toggle="tab"><button type="button" class="btn btn-primary">Próximo</button></a>
                                </div>
                            </div>
                        
					</div>
				</div>

        <!-- Terceira Aba !-->
				<div role="tabpanel" class="tab-pane" id="periodo_horario">
					<div style="padding-top:20px;">
					 

                            <div class="row form-group">
                                <label class="col-sm-2 control-label">Escolha o período das Aulas:</label>
                                <div class="col-sm-10">
                                  <input type="radio" id="manha" name="periodo" value="manhã" Onclick="smercDiv(['ptarde','pnoite'],['pmanha'])">
                                  <label for="manha">Manhã</label><br>
                                  <input type="radio" id="tarde" name="periodo" value="tarde" Onclick="smercDiv(['pmanha','pnoite'],['ptarde'])">
                                  <label for="tarde">Tarde</label><br>
                                  <input type="radio" id="noite" name="periodo" value="noite" Onclick="smercDiv(['ptarde','pmanha'],['pnoite'])">
                                  <label for="noite">Noite</label>
                                </div>
                            </div>

                            <div class="row form-group" id="pmanha">
                                <label class="col-sm-2 control-label">Selecione o horário da manhã:</label>
                                <div class="col-sm-10">
                                  <input type="radio" id="horario1" name="horariomanha" value="7h00-11h00">
                                  <label for="horario1">7h00 às 11h00</label><br>
                                  <input type="radio" id="horario2" name="horariomanha" value="7h00-11h30">
                                  <label for="horario2">7h00 às 11h30</label><br>
                                  <input type="radio" id="horario3" name="horariomanha" value="7h30-11h30">
                                  <label for="horario3">7h30 às 11h30</label><br>
                                  <input type="radio" id="horario4" name="horariomanha" value="7h30-12h00">
                                  <label for="horario4">7h30 às 12h00</label>
                                </div>
                            </div>

                            <div class="row form-group" id="ptarde">
                                <label class="col-sm-2 control-label">Selecione o horário da tarde:</label>
                                <div class="col-sm-10">
                                  <input type="radio" id="horario1" name="horariotarde" value="13h00-17h00">
                                  <label for="horario1">13h00 às 17h00</label><br>
                                  <input type="radio" id="horario2" name="horariotarde" value="13h00-17h30">
                                  <label for="horario2">13h00 às 17h30</label>
                                </div>
                            </div>

                            <div class="row form-group" id="pnoite">
                                <label class="col-sm-2 control-label">Selecione o horário da noite:</label>
                                <div class="col-sm-10">
                                  <input type="radio" id="horario1" name="horarionoite" value="19h00-21h40">
                                  <label for="horario1">19h00 às 21h40</label>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <a href="#dados_da_classe" aria-controls="dados_da_classe" role="tab" data-toggle="tab"><button type="button" class="btn btn-primary">Anterior</button></a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="#situacao_classe" aria-controls="situacao_classe" role="tab" data-toggle="tab"><button type="button" class="btn btn-primary">Próximo</button></a>
                                </div>
                            </div>
                        
					</div>
				</div>

        <!-- Quarta Aba !-->       
				<div role="tabpanel" class="tab-pane" id="situacao_classe">
					<div style="padding-top:20px;">
					 
                            <div class="row form-group">
                                <div class="col-md">
                                    <label class="col-md-2 control-label" for="situa">Assinale a situação da classe:</label>
                                </div>
                                
                                <div class="col-md-10">
                                    <select class="form-select" id="situa" name="situa" onchange="smercDiv(['substituição', 'livre'], [this.value])">
                                      <option value=""></option>
                                      <option value="livre">Livre</option>
                                      <option value="substituição">Substituição</option>
                                    </select>
                                </div>
                            </div>


                          <div  id="livre">
                            <div class="row form-group">
                                <div class="col-md">
                                  <label class="col-md-2 control-label" for="motivolivre">Livre - Escolha o motivo:</label>
                                </div>
                                <div class="col-md-10">
                                  <select class="form-select" id="motivolivre" name="motivolivre">
                                    <option value=""></option>
                                    <option value="aposentadoria">Aposentadoria</option>
                                    <option value="desistência">Desistência</option>
                                    <option value="exoneracao">Exoneração</option>
                                    <option value="outro">Outro</option>
                                  </select>
                                </div>
                            </div>
                            
                            <div class="row form-group">
                                <div class="col-md">
                                  <label  class="col-md-2 control-label">Nome do professor Titular da classe:</label>
                                </div>
                                <div class="col-md-10">
                                  <input type="text" class="form-control" id="professor-titular" name="professor-titular"  placeholder="Digite o nome do(a) professor(a)">
                                </div>
                            </div>
                          </div>


                          <div id="substituição">
                            <div class="row form-group"><hr>
                                <div class="col-md">
                                  <label  class="col-md-2 control-label">Nome do(a) professor(a) Quadro 1</label>
                                </div>
                                <div class="col-md-10">
                                  <input type="text" class="form-control" id="nome-quadro-1" name="nome-quadro-1" placeholder="Digite o nome do(a) professor(a) Quadro 1">
                                  </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md form-floating">
                                <label for="motivoq1">Motivo de afastamento do Quadro 1</label>
                                <select class="form-select" id="motivoq1" name="motivoq1" onchange="smercMotivo([this.value], 'div-motivo-quadro-1')">
                                    <option value=""></option>
                                    <option value="Função de Coordenador(a) Pedagógico">Função de Coordenador(a) Pedagógico</option>
                                    <option value="Função de Diretor(a) Substituto(a)">Função de Diretor(a) Substituto(a)</option>
                                    <option value="Função de Vice Diretor(a)">Função de Vice Diretor(a)</option>
                                    <option value="Função de Professor(a) Coordenador(a)">Função de Professor(a) Coordenador(a)</option>
                                    <option value="Licença saúde">Licença saúde</option>
                                    <option value="Licença gestante">Licença gestante</option>
                                    <option value="Licença sem vencimento">Licença sem vencimento</option>
                                    <option value="Licença prêmio">Licença prêmio</option>
                                    <option value="Férias">Férias</option>
                                    <option value="Outro">Outro</option>
                                </select>
                                <div id="div-motivo-quadro-1">
                                  <input type="text" class="form-control" id="motivo-quadro-1" name="motivo-quadro-1" placeholder="Digite o motivo do afastamento do(a) professor(a) Quadro 1">
                                </div>
                                <br>
                                Início: <input type="date" id="data-inicio-q1" name="data-inicio-q1"> - Término: <input type="date" id="data-fim-q1" name="data-fim-q1" onchange="document.querySelector('#indeterminado-q1').checked = false;"> &nbsp; &nbsp; &nbsp; <input type="checkbox" id="indeterminado-q1" name="indeterminado-q1" onchange="if(this.checked){document.querySelector('#data-fim-q1').value = '';}"> Término indeterminado
                                </div>
                            </div>

                            <div class="row form-group"><hr>
                                <label class="col-sm-2 control-label">Nome do(a) professor(a) Quadro 2</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="nome-quadro-2" name="nome-quadro-2" placeholder="Digite o nome do(a) professor(a) Quadro 2">
                                  </div>
                            </div>

                            <div class="row form-group">
                                <div class="form-floating">
                                <label for="motivoq2">Motivo de afastamento do Quadro 2</label>
                                <select class="form-select" id="motivoq2" name="motivoq2" onchange="smercMotivo([this.value], 'div-motivo-quadro-2')">
                                    <option value=""></option>
                                    <option value="Função de Coordenador(a) Pedagógico">Função de Coordenador(a) Pedagógico</option>
                                    <option value="Função de Diretor(a) Substituto(a)">Função de Diretor(a) Substituto(a)</option>
                                    <option value="Função de Vice Diretor(a)">Função de Vice Diretor(a)</option>
                                    <option value="Função de Professor(a) Coordenador(a)">Função de Professor(a) Coordenador(a)</option>
                                    <option value="Licença saúde">Licença saúde</option>
                                    <option value="Licença gestante">Licença gestante</option>
                                    <option value="Licença sem vencimento">Licença sem vencimento</option>
                                    <option value="Licença prêmio">Licença prêmio</option>
                                    <option value="Férias">Férias</option>
                                    <option value="Outro">Outro</option>
                                </select>
                                <div id="div-motivo-quadro-2">
                                  <input type="text" class="form-control" id="motivo-quadro-2" name="motivo-quadro-2"  placeholder="Digite o motivo do afastamento do(a) professor(a) Quadro 2">
                                </div>
                                <br>
                                Início: <input type="date" id="data-inicio-q2" name="data-inicio-q2"> - Término: <input type="date" id="data-fim-q2" name="data-fim-q2" onchange="document.querySelector('#indeterminado-q2').checked = false;"> &nbsp; &nbsp; &nbsp; <input type="checkbox" id="indeterminado-q2" name="indeterminado-q2" onchange="if(this.checked){document.querySelector('#data-fim-q2').value = '';}"> Término indeterminado
                                  </div>
                            </div>

                            <div class="row form-group"><hr>
                                <label class="col-sm-2 control-label">Nome do(a) professor(a) Contratado(a)</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="nome-contratado" name="nome-contratado" placeholder="Digite o nome do(a) professor(a) Contratado(a)">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="form-floating">
                                <label for="motivocontratado">Motivo de afastamento do(a) Contratado(a)</label>
                                <select class="form-select" id="motivocontratado" name="motivocontratado" onchange="smercMotivo([this.value], 'div-motivo-contratado')">
                                    <option value=""></option>
                                    <option value="Função de Coordenador(a) Pedagógico">Função de Coordenador(a) Pedagógico</option>
                                    <option value="Função de Diretor(a) Substituto(a)">Função de Diretor(a) Substituto(a)</option>
                                    <option value="Função de Vice Diretor(a)">Função de Vice Diretor(a)</option>
                                    <option value="Função de Professor(a) Coordenador(a)">Função de Professor(a) Coordenador(a)</option>
                                    <option value="Licença saúde">Licença saúde</option>
                                    <option value="Licença gestante">Licença gestante</option>
                                    <option value="Licença sem vencimento">Licença sem vencimento</option>
                                    <option value="Licença prêmio">Licença prêmio</option>
                                    <option value="Férias">Férias</option>
                                    <option value="Outro">Outro</option>
                                </select>
                                <div id="div-motivo-contratado">
                                  <input type="text" class="form-control" id="motivo-contratado" name="motivo-contratado" placeholder="Digite o motivo do afastamento do(a) professor(a) Contratado(a)">
                                </div>
                                <br>
                                Início: <input type="date" id="data-inicio-c" name="data-inicio-c"> - Término: <input type="date" id="data-fim-c" name="data-fim-c" onchange="document.querySelector('#indeterminado-c').checked = false;"> &nbsp; &nbsp; &nbsp; <input type="checkbox" id="indeterminado-c" name="indeterminado-c" onchange="if(this.checked){document.querySelector('#data-fim-c').value = '';}"> Término indeterminado
                                  </div>
                            </div>
							</div>
                            <div class="row form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <a href="#periodo_horario" aria-controls="periodo_horario" role="tab" data-toggle="tab" Onclick="resumo();"><button type="button" class="btn btn-primary">Anterior</button></a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="#htpc" aria-controls="htpc" role="tab" data-toggle="tab" Onclick="resumo();"><button type="button" class="btn btn-primary">Próximo</button></a>
                                </div>
                            </div>

                        
					</div>
				</div>

        <!-- Quinta Aba !-->
				<div role="tabpanel" class="tab-pane" id="htpc">
					<div style="padding-top:20px;">
					 
                            <div class="row form-group">
                                <div class="col-sm-10">
                                  <label for="dias_htpc">Selecione o dia da semana e horário de HTPC:</label><br>
                                  <select id="dia_htpc" name="dia_htpc">
                                    <option value="" selected></option>
                                    <option value="segunda-feira">segunda-feira</option>
                                    <option value="terça-feira">terça-feira</option>
                                    <option value="quarta-feira">quarta-feira</option>
                                    <option value="quinta-feira">quinta-feira</option>
                                    <option value="sexta-feira">sexta-feira</option>
                                  </select>
                                  Início <input type="time" id="hora01" name="hora01"  step="300" value="18:00"> e término <input type="time" id="hora02" name="hora02"  step="300" value="18:50"> &nbsp;&nbsp;&nbsp; <input type="checkbox" id="newh2" onchange="smercHTPC(this.checked, 'mais_htpc');"> Adicionar outro dia da semana &nbsp;&nbsp;&nbsp; <input type="checkbox" id="newh1" > Data em aberto (à definir)
                                </div>
                                </div>

                            <div id="mais_htpc">
                            <div class="row form-group">
                                <div class="col-sm-10">
                                  <br>
                                  <label for="dia_htpc2">Se houver, selecione o segundo dia da semana e horário de HTPC:</label><br>
                                  <select id="dia_htpc2" name="dia_htpc2">
                                    <option value="" selected></option>
                                    <option value="segunda-feira">segunda-feira</option>
                                    <option value="terça-feira">terça-feira</option>
                                    <option value="quarta-feira">quarta-feira</option>
                                    <option value="quinta-feira">quinta-feira</option>
                                    <option value="sexta-feira">sexta-feira</option>
                                  </select>
                                  Início <input type="time" id="hora03" name="hora03" value="18:00"> e término <input type="time" id="hora04" name="hora04" value="18:50"> &nbsp;&nbsp;&nbsp; <input type="checkbox" id="newh3" onchange="smercHTPC(this.checked, 'mais_htpc2');"> Adicionar outro dia da semana
                                </div>
                            </div>
                            </div>

                            <div id="mais_htpc2">
                            <div class="row form-group">
                                <div class="col-sm-10">
                                  <br>
                                  <label for="dia_htpc3">Se houver, selecione o terceiro dia da semana e horário de HTPC:</label><br>
                                  <select id="dia_htpc3" name="dia_htpc3">
                                    <option value="" selected></option>
                                    <option value="segunda-feira">segunda-feira</option>
                                    <option value="terça-feira">terça-feira</option>
                                    <option value="quarta-feira">quarta-feira</option>
                                    <option value="quinta-feira">quinta-feira</option>
                                    <option value="sexta-feira">sexta-feira</option>
                                  </select>
                                  Início <input type="time" id="hora05" name="hora05" value="18:00"> e término <input type="time" id="hora06" name="hora06" value="18:50">
                                </div>
                            </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <a href="#situacao_classe" aria-controls="situacao_classe" role="tab" data-toggle="tab" Onclick="resumo();"><button type="button" class="btn btn-primary">Anterior</button></a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="#fim" aria-controls="fim" role="tab" data-toggle="tab" Onclick="resumo();"><button type="button" class="btn btn-primary">Próximo</button></a>
                                </div>
                            </div>
					</div>
				</div>


        <!-- Sexta Aba !-->
				<div role="tabpanel" class="tab-pane" id="fim">
					<div style="padding-top:20px;">
          <label for="fim">Confira todas as informações:</label>
          <br>
          <div id="summary"></div>
          <div class="row">
          <br>
          <textarea id="observacao" name="observacao" rows="5" cols="33"  placeholder="Se necessário, acrescente mais informações aqui..."></textarea>
          <br><br>  
        </div>



                            <div class="row form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <a href="#htpc" aria-controls="htpc" role="tab" data-toggle="tab"><button type="button" class="btn btn-primary">Anterior</button></a>
                                    &nbsp;&nbsp;&nbsp;
                                    <button type="submit" class="btn btn-success">Enviar</button>
                                </div>
                            </div>
                        </form>
				  </div>
			  </div>

			</div>
		</div>






    <!-- Div necessária para manter integridade das funções -->
    <div id="oculto"></div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>




    <?php
}
exibir_formulario_classe2();

?>