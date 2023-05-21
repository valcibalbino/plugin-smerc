// Ocultar ou Exibir id DIV
// smercDiv(['NomeDiv1 ocultar', 'NomeDiv2 ocultar', 'NomeDiv3 ocultar'], ['NomeDiv1 exibir', 'NomeDiv2 exibir'])
function smercDiv(auxOcultar, auxExibir) {
    for (let i in auxOcultar) {
        document.getElementById(auxOcultar[i]).style.display = "none";
    }
    for (let i in auxExibir) {
        document.getElementById(auxExibir[i]).style.display = "block";
    }
    document.querySelector('#confirma-nome').textContent = "Mudou o texto!";
}

$(window).on("load", function(){
    // página totalmente carregada (DOM, imagens etc.)
    smercDiv(['einf','eefi','eejai','pmanha','ptarde','pnoite','livre','substituição','div-motivo-quadro-1','div-motivo-quadro-2','div-motivo-contratado','mais_htpc','mais_htpc2'],['oculto']);
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

 function resumo() {

   // Obtém os valores dos campos do formulário
   // id_usuario
   var nome = document.getElementById('nome').value;
   // id_escolar
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
   if(situacao == "livre"){
    var motivo = document.getElementById("motivolivre").value;
    var professortitular = document.getElementById('professor-titular').value;
   }

   // Se as aulas forem SUBSTITUIçÂO
   if(situacao == "substituição"){
    // Quadro 1
    var motivoq1 = document.getElementById("motivoq1").value;
    if(motivoq1 == "Outro") { motivoq1 = document.getElementById('motivo-quadro-1').value; }
    var professorq1 = document.getElementById('nome-quadro-1').value;
    var datainicioq1 = document.getElementById('data-inicio-q1').value;
    var datafimq1 = document.getElementById('data-fim-q1').value;
    // Quadro 2
    var motivoq2 = document.getElementById("motivoq2").value;
    if(motivoq2 == "Outro") { motivoq2 = document.getElementById('motivo-quadro-2').value; }
    var professorq2 = document.getElementById('nome-quadro-2').value;
    var datainicioq2 = document.getElementById('data-inicio-q2').value;
    var datafimq2 = document.getElementById('data-fim-q2').value;
    // Contratado
    var motivoc = document.getElementById("motivocontratado").value;
    if(motivoc == "Outro") { motivoc = document.getElementById('motivo-contratado').value; }
    var professorc = document.getElementById('nome-contratado').value;
    var datainicioc = document.getElementById('data-inicio-c').value;
    var datafimc = document.getElementById('data-fim-c').value;
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





   // Escreva Resumo das informações
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
   if(situacao == "livre"){
    summary += "<b>Motivo:</b> " + motivo + "\n";
    summary += "<b>Professor titular:</b> " + professortitular + "\n";
   }

   // Se as aulas forem SUBSTITUIÇÃO
   if(situacao == "substituição"){
    summary += "<hr>";
    summary += "<b>Professor Quadro 1:</b> " + professorq1 + "\n";
    summary += "<b>Motivo Quadro 1:</b> " + motivoq1 + "\n";
    summary += "<b>Data início:</b> " + datainicioq1 + "\n";
    summary += "<b>Data término:</b> " + datafimq1 + "\n";
    summary += "<hr>";
    summary += "<b>Professor Quadro 2:</b> " + professorq2 + "\n";
    summary += "<b>Motivo Quadro 2:</b> " + motivoq2 + "\n";
    summary += "<b>Data início:</b> " + datainicioq2 + "\n";
    summary += "<b>Data término:</b> " + datafimq2 + "\n";
    summary += "<hr>";
    summary += "<b>Professor Contratado:</b> " + professorc + "\n";
    summary += "<b>Motivo Contratado:</b> " + motivoc + "\n";
    summary += "<b>Data início:</b> " + datainicioc + "\n";
    summary += "<b>Data término:</b> " + datafimc + "\n";
   }

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