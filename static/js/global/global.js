// Codigo global.

let maisButtons = document.querySelectorAll(".mais");
let menosButtons = document.querySelectorAll(".menos");
let qtyElements = document.querySelectorAll(".num");
let valorProdutoElements = document.querySelectorAll('.price-menu-p');
let valorTotalElements = document.querySelectorAll('.valor_total');
let produtos = document.querySelectorAll('.name');
let produtosAdicionadosElements = document.querySelectorAll('.produtos_adicionados');
let formAllforms = document.querySelectorAll('.trocadec');
let fimbtn = document.querySelectorAll('#proximo');
let add = document.querySelector('#adicionar_mais');

var inputs = document.querySelectorAll('input, textarea');
inputs.forEach(function(input) {
    input.setAttribute('tabindex', '-1');
});

let valorTotal = 0.00;
let carrinho = {
    cart_id: null,
    items: []
};


for (let i = 0; i < maisButtons.length; i++) {
    let mais = maisButtons[i];
    let menos = menosButtons[i];
    let qty = qtyElements[i];
    let valor_produto = parseFloat(valorProdutoElements[i].textContent.replace('R$', '').replace(',', '.'));
    let formAll = formAllforms[i];
    let produtosAdicionadosElement = produtosAdicionadosElements[i];

    mais.addEventListener("click", () => {
    let a = parseInt(qty.innerText);
    if (isNaN(a)) {
        a = 0;
    }
    a++;
    a = (a < 100) ? a : 10;
    qty.innerText = a;
    atualizarValorTotal();
    atualizarProdutosAdicionados();

    if (valorTotal >= 5.00) {
        fimbtn.forEach((btn) => {
        btn.classList.remove("disabled");
        });
    } else {
        fimbtn.forEach((btn) => {
        btn.classList.add("disabled");
        });
    }
    });

    menos.addEventListener("click", () => {
    let a = parseInt(qty.innerText);
    if (a > 0) {
        a--;
        a = (a < 100) ? a : 10;
        qty.innerText = a;
        atualizarValorTotal();
        atualizarProdutosAdicionados();

        if (valorTotal >= 5.00) {
        fimbtn.forEach((btn) => {
            btn.classList.remove("disabled");
        });
        } else {
        fimbtn.forEach((btn) => {
            btn.classList.add("disabled");
        });
        }
    }
    });

    mais.addEventListener("click", function() {
        menos.classList.remove("hidden");
        qty.classList.remove("hidden");
    });
  
    menos.addEventListener("click", function() {
        let a = parseInt(qty.innerText);
        if (a === 0) {
        menos.classList.add("hidden");
        qty.classList.add("hidden");
        }
    });
}

function atualizarValorTotal() {
    valorTotal = 0.00;

    qtyElements.forEach((qtyElement, index) => {
    let quantidade = parseInt(qtyElement.innerText);
    let valor_produto = parseFloat(valorProdutoElements[index].textContent.replace('R$', '').replace(',', '.'));
    if (!isNaN(quantidade) && !isNaN(valor_produto)) {
        valorTotal += valor_produto * quantidade;
    }
    });

    valorTotalElements.forEach((valorTotalElement) => {
    valorTotalElement.textContent = valorTotal.toFixed(2).replace('.', ',');
    });
}

function atualizarProdutosAdicionados() {
    carrinho.items = [];

    for (let i = 0; i < qtyElements.length; i++) {
    let quantidade = parseInt(qtyElements[i].innerText);
    let nomeProduto = produtos[i].textContent;
    let valor_produto = parseFloat(valorProdutoElements[i].textContent.replace('R$', '').replace(',', '.'));
    let valorTotalProduto = quantidade * valor_produto;

    if (quantidade > 0) {
        carrinho.items.push({
        quantidade: quantidade,
        nomeProduto: nomeProduto,
        preco: valor_produto,
        valorTotal: valorTotalProduto
        });
    }
    }

    produtosAdicionadosElements.forEach((produtosAdicionadosElement) => {
    let produtosAdicionados = carrinho.items.map((item) => {
        return item.quantidade + "x " + item.nomeProduto;
    }).join('<br>');

    produtosAdicionadosElement.innerHTML = produtosAdicionados;
    });
}

// Quando clicado no botao <proximo>.

fimbtn.forEach((fimbtn) => {
    fimbtn.addEventListener('click', (event) => {
        event.preventDefault();
        
        let carrinhoInput = document.getElementById('carrinho-input');

        carrinho.cart_id = generateCartId();
        carrinhoInput.value = JSON.stringify(carrinho);
        var formData = new FormData();

        formData.append('carrinho', JSON.stringify(carrinho));

        var request = new XMLHttpRequest();
        request.open('POST', 'carrinho.php', true);
        request.onload = function() {

        if (request.status >= 200 && request.status < 400) {
        } else {
            console.error('Erro ao enviar os dados do carrinho.');
        }
        };
        request.onerror = function() {

        console.error('Erro ao enviar os dados do carrinho.');
        };

        request.send(formData);
    });
});

function generateCartId() {
    return '<?php echo uniqid(); ?>';
}
    
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
    iconHtml: '<div class="swal2-icon swal2-error swal2-icon-show" style="display: flex;"><span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span><span class="swal2-x-mark-line-right"></span></span></div>',
    customClass: {
        title: 'custom-alert-title'
    }
    });
}

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
        iconHtml: '<div class="swal2-icon swal2-error swal2-icon-show" style="display: flex;"><span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span><span class="swal2-x-mark-line-right"></span></span></div>',
        customClass: {
        title: 'custom-alert-title'
        }
    });
    }