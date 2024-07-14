const inpTitulo = document.querySelector("#txtTitulo");
const inpGenero = document.querySelector("#selGenero");
const inpQtdPag = document.querySelector("#numQtdPag");

const divMsg = document.querySelector("#divMsg");

function validar() {
    var msgErro = "";

    if(inpTitulo.value == '') {
        msgErro = "Informe o título do livro!";
    } else if(! inpGenero.value) {
        msgErro = "Informe o gênero do livro!";
    } else if(! inpQtdPag.value) {
        msgErro = "Informe a quantidade de páginas do livro!";
    }

    if(msgErro) {
        divMsg.innerHTML = msgErro;
        divMsg.style.display = "block";
        return false;
    }

    return true;
}