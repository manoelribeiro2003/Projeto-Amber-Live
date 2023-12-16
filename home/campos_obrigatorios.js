function V_email(campo) {
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

function V_cadastrar() {
    p = document.getElementById("alertaEmail");
    v = document.getElementById("alertaSenha");
    V_email(p);
    V_valor(v);
}