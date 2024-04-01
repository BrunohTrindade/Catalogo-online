async function createCategory(formId) {

  const data = {
    name: document.getElementById("name").value,
    description: document.getElementById("description").value,
    status: customSwitch(document.getElementById("customSwitch21").value)
  }
  if (validateForm(formId)) {
    const response = await fetch(URL_DIR + '/category-detail/createCategory', {
      method: 'post',
      headers: {
        "Content-type": "application/json"
      },
      body: JSON.stringify(data)
    })

    if (!response.ok)
      throw new Error('Error')

    let objData = await response.json();

    if (objData === false) {
      showMessage(ERROR, MSG_ERRO_CREATE);
    } else {
      showMessage(SUCCESS, MSG_SUCCESS_CREATE);
      document.getElementById('id').value = objData;
    }
  }
}

async function updateCategory(formId) {
  const data = {
    name: document.getElementById("name").value,
    description: document.getElementById("description").value,
    status: checkBox(),
    id: document.getElementById("id").value
  };
  console.log(data);
  if (validateForm(formId)) {
    try {
      const response = await fetch(URL_DIR + '/category-detail/updateCategory', {
        method: 'post',
        headers: {
          "Content-type": "application/json"
        },
        body: JSON.stringify(data)
      });

      if (!response.ok) {
        throw new Error('Erro na requisição');
      }

      const objdata = await response.text();

      console.log(objdata);

      if (objdata.trim() === 'true') {
        showMessage(SUCCESS, MSG_SUCCESS_UPDATE);
      } else {
        showMessage(INFO, MSG_ERRO);
      }
    } catch (error) {
      showMessage(ERROR, 'Erro na requisição');
    }
  }
}
function checkBox() {
  const checkboxes = document.querySelectorAll('.form-check-input');
  
  // Variável para armazenar o valor do checkbox marcado
  let valorCheckboxMarcado = null;

  checkboxes.forEach(checkbox => {
    if (checkbox.checked) {
      valorCheckboxMarcado = checkbox.value;
    }
  });

  return valorCheckboxMarcado;
}





