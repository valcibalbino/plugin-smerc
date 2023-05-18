// Ocultar ou Exibir id DIV
// smercDiv(['NomeDiv1 ocultar', 'NomeDiv2 ocultar', 'NomeDiv3 ocultar'], ['NomeDiv1 exibir', 'NomeDiv2 exibir'])
function smercDiv(auxOcultar, auxExibir) {
    for (let i in auxOcultar) {
        document.getElementById(auxOcultar[i]).style.display = "none";
    }
    for (let i in auxExibir) {
        document.getElementById(auxExibir[i]).style.display = "block";
    }
}

$(window).on("load", function(){
    // página totalmente carregada (DOM, imagens etc.)
    smercDiv(['einf','eefi','eejai','pmanha','ptarde','pnoite','livre','substituição'],['xyzz']);
 });