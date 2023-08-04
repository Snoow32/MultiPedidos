// Busca o cep com API-BRASIL e preenche os inputs.

const inputCep = document.querySelector('input[name="cep"]');
const inputEndereco = document.querySelector('input[name="endereco"]');
const inputResidencia = document.querySelector('input[name="residencia"]');
const inputBairro = document.querySelector('input[name="bairro"]');
const inputCidade = document.querySelector('input[name="cidade"]');
const inputEstado = document.querySelector('input[name="estado"]');

inputCep.addEventListener('blur', () => {
  const cep = inputCep.value.replace(/\D/g, '');

  if (cep.length === 8) {
    fetch(`https://brasilapi.com.br/api/cep/v1/${cep}`)
      .then(response => response.json())
      .then(data => {
        if (data.error) {
          console.error('CEP não encontrado');
        } else {
          inputEndereco.value = data.street;
          inputBairro.value = data.neighborhood;
          inputCidade.value = data.city;
          inputEstado.value = data.state;
          inputResidencia.focus();
        }
      })
      .catch(error => {
        console.error('Erro na busca do CEP:', error);
      });
  }
});
