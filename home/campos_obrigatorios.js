function V_email(campo) {
    if (campo.value.trim() == '') {
        p = document.getElementById("exampleInputEmail").innerHTML = '*Campo obrigatório';
        document.getElementById("exampleInputEmail").style.color = 'red';
    } else if (campo.value < 0) {
        document.getElementById("exampleInputEmail").innerHTML = '* O valor não pode ser negativo';
        document.getElementById("exampleInputEmail").style.color = 'red';
        campo.value = "";
        campo.focus();
    } else {
        document.getElementById("exampleInputEmail").innerHTML = '';
    }
}

function V_senha(campo) {
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