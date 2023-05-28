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
  wp_enqueue_style( 'bootstrap.min.css', plugins_url( 'css/bootstrap.min.css' , __FILE__ ) );
  wp_enqueue_script( 'bootstrap.min.js', plugins_url( 'js/bootstrap.min.js' , __FILE__ ) );
  wp_enqueue_script( 'script.js', plugins_url( 'js/script.js' , __FILE__ ) );
  wp_enqueue_style( 'style.css', plugins_url( 'css/style.css' , __FILE__ ) , array(), '1.0.0', 'all', 99 );

  // Dados iniciais do usuário
  $aux = wp_get_current_user();
  $nome = $aux->get('user_firstname')." ".$aux->get('user_lastname');
  $id_usuario = get_current_user_id();
  $sql = "SELECT * FROM wp_smerc_escolas WHERE id_usuario1 = $id_usuario OR id_usuario2 = $id_usuario OR id_usuario3 = $id_usuario OR id_usuario4 = $id_usuario LIMIT 1";
  global $wpdb;
  $resultado_sql = $wpdb->get_results($sql);
  $nome_unidade = $resultado_sql[0]->nome_escola; 
  $id_escola = $resultado_sql[0]->ID;

    // Verifica se o formulário foi enviado
    if (isset($_POST['nome'])) {
      // Obtém os valores dos campos
      $postado = true;
      $nome = $_POST['nome'];
      $id_usuario = $_POST['id_usuario'];
      $id_escola = $_POST['id_escola'];
      $nome_unidade = $_POST['nome_unidade'];
      $etapa = $_POST['etapa'];

      // recebe classe do FORM
      if ($etapa == "Educação Infantil") {
        $xclasse = $_POST['classeinfantil'];
      } elseif ($etapa == "Ensino Fundamental I") {
        $xclasse = $_POST['classefundamental'];
      } else {
        $xclasse = $_POST['classeeja'];
      }

      $turma = $_POST['turma'];
      $quantidade = $_POST['quantidade'];

      $periodo = $_POST['periodo'];
      $horariomanha = $_POST['horariomanha'];
      $horariotarde = $_POST['horariotarde'];
      $horarionoite = $_POST['horarionoite'];

      // Horário
      if ($periodo == "manhã") {
        $horario = $horariomanha;
      } elseif ($periodo == "tarde") {
        $horario = $horariotarde;
      } else {
        $horario = $horarionoite;
      }

      $situa = $_POST['situa'];

      // recebe dados do Primeiro professor Livre/Substituição
      if($situa == "Livre") {
        // Professor 1 Livre
        $nome_professor_01 = $_POST['nome_professor_livre'];
        $motivo_01 = $_POST['motivo_livre'];
      } else {
        // Professor 1 Substituição
        $nome_professor_01 = $_POST['nome_professor_01'];
        $motivo_01 = $_POST['motivo_01'];
        // mais dados professor 1
        $professor_01 = $_POST['professor_01'];
        $detalhe_motivo_01 = $_POST['detalhe_motivo_01'];
        $data_inicio_01 = $_POST['data_inicio_01'];
        $data_final_01 = $_POST['data_final_01'];
      }

      // Professor 2 Substituição
      if (strlen($_POST['nome_professor_02']) > 3) {
        $professor_02 = $_POST['professor_02'];
        $nome_professor_02 = $_POST['nome_professor_02'];
        $motivo_02 = $_POST['motivo_02'];
        $detalhe_motivo_02 = $_POST['detalhe_motivo_02'];
        $data_inicio_02 = $_POST['data_inicio_02'];
        $data_final_02 = $_POST['data_final_02'];
      } else {
        $professor_02 = "";
        $nome_professor_02 = "";
        $motivo_02 = "";
        $detalhe_motivo_02 = "";
        $data_inicio_02 = "";
        $data_final_02 = "";
      }

      // Professor 3 Substituição
      if (strlen($_POST['nome_professor_03']) > 3) {
        $professor_03 = $_POST['professor_03'];
        $nome_professor_03 = $_POST['nome_professor_03'];
        $motivo_03 = $_POST['motivo_03'];
        $detalhe_motivo_03 = $_POST['detalhe_motivo_03'];
        $data_inicio_03 = $_POST['data_inicio_03'];
        $data_final_03 = $_POST['data_final_03'];
      } else {
        $professor_03 = "";
        $nome_professor_03 = "";
        $motivo_03 = "";
        $detalhe_motivo_03 = "";
        $data_inicio_03 = "";
        $data_final_03 = "";
      }

      // Professor 4 Substituição
      if (strlen($_POST['nome_professor_04']) > 3) {
        $professor_04 = $_POST['professor_04'];
        $nome_professor_04 = $_POST['nome_professor_04'];
        $motivo_04 = $_POST['motivo_04'];
        $detalhe_motivo_04 = $_POST['detalhe_motivo_04'];
        $data_inicio_04 = $_POST['data_inicio_04'];
        $data_final_04 = $_POST['data_final_04'];
      } else {
        $professor_04 = "";
        $nome_professor_04 = "";
        $motivo_04 = "";
        $detalhe_motivo_04 = "";
        $data_inicio_04 = "";
        $data_final_04 = "";
      }

      // Professor 4 Substituição
      if (strlen($_POST['nome_professor_05']) > 3) {
        $professor_05 = $_POST['professor_05'];
        $nome_professor_05 = $_POST['nome_professor_05'];
        $motivo_05 = $_POST['motivo_05'];
        $detalhe_motivo_05 = $_POST['detalhe_motivo_05'];
        $data_inicio_05 = $_POST['data_inicio_05'];
        $data_final_05 = $_POST['data_final_05'];
      } else {
        $professor_05 = "";
        $nome_professor_05 = "";
        $motivo_05 = "";
        $detalhe_motivo_05 = "";
        $data_inicio_05 = "";
        $data_final_05 = "";
      }

      $dia_htpc = $_POST['dia_htpc'];
      $hora01 = $_POST['hora01'];
      $hora02 = $_POST['hora02'];
      $dia_htpc2 = $_POST['dia_htpc2'];
      $hora03 = $_POST['hora03'];
      $hora04 = $_POST['hora04'];
      $dia_htpc3 = $_POST['dia_htpc3'];
      $hora05 = $_POST['hora05'];
      $hora06 = $_POST['hora06'];

      $observacao = $_POST['observacao'];

// Gravar dados
$dados = array(
  "id_usuario" => $id_usuario, // recebe do usuário logado
  "id_escola" => $id_escola, // recebe do usuário logado
  "etapa" => $etapa, // variaveis abaixo recebe do formulário
  "classe" => $xclasse,
  "turma" => $turma,
  "quantidade_aulas" => $quantidade,
  "periodo" => $periodo,
  "horario" => $horario,
  "situacao" => $situa,
  "nome_professor_01" => $nome_professor_01,
  "professor_01" => $professor_01,
  "motivo_01" => $motivo_01,
  "detalhe_motivo_01" => $detalhe_motivo_01,
  "data_inicio_01" => $data_inicio_01,
  "data_final_01" => $data_final_01,

  
  "data_final_01" => $dia_htpc,
  "data_final_01" => $hora01,
  "data_final_01" => $hora02,
  "data_final_01" => $dia_htpc2,
  "data_final_01" => $hora03,
  "data_final_01" => $hora04,
  "data_final_01" => $dia_htpc3,
  "data_final_01" => $hora05,
  "data_final_01" => $hora06,
  "status" => "atribuído",
  "data_final_01" => $observacao
);


$formato = array(
  "%d", // $id_usuario
  "%d", // $id_escola
  "%s", // $etapa
  "%s", // $xclasse
  "%s", // $turma
  "%d", // $quantidade
  "%s", // $periodo
  "%s", // $horario
  "%s", // $situa
  "%s", // $nome_professor_01
  "%s", // $professor_01
  "%s", // $motivo_01
  "%s", // $detalhe_motivo_01
  "%s", // $data_inicio_01
  "%s", // $data_final_01
  "%s", // $dia_htpc
  "%s", // $hora01
  "%s", // $hora02
  "%s", // $dia_htpc2
  "%s", // $hora03
  "%s", // $hora04
  "%s", // $dia_htpc3
  "%s", // $hora05
  "%s", // $hora06
  "%s", // status atribuído
  "%s" // $observacao
);


      $aux = smerc_set_classe($dados, $formato);

      if($aux){
        echo '<script>window.location.href = "'.admin_url( 'admin.php?page=pagina-lista' ).'";</script>';
        exit;
      } else {
        echo "ERRO AO GRAVAR<br>".var_dump($dados);;
      }

      // Redirecionar para uma página do menu de controle
      
    } else {
      $postado = false;
    }








    // Código HTML para o formulário  
    
    ?>

<div class="container theme-showcase" role="main" >
			<div class="page-header">
				<h1>Atribuir Classe</h1>
			</div>			

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
                                    <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $id_usuario; ?>">
                                    <input readonly type="text" name='nome' class="form-control" id="nome"  value="<?php echo $nome; ?>">
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-sm-2 control-label">Unidade de Ensino:</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="id_escola" id="id_escola" value="<?php echo $id_escola; ?>">
                                    <input readonly type="text" name='nome_unidade' class="form-control" id="nome_unidade" placeholder="Nome da Unidade de Ensino" value="<?php echo $nome_unidade; ?>">
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
                                  <input type="radio" id="efundMultisseriada" name="classefundamental" value="Multisseriada">
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
                                  <input type="radio" id="horario1" name="horarionoite" value="19h00-21h40" checked>
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
                                    <select class="form-select" id="situa" name="situa" onchange="smercDiv(['Substituição', 'Livre'], [this.value])">
                                      <option value=""></option>
                                      <option value="Livre">Livre</option>
                                      <option value="Substituição">Substituição</option>
                                    </select>
                                </div>
                            </div>


                        <div  id="Livre">
                            <div class="row form-group">
                                <div class="col-md">
                                  <label class="col-md-2 control-label" for="motivo_livre">Livre - Escolha o motivo:</label>
                                </div>
                                <div class="col-md-10">
                                  <select class="form-select" id="motivo_livre" name="motivo_livre">
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
                                  <input type="text" class="form-control" id="nome_professor_livre" name="nome_professor_livre"  placeholder="Digite o nome do(a) professor(a)">
                                </div>
                            </div>
                        </div>


                        <div id="Substituição">
                            <div class="row form-group"><hr>
                                <div class="col-md">
                                  <label   class="col-md-2 control-label">Nome do(a) professor(a)</label>
                                </div>
                                <div class="col-md-10">
                                  <input type="text" class="form-control" id="nome_professor_01" name="nome_professor_01" placeholder="Digite o nome do(a) professor(a)">
                                  </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md">
                                <label for="professor_01"  class="col-md-2 control-label">Categoria do(a) professor(a)</label>
                                </div><div class="col-md-10">
                                <select  class="form-select" id="professor_01" name="professor_01">
                                    <option value=""></option>
                                    <option value="Quadro 1">Quadro 1</option>
                                    <option value="Quadro 2">Quadro 2</option>
                                    <option value="Contratado(a)">Contratado(a)</option>
                                </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md form-floating">
                                <label for="motivo_01"  class="col-md-2 control-label">Motivo de afastamento do(a) professor(a)</label>
                                </div><div class="col-md-10">
                                <select class="form-select" id="motivo_01" name="motivo_01" onchange="smercMotivo([this.value], 'div_motivo_01')">
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
                                <div id="div_motivo_01">
                                  <input type="text" class="form-control" id="detalhe_motivo_01" name="detalhe_motivo_01" placeholder="Digite o motivo do afastamento do(a) professor(a)">
                                </div>
                                <br>
                                Início: <input type="date" placeholder="dd-mm-yyyy" value="" id="data_inicio_01" name="data_inicio_01"> - Término: <input type="date" id="data_final_01" name="data_final_01" onchange="document.querySelector('#indeterminado_01').checked = false;" placeholder="dd-mm-yyyy"> &nbsp; &nbsp; &nbsp; <input type="checkbox" id="indeterminado_01" name="indeterminado_01" onchange="if(this.checked){document.querySelector('#data_final_01').value = '';}"> Término indeterminado
                                &nbsp; &nbsp; &nbsp; <button type="button" class="btn btn-info" onclick="smercDiv(['oculto'], ['div_prof_02'])">+ Adicionar</button>
                                </div>
                            </div>







                          <div id="div_prof_02">
                            <div class="row form-group"><hr>
                                <div class="col-md">
                                  <label   class="col-md-2 control-label">Nome do(a) professor(a)</label>
                                </div>
                                <div class="col-md-10">
                                  <input type="text" class="form-control" id="nome_professor_02" name="nome_professor_02" placeholder="Digite o nome do(a) professor(a)">
                                  </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md">
                                <label for="professor_02"  class="col-md-2 control-label">Categoria do(a) professor(a)</label>
                                </div><div class="col-md-10">
                                <select  class="form-select" id="professor_02" name="professor_02">
                                    <option value=""></option>
                                    <option value="Quadro 1">Quadro 1</option>
                                    <option value="Quadro 2">Quadro 2</option>
                                    <option value="Contratado(a)">Contratado(a)</option>
                                </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md form-floating">
                                <label for="motivo_02"  class="col-md-2 control-label">Motivo de afastamento do(a) professor(a)</label>
                                </div><div class="col-md-10">
                                <select class="form-select" id="motivo_02" name="motivo_02" onchange="smercMotivo([this.value], 'div_motivo_02')">
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
                                <div id="div_motivo_02">
                                  <input type="text" class="form-control" id="detalhe_motivo_02" name="detalhe_motivo_02" placeholder="Digite o motivo do afastamento do(a) professor(a)">
                                </div>
                                <br>
                                Início: <input type="date" placeholder="dd-mm-yyyy" value="" id="data_inicio_02" name="data_inicio_02"> - Término: <input type="date" id="data_final_02" name="data_final_02" onchange="document.querySelector('#indeterminado_02').checked = false;" placeholder="dd-mm-yyyy"> &nbsp; &nbsp; &nbsp; <input type="checkbox" id="indeterminado_02" name="indeterminado_02" onchange="if(this.checked){document.querySelector('#data_final_02').value = '';}"> Término indeterminado
                                &nbsp; &nbsp; &nbsp; <button type="button" class="btn btn-info" onclick="smercDiv(['oculto'], ['div_prof_03'])">+ Adicionar</button>
                                &nbsp; &nbsp; &nbsp; <button type="button" class="btn btn-danger" onclick="smercDiv(['div_prof_02'], ['oculto']); document.getElementById('nome_professor_02').value='';">- Remover</button>
                                </div>
                            </div>
                          </div>
                          




                          <div id="div_prof_03">
                            <div class="row form-group"><hr>
                                <div class="col-md">
                                  <label   class="col-md-2 control-label">Nome do(a) professor(a)</label>
                                </div>
                                <div class="col-md-10">
                                  <input type="text" class="form-control" id="nome_professor_03" name="nome_professor_03" placeholder="Digite o nome do(a) professor(a)">
                                  </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md">
                                <label for="professor_03"  class="col-md-2 control-label">Categoria do(a) professor(a)</label>
                                </div><div class="col-md-10">
                                <select  class="form-select" id="professor_03" name="professor_03">
                                    <option value=""></option>
                                    <option value="Quadro 1">Quadro 1</option>
                                    <option value="Quadro 2">Quadro 2</option>
                                    <option value="Contratado(a)">Contratado(a)</option>
                                </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md form-floating">
                                <label for="motivo_03"  class="col-md-2 control-label">Motivo de afastamento do(a) professor(a)</label>
                                </div><div class="col-md-10">
                                <select class="form-select" id="motivo_03" name="motivo_03" onchange="smercMotivo([this.value], 'div_motivo_03')">
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
                                <div id="div_motivo_03">
                                  <input type="text" class="form-control" id="detalhe_motivo_03" name="detalhe_motivo_03" placeholder="Digite o motivo do afastamento do(a) professor(a)">
                                </div>
                                <br>
                                Início: <input type="date" placeholder="dd-mm-yyyy" value="" id="data_inicio_03" name="data_inicio_03"> - Término: <input type="date" id="data_final_03" name="data_final_03" onchange="document.querySelector('#indeterminado_03').checked = false;" placeholder="dd-mm-yyyy"> &nbsp; &nbsp; &nbsp; <input type="checkbox" id="indeterminado_03" name="indeterminado_03" onchange="if(this.checked){document.querySelector('#data_final_03').value = '';}"> Término indeterminado
                                &nbsp; &nbsp; &nbsp; <button type="button" class="btn btn-info" onclick="smercDiv(['oculto'], ['div_prof_04'])">+ Adicionar</button>
                                &nbsp; &nbsp; &nbsp; <button type="button" class="btn btn-danger" onclick="smercDiv(['div_prof_03'], ['oculto']); document.getElementById('nome_professor_03').value='';">- Remover</button>
                                </div>
                            </div>
                          </div>
                          




                          <div id="div_prof_04">
                            <div class="row form-group"><hr>
                                <div class="col-md">
                                  <label   class="col-md-2 control-label">Nome do(a) professor(a)</label>
                                </div>
                                <div class="col-md-10">
                                  <input type="text" class="form-control" id="nome_professor_04" name="nome_professor_04" placeholder="Digite o nome do(a) professor(a)">
                                  </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md">
                                <label for="professor_04"  class="col-md-2 control-label">Categoria do(a) professor(a)</label>
                                </div><div class="col-md-10">
                                <select  class="form-select" id="professor_04" name="professor_04">
                                    <option value=""></option>
                                    <option value="Quadro 1">Quadro 1</option>
                                    <option value="Quadro 2">Quadro 2</option>
                                    <option value="Contratado(a)">Contratado(a)</option>
                                </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md form-floating">
                                <label for="motivo_04"  class="col-md-2 control-label">Motivo de afastamento do(a) professor(a)</label>
                                </div><div class="col-md-10">
                                <select class="form-select" id="motivo_04" name="motivo_04" onchange="smercMotivo([this.value], 'div_motivo_04')">
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
                                <div id="div_motivo_04">
                                  <input type="text" class="form-control" id="detalhe_motivo_04" name="detalhe_motivo_04" placeholder="Digite o motivo do afastamento do(a) professor(a)">
                                </div>
                                <br>
                                Início: <input type="date" placeholder="dd-mm-yyyy" value="" id="data_inicio_04" name="data_inicio_04"> - Término: <input type="date" id="data_final_04" name="data_final_04" onchange="document.querySelector('#indeterminado_04').checked = false;" placeholder="dd-mm-yyyy"> &nbsp; &nbsp; &nbsp; <input type="checkbox" id="indeterminado_04" name="indeterminado_04" onchange="if(this.checked){document.querySelector('#data_final_04').value = '';}"> Término indeterminado
                                &nbsp; &nbsp; &nbsp; <button type="button" class="btn btn-info" onclick="smercDiv(['oculto'], ['div_prof_05'])">+ Adicionar</button>
                                </div>
                            </div>
                            
                          </div>
                          




                          <div id="div_prof_05">
                            <div class="row form-group"><hr>
                                <div class="col-md">
                                  <label   class="col-md-2 control-label">Nome do(a) professor(a)</label>
                                </div>
                                <div class="col-md-10">
                                  <input type="text" class="form-control" id="nome_professor_05" name="nome_professor_05" placeholder="Digite o nome do(a) professor(a)">
                                  </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md">
                                <label for="professor_05"  class="col-md-2 control-label">Categoria do(a) professor(a)</label>
                                </div><div class="col-md-10">
                                <select  class="form-select" id="professor_05" name="professor_05">
                                    <option value=""></option>
                                    <option value="Quadro 1">Quadro 1</option>
                                    <option value="Quadro 2">Quadro 2</option>
                                    <option value="Contratado(a)">Contratado(a)</option>
                                </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md form-floating">
                                <label for="motivo_05"  class="col-md-2 control-label">Motivo de afastamento do(a) professor(a)</label>
                                </div><div class="col-md-10">
                                <select class="form-select" id="motivo_05" name="motivo_05" onchange="smercMotivo([this.value], 'div_motivo_05')">
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
                                <div id="div_motivo_05">
                                  <input type="text" class="form-control" id="detalhe_motivo_05" name="detalhe_motivo_05" placeholder="Digite o motivo do afastamento do(a) professor(a)">
                                </div>
                                <br>
                                Início: <input type="date" placeholder="dd-mm-yyyy" value="" id="data_inicio_05" name="data_inicio_05"> - Término: <input type="date" id="data_final_05" name="data_final_05" onchange="document.querySelector('#indeterminado_05').checked = false;" placeholder="dd-mm-yyyy"> &nbsp; &nbsp; &nbsp; <input type="checkbox" id="indeterminado_05" name="indeterminado_05" onchange="if(this.checked){document.querySelector('#data_final_05').value = '';}"> Término indeterminado
                                </div>
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
        </div>



                            <div class="row form-group">
          <br>
          <textarea id="observacao" name="observacao" rows="5" cols="100"  placeholder="Se necessário, acrescente mais informações aqui..."></textarea>
          <br><br>  
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