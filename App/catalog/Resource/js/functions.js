function addressForm() {

  let selectValue = document.querySelector('input[name="optradio"]:checked').value;
  let show = document.getElementById('address');
  console.log(selectValue);
  switch (selectValue) {
    case '1':
      show.style.display = "";
      console.log("show");
      break;

    case '0':
      show.style.display = "none";
      console.log("hidden");
      break;

    default:
      show.style.display = "none";

      break;
  }
}

function validateFormUser(e) {

  let form = e.target;
  let isValid = validateForm(form);

  if (!isValid) {
    e.preventDefault();
    showMessage(WARNING, MSG_FILL_ALL_INPUTS);
    return;
  }
}

function validateForm(formId) {
  let event = window.event;

  const form = document.getElementById(formId);
  let isValid = true;

  form.querySelectorAll("input.required, select.required, textarea.required").forEach(function (element) {
    // Verifica se o elemento possui a classe "required"
    if (element.value.trim() === "") {
      // O campo está vazio
      element.classList.remove("is-valid");
      element.classList.add("is-invalid");
      showMessage(WARNING, MSG_FILL_ALL_INPUTS);
      event.preventDefault();
      isValid = false;
    } else {
      // O campo está preenchido
      element.classList.remove("is-invalid");
      element.classList.add("is-valid");
    }
  });

  return isValid;
}

function validatePassEmail(event, sendForm = true) {

  let pass = document.getElementById("pass");
  let passValue = pass.value;
  let confirmPass = document.getElementById("confirmPass");
  let confirmPassValue = confirmPass.value;
  let email = document.getElementById("email");
  let emailValue = email ? email.value : false;
  let confirmEmail = document.getElementById("confirmEmail");
  let confirmEmailValue = confirmEmail ? confirmEmail.value : "";

  if (email && emailValue !== confirmEmailValue) {
    showMessage(WARNING, MSG_INPUTS_EMAIL);
    email.classList.remove("is-valid");
    confirmEmail.classList.remove("is-valid");
    email.classList.add("is-invalid");
    confirmEmail.classList.add("is-invalid");
    event.preventDefault(); // Cancela o envio do formulário
    return false;
  }else if(pass && passValue !== confirmPassValue) {
    showMessage(WARNING, MSG_INPUTS_PASS);
    pass.classList.remove("is-valid");
    confirmPass.classList.remove("is-valid");
    pass.classList.add("is-invalid");
    confirmPass.classList.add("is-invalid");
    event.preventDefault(); // Cancela o envio do formulário
    return false;
  }else if (!sendForm && pass !== '') {
    console.log(confirmPass.value)
    event.preventDefault();
    return true;
  }else if(sendForm){
    return true;
  }

  

}

function validateCpf(cpf) {
  input = document.getElementById("cpf");
  if (cpf != '') {
    cpf = cpf.replace(/\D/g, '');
    let result = true;
    if (cpf.toString().length != 11 || /^(\d)\1{10}$/.test(cpf)) {
      result = false;
    }
    [9, 10].forEach(function (j) {
      var soma = 0, r;
      cpf.split(/(?=)/).splice(0, j).forEach(function (e, i) {
        soma += parseInt(e) * ((j + 2) - (i + 1));
      });
      r = soma % 11;
      r = (r < 2) ? 0 : 11 - r;
      if (r != cpf.substring(j, j + 1))
        result = false;
    });

    if (!result) {
      showMessage(ERROR, MSG_CPF_INVALID);
      input.classList.add("is-invalid");
      input.value = '';
    } else {
      input.classList.remove("is-invalid");
      input.classList.add("is-valid");
    }
  }
}

function clearInput(formId) {
  var formulario = document.getElementById(formId);

  // Verificar se o formulário existe
  if (formulario) {
    // Obter todos os elementos dentro do formulário
    var elements = formulario.elements;

    // Iterar sobre os elementos
    for (var i = 0; i < elements.length; i++) {
      // Verificar se o elemento tem a propriedade 'type' e é um input de texto
      if (elements[i].type && elements[i].type === 'text' && elements[i].classList.contains('required')) {
        // Limpar o campo
        elements[i].value = '';
        elements[i].classList.remove("is-valid");
      }
    }
  }
}

function fillStars(currentRating) {
  const starLinks = document.querySelectorAll('.star-link');

  starLinks.forEach((link, i) => {
    const star = link.querySelector('span');
    // Determinar a fração da estrela preenchida
    const fraction = currentRating - i;

    if (fraction >= 1) {
      // Estrela totalmente preenchida
      star.classList.remove('ion-ios-star-outline', 'ion-ios-star-half');
      star.classList.add('ion-ios-star');
    } else if (fraction > 0) {
      // Meia estrela
      star.classList.remove('ion-ios-star-outline', 'ion-ios-star');
      star.classList.add('ion-ios-star-half');
    } else {
      // Estrela vazia
      star.classList.remove('ion-ios-star', 'ion-ios-star-half');
      star.classList.add('ion-ios-star-outline');
    }

    // Adicionar evento de clique para preencher as estrelas ao clicar
    link.addEventListener('click', function (e) {
      e.preventDefault(); // Impedir a ação padrão do link
      const rating = document.getElementById("rating");
      // Obter o valor da estrela clicada
      const clickedValue = parseInt(this.dataset.value);
      // Atualizar o rating atual
      currentRating = clickedValue;

      rating.innerHTML = currentRating + ".0";

      // Preencher as estrelas de acordo com o novo rating
      fillStars(currentRating);
    });
  });
}

function showButtonAddress() {
  let input = document.getElementById("select");
  let create = document.getElementById("create");
  let update = document.getElementById("update");

  value = input.options[select.selectedIndex].value;

  if (value == 'new') {
    update.classList.add("d-none");
    create.classList.remove("d-none");
  } else {
    update.classList.remove("d-none");
    create.classList.add("d-none");
  }
}

function formatarMoeda(valor) {
  return parseFloat(valor).toLocaleString('pt-BR', {
    style: 'currency',
    currency: 'BRL'
  });
}















