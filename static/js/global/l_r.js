// Codigo de login/registro.

// ------------ Troca de cor/texto footer ------------ \\
const iconuser1 = document.getElementById("iconuser1");
const textuser1 = document.getElementById("textuser1");
const iconuser2 = document.getElementById("iconuser2");
const textuser2 = document.getElementById("textuser2");
const iconuser3 = document.getElementById("iconuser3");
const textuser3 = document.getElementById("textuser3");

iconuser1.addEventListener("click", function() {
  document.querySelectorAll(".btn-icon").forEach((icon) => {
    icon.classList.remove("text-light");
  });
  iconuser1.classList.add("text-light");
  textuser1.style.display = "block";
  textuser2.style.display = "none";
  textuser3.style.display = "none";
});

const closeButton = document.getElementById("bkclose");
const closeCardButton = document.getElementById("closeCard");

closeButton.addEventListener("click", function() {
  updateIconUser1();
});

closeCardButton.addEventListener("click", function() {
  updateIconUser1();
});

const modal = document.getElementById("perfil");
const modalContent = document.querySelector(".modal-content");

modalContent.addEventListener("click", function(event) {
  event.stopPropagation();
});

modal.addEventListener("click", function(event) {
  if (event.target === modal || event.target.id === "closeCard") {
    updateIconUser1();
    closeModal();
  }
});

function updateIconUser1() {
  document.querySelectorAll(".btn-icon").forEach((icon) => {
    icon.classList.remove("text-light");
  });
  iconuser1.classList.add("text-light");
  textuser1.style.display = "block";
  textuser2.style.display = "none";
  textuser3.style.display = "none";
}

function closeModal() {
  modal.classList.remove("show");
  modal.style.display = "none";
  document.body.classList.remove("modal-open");
  const modalBackdrop = document.getElementsByClassName("modal-backdrop")[0];
  modalBackdrop.parentNode.removeChild(modalBackdrop);
}

// evento para mostrar/esconder o texto2 - trocar cor do icone2
iconuser2.addEventListener("click", function() {
    document.querySelectorAll(".btn-icon").forEach((icon) => {
    icon.classList.remove("text-light");
    });
    iconuser2.classList.add("text-light");
    textuser2.style.display = "block";
    textuser1.style.display = "none";
});

// evento para mostrar/esconder o texto3 - trocar cor do ícone3
iconuser3.addEventListener("click", function() {
    document.querySelectorAll(".btn-icon").forEach((icon) => {
      icon.classList.remove("text-light");
    });
    iconuser3.classList.add("text-light");
    textuser3.style.display = "block";
    textuser1.style.display = "none";
    textuser2.style.display = "none";
});  

// ------------ Register ------------ \\
document.querySelector('#register_submit').addEventListener('click', function(event) {
    event.preventDefault();

    var form = document.querySelector('#register');
    var inputs = form.querySelectorAll('input[required]');

    var emptyFields = Array.from(inputs).filter(function(input) {
        return !input.value.trim();
    });

    if (emptyFields.length > 0) {
        alert_toast('Necessário preencher todos os campos.', 'error');
        return;
    }

    var nameField = form.querySelector('input[name="nome"]');
    if (nameField && nameField.value.length <= 3) {
        alert_toast('O nome está pequeno (min 4 letras).', 'error');
        return;
    }

    var emailField = form.querySelector('input[name="email"]');
    if (emailField && !/\S+@\S+\.\S+/.test(emailField.value)) {
        alert_toast('Email inválido, verifique seu email.', 'error');
        return;
    }

    var passwordField = form.querySelector('input[name="senha"]');
    if (passwordField) {
        var password = passwordField.value;
        if (password.length < 5) {
            alert_toast('Senha fraca (min 5 caracteres).', 'error');
            return;
        }
        if (!/\d/.test(password) || !/[A-Z]/.test(password)) {
            alert_toast('A senha deve conter pelo menos 1 número e 1 letra maiúscula.', 'error');
            return;
        }
    }

    var repeatPasswordField = form.querySelector('input[name="repetir_senha"]');
    if (repeatPasswordField && repeatPasswordField.value !== passwordField.value) {
        alert_toast('Os campos de senha não coincidem, certifique sua senha.', 'error');
        return;
    }

    var formData = new FormData(form);
    var request = new XMLHttpRequest();
    request.open("POST", "register.php", true);
    request.onload = function() {

        if (request.status >= 200 && request.status < 400) {

            console.log(request.responseText);

            if (request.responseText === "Email já cadastrado.") {
                alert_toast('Email já cadastrado.', 'error');

                function alert_toast(msg, bg, pos) {
                    var Toast = Swal.mixin({
                        toast: true,
                        position: pos || 'top',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    Toast.fire({
                        icon: bg,
                        title: msg,
                        iconHtml: '<div class="swal2-icon swal2-error swal2-icon-show" style="display: flex;"><span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span><span class="swal2-x-mark-line-right"></span></span></div>'
                    });
                }
                
            } else {
                alert_toast('Usuário registrado com sucesso!', 'success');

                function alert_toast(msg, bg, pos) {
                    var Toast = Swal.mixin({
                        toast: true,
                        position: pos || 'top',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    Toast.fire({
                        icon: bg,
                        title: msg,
                    iconHtml: '<div class="swal2-icon swal2-success swal2-icon-show" style="display: flex;"><div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div><span class="swal2-success-line-tip"></span><span class="swal2-success-line-long"></span><div class="swal2-success-ring"></div><div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div><div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div></div>'
                    });
                }

                $('#myModal').modal('hide');
                $('#loginModal').modal('show');
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

// ------------ Login ------------ \\
document.querySelector('#login-usuario-btn').addEventListener('click', function(event) {
    event.preventDefault();

    var form = document.querySelector('#login');
    var inputs = form.querySelectorAll('input[required]');
    var emptyFields = Array.from(inputs).filter(function(input) {
        return !input.value.trim();
    });

    if (emptyFields.length > 0) {
        alert_toast('Necessário preencher todos os campos.', 'error');
        return;
    }

    var formData = new FormData(form);

    var request = new XMLHttpRequest();
    request.open("POST", "login.php", true);
    request.onload = function() {
        if (request.status >= 200 && request.status < 400) {
            console.log(request.responseText);
            var response = JSON.parse(request.responseText);
            
            if (response.message === "success") {
                $('#loginModal').modal('hide');
                
                iconuser2.style.display = "none";
                textuser2.style.display = "none";
                iconuser3.style.display = "block";
                textuser3.style.display = "block";
    
                location.reload();
            } else {
                alert_toast('Senha ou email inválido.', 'error');
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
