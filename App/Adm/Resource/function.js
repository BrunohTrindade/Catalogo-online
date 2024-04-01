// Função para pré-visualização da imagem selecionada
var imageUrls = [];

function previewImages(event) {
  var preview = document.getElementById('preview');
  var files = event.target.files;

  for (var i = 0; i < files.length; i++) {
      var reader = new FileReader();
      reader.onload = function() {
          var image = new Image();
          image.src = reader.result;
          image.style.maxWidth = '300px'; // Defina o tamanho máximo da imagem
          preview.appendChild(image);

          // Adiciona o URL da imagem ao array
          imageUrls.push(reader.result);
      };
      reader.readAsDataURL(files[i]);
  }
}

// Função que retorna as imagens selecionadas
function getSelectedImages() {
  return imageUrls;
}

// Adiciona um evento de escuta ao input de arquivo para chamar a função de pré-visualização quando uma imagem é selecionada
document.getElementById('fileInput').addEventListener('change', previewImages);

function validateForm(formId) {
    let event = window.event;
   
    const form = document.getElementById(formId);
    let isValid = true;
  
    form.querySelectorAll("input, select, textarea").forEach(function (element) {
      // Verifica se o elemento não possui a classe "required"
      if (!element.classList.contains("required")) {
          // Adiciona a classe is-valid
          element.classList.add("is-valid");
      } else {
          // Verifica se o campo obrigatório está preenchido
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
      }
  });
  
  
    return isValid;
  }
