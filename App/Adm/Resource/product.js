//Carregar select de acordo com url
// Obtendo os parâmetros da URL
const urlParams = new URLSearchParams(window.location.search);

// Iterando sobre os parâmetros da URL
urlParams.forEach((value, key) => {
  // Selecionando o elemento DOM com o mesmo nome do parâmetro da URL
  const selectElement = document.querySelector(`select[name='${key}']`);

  // Se o elemento DOM existe
  if (selectElement) {
    // Iterando sobre as opções do elemento DOM
    selectElement.querySelectorAll('option').forEach(option => {
      // Verificando se o valor da opção corresponde ao valor do parâmetro da URL
      if (option.value === value) {
        // Adicionando o atributo "selected" à opção correspondente
        option.setAttribute('selected', 'selected');
      }
    });
  }
});
let highlight = document.getElementById('highlight')
if (highlight) {
  highlight.addEventListener('change', function () {
    // Verificar se o checkbox está marcado
    if (this.checked) {
      // Se estiver marcado, atualizar o valor para 1
      this.value = 1;
    } else {
      // Se não estiver marcado, atualizar o valor para 0 ou outro valor desejado
      this.value = 0;
    }
  });
}

let varStatus = document.getElementById('status')
if (varStatus) {
  varStatus.addEventListener('change', function () {
    // Verificar se o checkbox está marcado
    if (this.checked) {
      // Se estiver marcado, atualizar o valor para 1
      this.value = 1;
    } else {
      // Se não estiver marcado, atualizar o valor para 0 ou outro valor desejado
      this.value = 0;
    }
  });
}

async function loadCategory() {

  const response = await fetch('https://localhost/ep/Product-detail/category', {
    method: 'post',
    headers: {
      "Content-type": "application/json"
    }
  })
  const category = await response.json();

  let select = document.getElementById("category");

  let urlParam = new URLSearchParams(window.location.search);
  let param = urlParam.get('category_id');


  category.forEach(element => {
    let option = document.createElement("option");

    if (param && param == element.id) {
      console.log("ID do elemento:", element.id);
      option.setAttribute('selected', 'selected');
    }
    option.value = element.id;
    option.text = element.name;
    select.appendChild(option);
  });
}

async function createProduct(formId) {

  if (validateForm(formId)) {
    const response = await fetch(URL_DIR + '/product-detail/createProduct ', {
      method: 'post',
      headers: {
        "Content-type": "application/json"
      },
      body: JSON.stringify(getDataProduct())
    })

    if (!response.ok)
      throw new Error('Error')

    objData = await response.json();

    if (objData === false) {
      showMessage(ERROR, MSG_ERRO_CREATE);
    } else {
      showMessage(SUCCESS, MSG_SUCCESS_CREATE);
      document.getElementById('id').value = objData;

    }
  }
  console.log(objData)
}

function getDataProduct() {
  dataProduct = {
    category: document.getElementById('category').value,
    name: document.getElementById('name').value,
    price: document.getElementById('price').value,
    discount: document.getElementById('discount').value,
    measure: document.getElementById('measure').value,
    quantity: document.getElementById('quantity').value,
    use_mode: document.getElementById('use_mode').value,
    description: document.getElementById('description').value,
    status: document.getElementById('status').value,
    highlight: document.getElementById('highlight').value,
    id: id,
    updateType: 'product'
  }

  return dataProduct;
}

function getDataProductDelivery() {

  dataDelivery = {
    format: document.getElementById("format").value,
    width: document.getElementById("width").value,
    height: document.getElementById("height").value,
    length: document.getElementById("length").value,
    diameter: document.getElementById("diameter").value,
    weight: document.getElementById("weight").value,
    id: id,
    updateType: 'delivery'
  };

  return dataDelivery;
}

async function updateProduct(formId) {

  id = document.getElementById('id').value;

  if (validateForm(formId)) {
    const response = await fetch(URL_DIR + '/product-detail/updateProduct', {
      method: 'post',
      headers: {
        "Content-type": "application/json"
      },
      body: JSON.stringify(formId == 'updateProduct' ? getDataProduct() : getDataProductDelivery())
    })

    if (!response.ok)
      throw new Error('Erro');

    objdata = await response.json();

    if (objdata === true) {
      showMessage(SUCCESS, MSG_SUCCESS_UPDATE);
    } else {
      showMessage(INFO, Error());
    }
  }
}

function confirmDeleteImg() {
  var checkboxes = document.querySelectorAll(".image-checkbox:checked");
  var selectedImages = [];
  checkboxes.forEach(function (element) {
    selectedImages.push(element.value);
  });
  // Aqui você pode fazer algo com os valores selecionados, como enviar via Ajax ou atualizar o formulário para submissão
  console.log(selectedImages);

  // Verifique se alguma imagem foi selecionada
  if (selectedImages.length === 0) {
    showMessage(INFO, MSG_SELECT_IMG)
    return;
  }

  // Exibir confirmação com SweetAlert2
  Swal.fire({
    title: 'Você tem certeza?',
    text: 'Você está prestes a excluir a(s) imagen(s) selecionada(s).',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Sim, excluir!',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      // Aqui você pode adicionar o código para enviar os valores via Ajax ou atualizar o formulário para submissão
      deleteImg(selectedImages);
    }
  });

}

async function deleteImg(selectedImages) {
  const data = selectedImages;

  try {
    const response = await fetch(URL_DIR + '/product-detail/deleteImg', {
      method: 'post',
      headers: {
        "Content-type": "application-json"
      },
      body: JSON.stringify(data)
    })

    if (!response.ok)
      throw new Error();

    objData = await response.json();

    console.log(objData)

    if (objData === false) {
      showMessage(ERROR, MSG_ERRO);
    } else {
      imgList();
      showMessage(SUCCESS, MSG_SUCCESS_CREATE);
    }
  } catch (Error) {
    showMessage(ERROR, MSG_ERRO);
  }
}

async function imgList() {
  const data = {
    id: document.getElementById('id').value
  }

  try {
    const response = await fetch(URL_DIR + 'product-detail/selectImg', {
      method: 'post',
      headers: {
        'Content-type': 'application/json'
      },
      body: JSON.stringify(data)
    })


    if (!response.ok)
      throw new Error();

    const objData = await response.json();

    // Verifica se objData não está vazio
    if (objData !== '') {
      // Seleciona o elemento onde você deseja adicionar as imagens
      const imgList = document.getElementById('imgList');
      // Verifica se o elemento imgList não foi preenchido ainda
      imgList.innerHTML = '';
      objData.forEach(image => {
        // Cria um novo elemento 'div' para a coluna
        const colDiv = document.createElement('div');
        colDiv.classList.add('col-sm-2');

        // Cria um novo elemento 'div' para o cartão da imagem
        const cardDiv = document.createElement('div');
        cardDiv.classList.add('card');

        // Cria o elemento 'input' para o checkbox
        const checkboxInput = document.createElement('input');
        checkboxInput.type = 'checkbox';
        checkboxInput.name = 'selected_images[]';
        checkboxInput.value = image.img; // Assumindo que 'id' é o valor desejado para o checkbox
        checkboxInput.classList.add('image-checkbox');

        // Cria o elemento 'img' para a imagem
        const imageElement = document.createElement('img');
        imageElement.src = `${URL_DIR}${image.path}/${image.name}`; // Assume que 'path' contém o caminho da imagem
        imageElement.classList.add('card-img-top');

        // Adiciona os elementos ao div 'card'
        cardDiv.appendChild(checkboxInput);
        cardDiv.appendChild(imageElement);

        // Adiciona a div 'card' à div 'col'
        colDiv.appendChild(cardDiv);

        // Adiciona a div 'col' à lista de imagens
        imgList.appendChild(colDiv);
      });

    }

  } catch (Error) {
    showMessage(ERROR, Error);
  }
}

// Função para enviar as imagens para o servidor via fetch
function uploadImages() {
  // Obter o ID do elemento HTML
  var idElement = document.getElementById('id');

  // Verificar se o elemento com o ID existe
  if (!idElement) {
    console.error('Elemento com ID "id" não encontrado');
    return; // Retorna imediatamente se o elemento não for encontrado
  }


  // Obter o valor do ID
  var id = idElement.value;
  // Obter as imagens selecionadas chamando a função de function.js
  var images = getSelectedImages();

  // Criar um objeto FormData
  var formData = new FormData();

  // Adicionar o ID ao FormData
  formData.append('id', id);

  // Array para armazenar todas as promessas fetch
  var fetchPromises = [];

  // Adicionar cada imagem ao FormData
  images.forEach(function (image, index) {
    // Adiciona a promessa fetch ao array
    fetchPromises.push(
      fetch(image)
        .then(response => response.blob()) // Converte a resposta em um Blob
        .then(blob => {
          // Adiciona o Blob ao FormData com chave única
          formData.append('file' + index, blob);
        })
        .catch(error => console.error('Erro ao carregar a imagem:', error))
    );
  });

  // Quando todas as promessas fetch forem resolvidas, prosseguir
  Promise.all(fetchPromises).then(function () {
    // Agora, todas as imagens foram adicionadas ao formData

    // Configurar as opções da solicitação Fetch
    var requestOptions = {
      method: 'POST',
      body: formData
    };

    // URL do endpoint do servidor para enviar as imagens
    var url = `${URL_DIR}/product-detail/uploadImgs`;

    // Enviar a solicitação Fetch
    fetch(url, requestOptions)
      .then(response => {
        if (!response.ok) {
          throw new Error('Erro ao enviar imagens');
        }
        // Lidar com a resposta do servidor
        return response.json(); // ou response.blob(), dependendo do tipo de resposta do servidor
      })
      .then(data => {
        console.log('Resposta do servidor:', data);
        // Lidar com a resposta do servidor, se necessário
        if (data.success) {
          showMessage(SUCCESS, data.message);
          imgList();
        } else {
          showMessage(ERROR, data.message)

        }
      })
      .catch(error => {
        showMessage(ERROR, error.success)
        console.error('Erro durante o envio de imagens:', error);
      });
  });

}
