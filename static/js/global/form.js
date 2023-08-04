// Seleciona o form e manda os dados.

document.querySelector('#finalizar_pedido').addEventListener('click', function(event) {
    event.preventDefault();

    var retirarForm = document.querySelector('#retirar-form');
    var retirarFormr = document.querySelector('#retirar-formr');
    var entregaFormr = document.querySelector('#entrega-formr');

    var form;
    if (!retirarForm.classList.contains('hidden')) {
        form = retirarFormr;
    } else {
        form = entregaFormr;
    }

    if (!form) {
        console.error('Formulário não encontrado.');
        return;
    }

    var inputs = form.querySelectorAll('input[required], select[required]');

    var emptyFields = Array.from(inputs).filter(function(input) {
    return !input.value.trim();
    });

    if (emptyFields.length > 0) {
    alert_toast('Necessário preencher todos os campos.', 'error');
    return;
    }

    var telefoneInputs = form.querySelectorAll('input[name="tel"], input[name="tel"]');
    var telefoneValue = telefoneInputs[0].value.trim();

    if (telefoneValue.length !== 15) {
    alert_toast('Número de telefone inválido.', 'error');
    return;
    }

    if (form === entregaFormr) {
    var enderecoInput = form.querySelector('input[name="endereco"], input[name="endereco"]');
    var enderecoValue = enderecoInput.value.trim();

    if (enderecoValue === undefined) {
        alert_toast('Endereço inválido.', 'error');
        return;
    }
  
    var methodSelect = form.querySelector('select[name="method"], select[name="method"]');
    if (methodSelect.value === "selecione") {
        alert_toast('Coloque a forma de pagamento.', 'error');
        return;
    }
}
    var formData = new FormData(form);
    var request = new XMLHttpRequest();
    request.open("POST", "formulario.php", true);
    request.onload = function() {

        if (request.status >= 200 && request.status < 400) {

            console.log(request.responseText);

            if (emptyFields.length === 0 && telefoneValue.length === 15) {
                
                const url = '';
                const token = '';
                
                function enviarMensagem(dados) {
                  const number = dados.tel;
                  const message = `Olá, seu pedido foi enviado.`;
                
                  const requestData = {
                    number: number,
                    token: token,
                    message: message
                  };
                
                  $.ajax({
                    url: url,
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(requestData),
                    success: function(response) {
                    },
                    error: function(error) {
                    }
                  });
                }
                
                let mensagensEnviadas = false;
                
                fetch("dados.php")
                  .then((response) => response.json())
                  .then((data) => {
                    if (!mensagensEnviadas) {
                      data.forEach((item) => {
                        enviarMensagem(item);
                      });
                
                      mensagensEnviadas = true;
                    }
                  })
                  .catch((error) => {
                    console.log("Erro ao obter os dados:", error);
                  });

                let countdown = 5;
                let countdownInterval = setInterval(function() {
                    Swal.update({
                        allowOutsideClick: false,
                        title: 'Seu pedido foi enviado!',
                        text: 'Você será redirecionado para o WhatsApp em ' + countdown + ' segundos.',
                    });

                    countdown--;

                    if (countdown === 0) {
                        clearInterval(countdownInterval);
                        window.location.href = 'https://wa.me/554191486760';
                        enviarMensagem(formData.get('tel'));
                    }
                }, 1000);


                Swal.fire({
                    icon: 'success',
                    title: 'Seu pedido foi enviado!',
                    text: 'Você será redirecionado para o WhatsApp em ' + countdown + ' segundos.',
                    showConfirmButton: false
                });
                var input = document.querySelector('input[name="tel"]');
                input.blur();
            }
        } else {
            console.error("Erro ao processar os dados do formulário.");

            Swal.fire({
                icon: 'error',
                title: 'Error: 201',
                text: 'Ocorreu um erro ao processar o pedido. Por favor, tente novamente.',
                showConfirmButton: false,
                timer: 4000
            });
        }
    };

    request.onerror = function() {
        console.error("Erro ao processar os dados do formulário.");

        Swal.fire({
            icon: 'error',
            title: 'Error: 202',
            text: 'Ocorreu um erro ao processar o pedido. Por favor, tente novamente.',
            showConfirmButton: false,
            timer: 4000
        });
    };
    
    request.send(formData);
});

// Mostra o formulario de "Retirar".

document.getElementById("retirar").addEventListener("click", function() {
    var retirarSection = document.getElementById("retirar-form");
    var entregaSection = document.getElementById("entrega-form");

    retirarSection.classList.remove("hidden", "disabled");
    entregaSection.classList.add("hidden", "disabled");

    document.getElementById("entrega").style.backgroundColor = "white";
    document.getElementById("retirar").style.backgroundColor = "red";

    var elementosTextoPreto = document.querySelectorAll(".texto-branco");
    elementosTextoPreto.forEach(function(elemento) {
        elemento.style.color = "white";
    });

    var elementosTextoPreto = document.querySelectorAll(".texto-preto");
    elementosTextoPreto.forEach(function(elemento) {
        elemento.style.color = "black";
    });

    var elementosCaminho = document.querySelectorAll(".texto-preto path");
    elementosCaminho.forEach(function(caminho) {
        caminho.setAttribute("fill", "black");
    });
});

// Mostra o formulario de "Entrega".

document.getElementById("entrega").addEventListener("click", function() {
    var retirarSection = document.getElementById("retirar-form");
    var entregaSection = document.getElementById("entrega-form");

    retirarSection.classList.add("hidden", "disabled");
    entregaSection.classList.remove("hidden", "disabled");

    document.getElementById("retirar").style.backgroundColor = "white";
    document.getElementById("entrega").style.backgroundColor = "red";

    var elementosTextoPreto = document.querySelectorAll(".texto-preto");
    elementosTextoPreto.forEach(function(elemento) {
        elemento.style.color = "white";
    });

    var elementosTextoPreto = document.querySelectorAll(".texto-branco");
    elementosTextoPreto.forEach(function(elemento) {
        elemento.style.color = "black";
    });

    var elementosCaminho = document.querySelectorAll(".texto-preto path");
    elementosCaminho.forEach(function(caminho) {
        caminho.setAttribute("fill", "white");
    });
});

