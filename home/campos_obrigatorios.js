function V_produto(campo) {
    if (campo.value.trim() == '') {
        p = document.getElementById("alertaEmail").innerHTML = '*Campo obrigatório';
        document.getElementById("alertaEmail").style.color = 'red';
    } else {
        document.getElementById("alertaEmail").innerHTML = '';
    }
}

function V_senha(campo) {
    if (campo.value.trim() == '') {
        p = document.getElementById("alertaSenha").innerHTML = '*Campo obrigatório';
        document.getElementById("alertaSenha").style.color = 'red';
    } else {
        document.getElementById("alertaSenha").innerHTML = '';
    }
}

function V_valor(campo) {
    if (campo.value.trim() == '') {
        p = document.getElementById("alertaSenha").innerHTML = '*Campo obrigatório';
        document.getElementById("alertaSenha").style.color = 'red';
    } else if (campo.value < 0) {
        document.getElementById("alertaSenha").innerHTML = '* O valor não pode ser negativo';
        document.getElementById("alertaSenha").style.color = 'red';
        campo.value = "";
        campo.focus();
    } else {
        document.getElementById("alertaSenha").innerHTML = '';
    }
}

function V_quantidade(campo) {
    if (campo.value.trim() == '') {
        p = document.getElementById("alertaQuantidade").innerHTML = '*Campo obrigatório';
        document.getElementById("alertaQuantidade").style.color = 'red';
    }
    else if (campo.value < 0) {
        document.getElementById("alertaQuantidade").innerHTML = '* A quantidade não pode ser negativa';
        document.getElementById("alertaQuantidade").style.color = 'red';
        campo.value = "";
        campo.focus();
    } else {
        document.getElementById("alertaQuantidade").innerHTML = '';
    }
}



function V_cadastrar() {
    p = document.getElementById("produto");
    v = document.getElementById("valor");
    q = document.getElementById("quantidade");
    d = document.getElementById("validade");
    V_produto(p);
    V_valor(v);
    V_quantidade(q);
    V_validade(d);
}

function V_pesquisa(campo) {
    if (campo.value.trim() == '') {
        p = document.getElementById("alertaPesquisa").innerHTML = '*Campo obrigatório';
        document.getElementById("alertaPesquisa").style.color = 'red';
    } else {
        document.getElementById("alertaPesquisa").innerHTML = '';
    }
}

