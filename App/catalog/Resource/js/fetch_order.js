async function addProductCart(id = "", price = "") {

  const qtyElement = document.getElementById("qty");
  if (qtyElement) {
    var qtyValue = qtyElement.value;
  }

  const data = {
    product_id: id == "" ? document.getElementById("product_id").value : id,
    qty: id == "" ? document.getElementById("qty").value : 1,
    price: price == "" ? document.getElementById("price").value : price
  }
  try {

    const response = await fetch(URL_DIR + 'cart/addCart', {
      method: 'post',
      headers: {
        "Content-type": "application/json"
      },
      body: JSON.stringify(data)
    });

    if (!response.ok)
      throw new Error("error");


    const objData = await response.json();

    console.log(objData)
    if (objData === true) {
      showMessage(SUCCESS, MSG_PRODUCT_ADD);
      changeButtonCart();
      countProductCart();
    } else if (objData === 'login') {
      showMessage(INFO, MSG_PRODUCT_ADD_LOGIN);
    } else if (objData === false) {
      showMessage(SUCCESS, MSG_PRODUCT_ALREADY);
    }

  } catch (Error) {
    showMessage(ERROR, Error);;
  }
}

function changeButtonCart() {
  let btn = document.getElementById("btn_cart");

  if (btn)
    btn.innerText = "Adicionado ao Carrinho!";
}

async function cart() {
  const data = {
    user_id: document.getElementById("user_id").value
  }

  try {
    const response = await fetch(URL_DIR + 'cart/indexFetch', {
      method: 'post',
      headers: {
        "Content-type": "application/json"
      },
      body: JSON.stringify(data)
    });

    // Verifica se a resposta está OK
    if (!response.ok) {
      throw new Error(errorMessage);
    }

    const responseData = await response.json();

    tableCart(responseData.response)

  } catch (error) {
    // Captura e trata o erro
    showMessage(ERROR, error);
  }
}

async function tableCart(data) {
  // Seleciona o corpo da tabela
  const spanTotal = document.getElementById("subtotal-price-cart");
  const total = document.getElementById("total");
  const tbody = document.getElementById('cart-body');

  tbody.innerHTML = '';
  let totalPrice = 0;
  let msgWA = '';
  // console.log(data);
  // Itera sobre os dados e renderiza na tabela
  data.forEach((item, index) => {

    let discount_p = item.price_p * (item.discount / 100);
    let price_p = item.price_p + discount_p;


    const tr = document.createElement('tr');


    // Coluna para remover produto
    const removeTd = document.createElement('td');
    removeTd.classList.add('product-remove');
    const link = document.createElement('a');
    link.setAttribute('href', '#');
    const span = document.createElement('span');
    span.classList.add('ion-ios-close');
    link.appendChild(span);
    removeTd.appendChild(link);
    tr.appendChild(removeTd);
    link.setAttribute('data-id', item.id_p);
    link.addEventListener('click', function (event) {
      const idToRemove = parseInt(this.getAttribute('data-id'));
      const indexToRemove = data.findIndex(item => item.id_p === idToRemove);

      if (data.splice(indexToRemove, 1).length > 0)// função que remove o index atual, o 2º parametro é a qntt de index a serem excluidos após o index atual
      {
        if (removeProduct(item.id_p)) {
          showMessage(SUCCESS, MSG_PRODUCT_REMOVED);
          tableCart(data);
        } else {
          showMessage(ERROR, MSG_ERRO);
        }
        return;
      }
    });

    const imgTd = document.createElement('td');
    const img = document.createElement('img');

    img.src = `${URL_DIR}${item.path}/${item.img_name}`;
    img.alt = item.name; // Defina um texto alternativo para acessibilidade
    img.style.width = '100px'; // Defina a largura da imagem
    img.style.height = 'auto'; // A altura será ajustada automaticamente para manter a proporção
    imgTd.appendChild(img);
    tr.appendChild(imgTd);

    // Coluna para o nome do produto
    const nameTd = document.createElement('td');
    const product_link = document.createElement('a');
    const nameH3 = document.createElement('h3');
    product_link.href = URL_DIR + `product/item/${item.id_p}/${item.name_link}`
    nameTd.classList.add("product-name");
    nameH3.textContent = item.name;
    product_link.appendChild(nameH3);
    nameTd.appendChild(product_link);
    tr.appendChild(nameTd);

    // Coluna para o preço
    const priceTd = document.createElement('td');
    priceTd.textContent = formatarMoeda(parseInt(price_p));
    tr.appendChild(priceTd);

    // Coluna para a quantidade
    const quantityTd = document.createElement('td');
    const quantityInput = document.createElement('input');
    quantityInput.type = 'number'; // Alterado de 'text' para 'number' para permitir apenas entradas numéricas
    quantityInput.name = 'quantity';
    quantityInput.classList.add('quantity', 'form-control', 'input-number');
    quantityInput.value = item.qty;
    quantityInput.min = 1;
    quantityInput.max = 100;
    quantityInput.addEventListener('input', function () {
      const newQuantity = parseInt(quantityInput.value);
      const newTotalPrice = parseFloat(price_p) * newQuantity;
      totalTd.textContent = formatarMoeda(newTotalPrice.toFixed(2));
      item.qty = newQuantity;
      // Recalcular o totalPrice apenas com base na quantidade do item atual
      totalPrice = calcularTotalPrice(data);
      spanTotal.innerHTML = formatarMoeda(totalPrice);

      if (!isNaN(item.qty) && item.qty !== null && item.qty !== 0) {
        updateProductCart(item.id_p, item.qty);
      }
    })
    const quantityInputGroup = document.createElement('div');
    quantityInputGroup.classList.add('input-group', 'mb-3');
    quantityInputGroup.appendChild(quantityInput);
    quantityTd.appendChild(quantityInputGroup);
    tr.appendChild(quantityTd);

    // Coluna para o total
    const totalTd = document.createElement('td');
    var totalPriceItem = parseFloat(price_p) * parseInt(item.qty);
    totalTd.textContent = formatarMoeda(totalPriceItem.toFixed(2));
    tr.appendChild(totalTd);

    // Adiciona a linha à tabela
    tbody.appendChild(tr);

    // Atualiza o totalPrice com o valor do item atual
    totalPrice += totalPriceItem;

    msgWA += `${item.qty} ${item.name} *R$ ${item.price_p}*%0A%0A`;
  });

  spanTotal.innerHTML = formatarMoeda(totalPrice);
  total.innerHTML = formatarMoeda(totalPrice);

  msgWA += `Total: *R$ ${totalPrice.toFixed(2)}*`

  linkWA(msgWA);
}

// Função para calcular o totalPrice com base nas quantidades atualizadas
function calcularTotalPrice(data) {
  return data.reduce((acumulado, valueCurrent) => {
    const discount = valueCurrent.price_p * (valueCurrent.discount / 100);
    const price = valueCurrent.price_p + discount;
    return acumulado + (parseFloat(price) * parseInt(valueCurrent.qty));
  }, 0);
}

async function removeProduct(id) {
  const data = {
    product_id: id
  }

  try {
    const response = await fetch(URL_DIR + 'cart/deleteProductCart', {
      method: 'post',
      headers: {
        "Content-type": "application/json"
      },
      body: JSON.stringify(data)
    })

    if (!response.ok)
      throw new Error(MSG_ERRO);

    const objData = await response.json();

    // const responseBody = await response.text();
    // console.log("Response body:", responseBody);
    if (objData.response) {
      countProductCart();
      return true;
    } else {
      return false;
    }
  } catch (Error) {
    showMessage(ERROR, Error);
    return false;
  }
}

async function updateProductCart(id, qty) {
  const data = {
    product_id: id,
    quantity: qty
  }

  try {
    const response = await fetch(URL_DIR + 'cart/updateProductCart', {
      method: 'post',
      headers: {
        "Content-type": "application/json"
      },
      body: JSON.stringify(data)
    })

    if (!response.ok)
      throw new Error(MSG_ERRO);

    const objData = await response.json();

    // console.log(objData.response);
    if (objData.response) {
      cart();
      countProductCart();
      showMessage(SUCCESS, MSG_PRODUCT_UPDATE);
      return true;
    } else {
      return false;
    }
  } catch (Error) {
    showMessage(ERROR, Error);
    return false;
  }
}

async function countProductCart() {
  try {
    const response = await fetch(URL_DIR + 'Account/countItems', {
      method: 'post',
      headers: {
        "Content-type": "application/json"
      },
    })

    if (!response.ok)
      throw new Error(MSG_ERRO);

    const objData = await response.json();

    console.log(objData)

    let countItems = document.getElementById('totalItemsCart');
    countItems.innerHTML = `[${objData}]`;
  } catch (Error) {
    showMessage(ERROR, Error)
  }
}

function linkWA(msg) {
  let link = document.getElementById('btnWA');

  link.setAttribute('href', `https://wa.me/5543999308446?text=${formatLinkWA(msg)}`);
}

function formatLinkWA(msg) {
  return "_Olá,+selecionei+alguns+produtos+e+quero+proceder+com+a+compra:_+%0A" + msg.split(' ').join('+')
}
