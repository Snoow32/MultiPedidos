// Remove os dados de carrinho.

function deletarDados() {
$.ajax({
    url: 'deletar.php',
    type: 'POST',
    data: { deletar: true },
    success: function(response) {
    console.log(response);
    },
    error: function(xhr, status, error) {
    console.error(error);
    }
});
}