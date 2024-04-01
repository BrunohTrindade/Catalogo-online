function habilitarCampos(flag) // flag é bool
{
  $("#city").prop("disabled", flag);
  $("#uf").prop("disabled", flag);
}

function limparFormulario() {
  //Limpa valores do formulário de cep.
  document.getElementById('street').value = ("");
  document.getElementById('neighborhood').value = ("");
  document.getElementById('city').value = ("");
  document.getElementById('state').value = ("");
  document.getElementById('cep').value = ("");
  // $("#cep").focus();
}

function meuCallback(conteudo) {
  if (!("erro" in conteudo)) {
    //Atualiza os campos com os valores.
    document.getElementById('street').value = (conteudo.logradouro);
    document.getElementById('neighborhood').value = (conteudo.bairro);
    document.getElementById('city').value = (conteudo.localidade);
    document.getElementById('state').value = (conteudo.uf);
    habilitarCampos(true);
  } //end if.
  else {
    //CEP não Encontrado.
    habilitarCampos(false);
    limparFormulario();
    MostrarMensagem(-2);
  }
}

function pesquisaCep(valor) {

  //Nova variável "cep" somente com dígitos.
  var cep = valor.replace(/\D/g, '');

  //Verifica se campo cep possui valor informado.
  if (cep != "") {

    //Expressão regular para validar o CEP.
    var validacep = /^[0-9]{8}$/;

    //Valida o formato do CEP.
    if (validacep.test(cep)) {

      //Preenche os campos com "..." enquanto consulta webservice.
      document.getElementById('street').value = "...";
      document.getElementById('neighborhood').value = "...";
      document.getElementById('city').value = "...";
      document.getElementById('state').value = "...";

      //Cria um elemento javascript.
      var script = document.createElement('script');

      //Sincroniza com o callback.
      script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meuCallback';

      //Insere script no documento e carrega o conteúdo.
      document.body.appendChild(script);

    } //end if.
    else {
      //cep é inválido.
      limparFormulario();
      showMessage(-3);
      habilitarCampos(true);
    }
  } //end if.
  else {
    //cep sem valor, limpa formulário.
    limparFormulario();
  }
};