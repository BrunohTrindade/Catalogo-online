function update(formId, event) {
  // Previne o comportamento padrão do botão
  console.log(formId);
  event.preventDefault();

  let form = document.getElementById(formId);
  if (validateForm(formId)) {
    let name = document.querySelector("#name");
    let cell = document.querySelector("#cell");
    let email = document.querySelector("#email");
    let cpf = document.querySelector("#cpf");
    let id = document.querySelector("#id");

    // Execute a lógica de atualização ao clicar no botão
    $.ajax({
      cache: false,
      url: URL_DIR + 'account/updateUser',
      type: 'POST', // Use POST, pois sua função updateUser no PHP está esperando um POST
      data: {
        name: name.value,
        cell: cell.value,
        email: email.value,
        cpf: cpf.value,
        update: "ajax",
        id: id.value
      }, // Envie um parâmetro indicando a atualização
      dataType: 'json',
      success: function (response) {
        // Manipule a resposta JSON recebida
        showMessage(SUCCESS, MSG_SUCCESS_UPDATE);
      },
      error: function (xhr, status, error) {
        // Tratar erros, se necessário
        showMessage(ERROR, MSG_ERRO_UPDATE);
      }
    });
  }
}

function createAddress(formId) {

  event.preventDefault();

  if (validateForm(formId)) {

    let name = document.querySelector("#name");
    let cep = document.querySelector("#cep");
    let street = document.querySelector("#street");
    let number = document.querySelector("#number");
    let neighborhood = document.querySelector("#neighborhood");
    let city = document.querySelector("#city");
    let state = document.querySelector("#state");
    let complement = document.querySelector("#complement");
    let id = document.querySelector("#id");

    $.ajax({
      cache: false,
      url: 'addressCreate',
      type: 'POST',
      data: {
        name: name.value,
        cep: cep.value,
        street: street.value,
        number: number.value,
        neighborhood: neighborhood.value,
        city: city.value,
        state: state.value,
        complement: complement.value,
        id: id.value,
        createAddress: "createAddress"
      },
      dataType: 'json',
      success: function (response) {
        // Manipule a resposta JSON recebida
        showMessage(SUCCESS, MSG_SUCCESS_UPDATE);
      },
      error: function (xhr, status, error) {
        // Tratar erros, se necessário
        // console.error(xhr.responseText);
        showMessage(ERROR, MSG_ERRO_UPDATE);
      }
    });
  }

}

async function selectAddress(formId) {
  let input = document.getElementById("select");

  value = input.options[select.selectedIndex].value;

  if (value == 'new') {
    clearInput(formId);
    showButtonAddress();
    return;
  }

  const dados = {
    id: value,
    ok: 'qualquer coisa'
  }

  try {
    const response = await fetch(URL_DIR + 'account/addressId', {
      method: 'post',
      body: JSON.stringify(dados),
      headers: {
        'Content-Type': 'application/json'
      }
    });
    // const responseBody = await response.text();
    // console.log("Response body:", responseBody);

    if (!response.ok)
      throw new Error("erro");

    const object = await response.json();

    // console.log(object);

    for (const key in object[0]) {

      if (object[0].hasOwnProperty(key)) {
        const element = document.getElementById(key)
        console.log(key);
        if (element) {
          element.value = object[0][key];
        }
      }
    }

  } catch (Error) {
    console.log(Error.message);

  } finally {

  }


}

async function updateAddress(formId) {
  event.preventDefault();

  if (validateForm(formId)) {
    const dados = {
      name: document.querySelector("#name").value,
      cep: document.querySelector("#cep").value,
      street: document.querySelector("#street").value,
      number: document.querySelector("#number").value,
      neighborhood: document.querySelector("#neighborhood").value,
      city: document.querySelector("#city").value,
      state: document.querySelector("#state").value,
      complement: document.querySelector("#complement").value,
      id: document.querySelector("#id").value,
      address_id: document.querySelector("#select").value
    }
    try {

      const response = await fetch(URL_DIR + 'account/updateAddress', {
        method: "post",
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(dados)
      })
      // const responseBody = await response.text();
      // console.log("Response body:", responseBody);

      if (!response.ok) {
        throw new Error("Erro")
      }
      let objDados = await response.json();

      if (objDados.msg == 5) {

        showMessage(SUCCESS, MSG_SUCCESS_UPDATE);
      } else {
        showMessage(ERROR, MSG_ERRO_UPDATE);
      }

    } catch (Error) {

      showMessage(ERROR, MSG_ERRO_UPDATE);
    }

  }
}

async function addComment(formId) {

  if (validateForm(formId)) {

    const data = {
      comment: document.getElementById("comment").value,
      product_id: document.getElementById("product_id").value
    }

    try {

      const response = await fetch(URL_DIR + 'product/insertComment', {
        method: 'post',
        headers: {
          "Content-type": "application/json"
        },
        body: JSON.stringify(data)
      })

      if (!response.ok)
        throw new Error("Erro");

      // const responseBody = await response.text();
      // console.log("Response body:", responseBody);

      let objDados = await response.json();
      if (objDados) {
        showMessage(SUCCESS, MSG_COMMENT_ADD);
        selectComments();
        comment.value = "";
      } else {
        showMessage(ERROR, MSG_ERRO);
      }

    } catch (Error) {
      showMessage(ERROR, MSG_ERRO);
    }
  }
}

async function selectComments() {
  const data = {
    product_id: document.getElementById("product_id").value
  }

  try {

    const response = await fetch(URL_DIR + 'product/selectComments', {
      method: 'post',
      headers: {
        "Content-type": "application/json"
      },
      body: JSON.stringify(data)
    });

    if (!response.ok)
      throw new Error("Error");

    // const responseBody = await response.text();
    // console.log("Response body:", responseBody);
    const objData = await response.json();

    if (objData.length > 0) {
      let commentList = document.querySelector(".comment-list");
      commentList.innerHTML = ''; // Limpar a lista de comentários existente

      objData.forEach(element => {
        // Criar um novo item de lista (li) para o comentário
        let newComment = document.createElement("li");
        newComment.classList.add("comment");
        let nComment = document.getElementById("n_comments");
        nComment.textContent = element.total_comment;

        // Criar a estrutura interna do novo comentário
        newComment.innerHTML = `
              <div class="vcard bio">
                  <img src="images/person_1.jpg">
              </div>
              <div class="comment-body">
                  <h3>${element.name}</h3>
                  <div class="meta">${element.created}</div>
                  <p>${element.comment}</p>
              </div>
          `;

        // Adicionar o novo item de lista à lista existente de comentários
        commentList.appendChild(newComment);
      });
    }

  } catch (Error) {

  }
}

async function verifyPass(formId, e) {
  e.preventDefault();
  if (validateForm(formId)) {
    const data = {
      email: document.getElementById("email_").value,
      pass: document.getElementById("password").value
    }

    try {
      const response = await fetch(URL_DIR + 'account/verifyPass', {
        method: "post",
        headers: {
          "Content-type": "application/json"
        },
        body: JSON.stringify(data)
      });

      let pass = document.getElementById("formPass");
      let changePass = document.getElementById("formChangePass");

      const objData = await response.json();
      console.log(objData);
      if (Number.isInteger(objData)) {
        pass.classList.add("d-none");
        changePass.classList.remove("d-none");
        showMessage(SUCCESS, MSG_PASS_OK);
      } else {
        showMessage(ERROR, MSG_PASS_WRONG);
      }
    } catch (Error) {
      showMessage(ERROR, MSG_ERRO);
    }
  }
}

async function recoveryPass(formId) {
  const data = {
    email: document.getElementById("email").value
  }

  if (validateForm(formId)) {
    try {
      const response = await fetch(URL_DIR + 'RecoveryPassword/verifyEmail', {
        method: 'post',
        headers: {
          "Content-type": "application/json"
        },
        body: JSON.stringify(data)
      })

      const objData = await response.json();

      if (objData.id) {
        changePass(objData.id, objData.email);
      } else {
        showMessage(ERROR, MSG_EMAIL_WRONG);
      }

    } catch (Error) {
      showMessage(ERROR, MSG_ERRO);
    }
  }
}

async function changePass(id, email, sendEmail = true, event = false, formId = false) {
  let pass = document.getElementById("confirmPass")
  const data = {
    id: id,
    email: email,
    pass: pass ? pass.value : ""
  }

  let endpoint;
  if (sendEmail) {
    endpoint = 'RecoveryPassword/changePassByEmail';
  } else {
    endpoint = 'account/changePass';
  }

  if (validateForm(formId) && validatePassEmail(event, false)) {
    try {
      const response = await fetch(URL_DIR + endpoint, {
        method: "post",
        headers: {
          "Content-type": "application/json"
        },
        body: JSON.stringify(data)
      })

      if (!response.ok)
        throw new Error();

      const objData = await response.json();

      if (objData) {
        console.log(pass.value)
        showMessage(SUCCESS, sendEmail ? MSG_PASS_UPDATE_EMAIL : MSG_SUCCESS_UPDATE);
        setTimeout(() => {
          window.location.href = sendEmail ? "login" : "account";
        }, 2500);
      } else {
        showMessage(ERROR, MSG_ERRO);
      }
    } catch (Error) {
      showMessage(ERROR, Error);
    }
  }
}



