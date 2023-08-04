// Desloga o usuario.

document.getElementById("sair").addEventListener("click", function() {
    var request = new XMLHttpRequest();
    request.open("GET", "logout.php", true);
    request.onload = function() {
        if (request.status >= 200 && request.status < 400) {
            location.reload();
        } else {
            console.error("Erro ao encerrar a sessão.");
        }
    };
    request.onerror = function() {
        console.error("Erro na solicitação AJAX para encerrar a sessão.");
    };
    request.send();
});
