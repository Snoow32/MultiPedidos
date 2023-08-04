// Desabilita o site temporariamente.

function fetchData() {
    var xhr = new XMLHttpRequest();
  
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var status = parseInt(xhr.responseText);
        updateClass(status);
        console.log("fetch: ", status);
      }
    };
  
    xhr.open("GET", "status.php", true);
    xhr.send();
  }
  
  function updateClass(status) {
    var cardapioGlobal = document.getElementById("cardapio_global");
    if (status === 1) {
      cardapioGlobal.classList.remove("disabled");
    } else {
      cardapioGlobal.classList.add("disabled");
  
      Swal.fire({
        icon: 'warning',
        title: 'Desculpe, estamos fechados no momento.',
        text: 'Aberto das 10:00 às 17:30.',
        showConfirmButton: false,
        timer: 100000
      });
    }
  }
  
  window.addEventListener("load", function() {
    fetchData();
  });
  