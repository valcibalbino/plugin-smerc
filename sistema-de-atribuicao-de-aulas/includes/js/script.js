// Ocultar ou Exibir id DIV
// smercDiv(['NomeDiv1 ocultar', 'NomeDiv2 ocultar', 'NomeDiv3 ocultar'], ['NomeDiv1 exibir', 'NomeDiv2 exibir'])
function smercDiv(auxOcultar, auxExibir) {
    for (let i in auxOcultar) {
        document.getElementById(auxOcultar[i]).style.display = "none";
    }
    for (let i in auxExibir) {
        document.getElementById(auxExibir[i]).style.display = "block";
    }
    //document.querySelector('#confirma-nome').textContent = "Mudou o texto!";
}

$(window).on("load", function(){
    // página totalmente carregada (DOM, imagens etc.)
 });


 function smercMotivo(auxvalor, auxdiv) {
    if (auxvalor == 'Outro') {
        smercDiv(['oculto'], [auxdiv]);
    } else {
        smercDiv([auxdiv], ['oculto']);
    }
 }
 
 function smercHTPC(auxvalor, auxdiv) {
    if (auxvalor == true) {
        smercDiv(['oculto'], [auxdiv]);
    } else {
        smercDiv([auxdiv], ['oculto']);
    }
 }


 function format_data(valor){
    if(valor=="") {
        return "";
    } else {
        const dataCriada = new Date(valor);
        const dataFormatada = dataCriada.toLocaleDateString('pt-BR', {
        timeZone: 'UTC',
        });
        return dataFormatada;
    }
  }

 function resumo() {

   // Obtém os valores dos campos do formulário
   //var id_usuario = document.getElementById('id_usuario').value;
   //var id_escola = document.getElementById('id_escola').value;
   var nome = document.getElementById('nome').value;
   var unidade = document.getElementById('nome_unidade').value;
   var etapa = smerc_radio("etapa"); //document.querySelector('input[name="etapa"]:checked').value;
   
   // Recebe variável "classe"
   var xclasse = "";
   if(etapa == "Educação Infantil") { var xclasse = smerc_radio("classeinfantil"); }
   if(etapa == "Ensino Fundamental I") { var xclasse = smerc_radio("classefundamental"); }
   if(etapa == "EJA I") { var xclasse = smerc_radio("classeeja"); }
   
   var turma = document.getElementById("turma").value;
   var quantidade = smerc_radio("quantidade");
   var periodo = smerc_radio("periodo");

   // Recebe variável "horario"
   var horario = "";
   if(periodo == "manhã") { var horario = smerc_radio("horariomanha"); }
   if(periodo == "tarde") { var horario = smerc_radio("horariotarde"); }
   if(periodo == "noite") { var horario = smerc_radio("horarionoite"); }

   var situacao = document.getElementById("situa").value;

   // Se as aulas forem LIVRES
   if(situacao == "Livre"){
    var nome_professor_01 = document.getElementById('nome_professor_livre').value;
    var motivo_01 = document.getElementById('motivo_livre').value;
   }

   // Se as aulas forem SUBSTITUIçÂO
   if(situacao == "Substituição"){
    // Professor 1
    var nome_professor_01 = document.getElementById("nome_professor_01").value; //nome
    var professor_01 = document.getElementById('professor_01').value; // categoria
    var motivo_01 = document.getElementById("motivo_01").value; // motivo select
    var detalhe_motivo_01 = ""; // variavel de controle zerar
    if(motivo_01 == "Outro") { detalhe_motivo_01 = document.getElementById('detalhe_motivo_01').value; } // motivo texto
    var data_inicio_01 = document.getElementById('data_inicio_01').value;
    var data_final_01 = document.getElementById('data_final_01').value;

    // variáveis de controle
    var p2 = false, p3 = false, p4 = false, p5 = false;
    var detalhe_motivo_02 = "", detalhe_motivo_03 = "", detalhe_motivo_04 = "", detalhe_motivo_05 = ""; 

    // Professor 2    
    var nome_professor_02 = document.getElementById("nome_professor_02").value; //nome
    if (nome_professor_02.length > 3) {
        p2 = true;
        var professor_02 = document.getElementById('professor_02').value; // categoria
        var motivo_02 = document.getElementById("motivo_02").value; // motivo select
        if(motivo_02 == "Outro") { detalhe_motivo_02 = document.getElementById('detalhe_motivo_02').value; } // motivo texto
        var data_inicio_02 = document.getElementById('data_inicio_02').value;
        var data_final_02 = document.getElementById('data_final_02').value;
    }
    // Professor 3
    var nome_professor_03 = document.getElementById("nome_professor_03").value; //nome
    if (nome_professor_03.length > 3) {
        p3 = true;
        var professor_03 = document.getElementById('professor_03').value; // categoria
        var motivo_03 = document.getElementById("motivo_03").value; // motivo select
        if(motivo_03 == "Outro") { detalhe_motivo_03 = document.getElementById('detalhe_motivo_03').value; } // motivo texto
        var data_inicio_03 = document.getElementById('data_inicio_03').value;
        var data_final_03 = document.getElementById('data_final_03').value;
    }
    // Professor 4
    var nome_professor_04 = document.getElementById("nome_professor_04").value; //nome
    if (nome_professor_04.length > 3) {
        p4 = true;
        var professor_04 = document.getElementById('professor_04').value; // categoria
        var motivo_04 = document.getElementById("motivo_04").value; // motivo select
        if(motivo_04 == "Outro") { detalhe_motivo_04 = document.getElementById('detalhe_motivo_04').value; } // motivo texto
        var data_inicio_04 = document.getElementById('data_inicio_04').value;
        var data_final_04 = document.getElementById('data_final_04').value;
    }
    // Professor 5
    var nome_professor_05 = document.getElementById("nome_professor_05").value; //nome
    if (nome_professor_05.length > 3) {
        p5 = true;
        var professor_05 = document.getElementById('professor_05').value; // categoria
        var motivo_05 = document.getElementById("motivo_05").value; // motivo select
        if(motivo_05 == "Outro") { detalhe_motivo_05 = document.getElementById('detalhe_motivo_05').value; } // motivo texto
        var data_inicio_05 = document.getElementById('data_inicio_05').value;
        var data_final_05 = document.getElementById('data_final_05').value;
    }
   }


   // Dias de reuniões pedagógicas HTPC
   if(document.getElementById("newh1").checked || (document.getElementById("dia_htpc").value.trim() === '')){
    var dias = 0; // Não há dias de htpc definido
   } else {
    var dias = 1;
    var diahtpc = document.getElementById("dia_htpc").value;
    var hora01 = document.getElementById("hora01").value;
    var hora02 = document.getElementById("hora02").value;
    // Possui mais um segundo dia de HTPC
    if(document.getElementById("newh2").checked){
      var dias = 2;  
      var diahtpc2 = document.getElementById("dia_htpc2").value;
      var hora03 = document.getElementById("hora03").value;
      var hora04 = document.getElementById("hora04").value;
      // Possui mais um terceiro dia de HTPC
      if(document.getElementById("newh3").checked){
        var dias = 3;  
        var diahtpc3 = document.getElementById("dia_htpc3").value;
        var hora05 = document.getElementById("hora05").value;
        var hora06 = document.getElementById("hora06").value;
      }
    }
   }

   var observacao = document.getElementById('observacao').value;



   ///// Escreva Resumo das informações /////
   var summary = "\n";
   summary += "<b>Nome do responsável:</b> " + nome + "\n";
   summary += "<b>Unidade escolar:</b> " + unidade + "\n";
   summary += "<b>Etapa:</b> " + etapa + "\n";
   summary += "<b>Classe:</b> " + xclasse + "\n";
   summary += "<b>Turma:</b> " + turma + "\n";
   summary += "<b>Quantidade de aulas:</b> " + quantidade + "\n";
   summary += "<b>Período:</b> " + periodo + "\n";
   summary += "<b>Horário:</b> " + horario + "\n";
   summary += "<b>Situação da classe:</b> " + situacao + "\n";

   // Se as aulas forem LIVRES
   if(situacao == "Livre"){
    summary += "<b>Professor Titular:</b> " + nome_professor_01 + "\n";
    summary += "<b>Motivo do afastamento:</b> " + motivo_01 + "\n";
   }

   // Se as aulas forem SUBSTITUIÇÃO
   if(situacao == "Substituição"){
    summary += "<hr>";
    summary += "<b>Professor 1:</b> " + nome_professor_01 + "\n";
    summary += "<b>Categoria:</b> " + professor_01 + "\n";
    summary += "<b>Motivo do afastamento:</b> " + motivo_01 + " - " + detalhe_motivo_01 + "\n";
    summary += "<b>Data início:</b> " + format_data(data_inicio_01) + "\n";
    summary += "<b>Data término:</b> " + format_data(data_final_01) + "\n";
    if (p2) {
        summary += "<hr>";
        summary += "<b>Professor 2:</b> " + nome_professor_02 + "\n";
        summary += "<b>Categoria:</b> " + professor_02 + "\n";
        summary += "<b>Motivo do afastamento:</b> " + motivo_02 + " - " + detalhe_motivo_02 + "\n";
        summary += "<b>Data início:</b> " + format_data(data_inicio_02) + "\n";
        summary += "<b>Data término:</b> " + format_data(data_final_02) + "\n";
    }
    if (p3) {
        summary += "<hr>";
        summary += "<b>Professor 3:</b> " + nome_professor_03 + "\n";
        summary += "<b>Categoria:</b> " + professor_03 + "\n";
        summary += "<b>Motivo do afastamento:</b> " + motivo_03 + " - " + detalhe_motivo_03 + "\n";
        summary += "<b>Data início:</b> " + format_data(data_inicio_03) + "\n";
        summary += "<b>Data término:</b> " + format_data(data_final_03) + "\n";
    }
    if (p4) {
        summary += "<hr>";
        summary += "<b>Professor 3:</b> " + nome_professor_04 + "\n";
        summary += "<b>Categoria:</b> " + professor_04 + "\n";
        summary += "<b>Motivo do afastamento:</b> " + motivo_04 + " - " + detalhe_motivo_04 + "\n";
        summary += "<b>Data início:</b> " + format_data(data_inicio_04) + "\n";
        summary += "<b>Data término:</b> " + format_data(data_final_04) + "\n";
    }
    if (p5) {
        summary += "<hr>";
        summary += "<b>Professor 3:</b> " + nome_professor_05 + "\n";
        summary += "<b>Categoria:</b> " + professor_05 + "\n";
        summary += "<b>Motivo do afastamento:</b> " + motivo_05 + " - " + detalhe_motivo_05 + "\n";
        summary += "<b>Data início:</b> " + format_data(data_inicio_05) + "\n";
        summary += "<b>Data término:</b> " + format_data(data_final_05) + "\n";
    }
 
   }

    // reuniões pedagógicas HTPC
    summary += "<hr>";
    summary += "<b>Dias e horários de reuniões pedagógicas - HTPC</b> " + "\n";
    if(dias == 0){
        summary += "Não há dias definidos para os HTPCs \n";
    }
    if(dias > 0){
        summary += "<b>Dia da semana:</b> " + diahtpc + "\n";
        summary += "<b>Início:</b> " + hora01 + "\n";
        summary += "<b>Término:</b> " + hora02 + "\n";       
    }
    if(dias >1){
        summary += "\n";
        summary += "<b>Dia da semana:</b> " + diahtpc2 + "\n";
        summary += "<b>Início:</b> " + hora03 + "\n";
        summary += "<b>Término:</b> " + hora04 + "\n";        
    }
    if(dias > 2){
        summary += "\n";
        summary += "<b>Dia da semana:</b> " + diahtpc3 + "\n";
        summary += "<b>Início:</b> " + hora05 + "\n";
        summary += "<b>Término:</b> " + hora06 + "\n";        
    }

   // Exibe o resumo na tela
   document.getElementById('summary').innerHTML = summary.replace(/\n/g, '<br>');

  }

  function smerc_radio(myRadio){
    var aux = null;
    var radioOptions = document.getElementsByName(myRadio);
    for (var i = 0; i < radioOptions.length; i++) {
        if (radioOptions[i].checked) {
          var aux = document.querySelector('input[name="'+myRadio+'"]:checked').value;
          break;
        }
      }
      return aux;
  }
