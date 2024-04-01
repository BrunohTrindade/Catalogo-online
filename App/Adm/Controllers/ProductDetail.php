<?php

namespace Adm\Controllers;

use Core\ConfigView;
use Adm\Models\ProductModel;
use Adm\Models\ValueObject\ProductVo;

class ProductDetail
{
  private object $loadView;
  private array $data;
  private object $model;

  public function __construct()
  {
    $this->model = new ProductModel();
  }

  public function index($param): void
  {
    // $data = file_get_contents("php://input");
    // $this->data = json_decode($data, true);
    $this->data = $this->model->product($param);

    if (!empty($this->data))
      $this->data[0]['img'] = explode(',', $this->data[0]['img_name']);

    $this->loadView = new ConfigView("Adm/Views/products/product", $this->data);
    $this->loadView->loadViewAdm();
  }

  public function category()
  {
    $this->model = new ProductModel();
    echo json_encode($this->model->category(), true);
  }

  public function createProduct()
  {
    $data = file_get_contents("php://input");
    $formData = json_decode($data, true);

    $productVo = new ProductVo();

    $productVo->setCategoryId($formData['category']);
    $productVo->setName($formData['name']);
    $productVo->setPrice($formData['price']);
    $productVo->setDiscount($formData['discount']);
    $productVo->setMeasure($formData['measure']);
    $productVo->setQuantity($formData['quantity']);
    $productVo->setUseMode($formData['use_mode']);
    $productVo->setDescription($formData['description']);
    $productVo->setStatus($formData['status']);
    $productVo->setHighlight($formData['highlight']);

    echo json_encode($this->model->createProductModel($productVo), true);
  }

  public function updateProduct()
  {

    $data = file_get_contents("php://input");
    $formData = json_decode($data, true);

    $productVo = new ProductVo();

    if ($formData['updateType'] == 'product') {
      $productVo->setCategoryId($formData['category']);
      $productVo->setName($formData['name']);
      $productVo->setPrice($formData['price']);
      $productVo->setDiscount($formData['discount']);
      $productVo->setMeasure($formData['measure']);
      $productVo->setQuantity($formData['quantity']);
      $productVo->setUseMode($formData['use_mode']);
      $productVo->setDescription($formData['description']);
      $productVo->setStatus($formData['status']);
      $productVo->setHighlight($formData['highlight']);
      $productVo->setId($formData['id']);

      $return = $this->model->updateProductModel($productVo);
    } else if ($formData['updateType'] == 'delivery') {
      $productVo->setWidth($formData['width']);
      $productVo->setLength($formData['length']);
      $productVo->setHeight($formData['height']);
      $productVo->setDiameter($formData['diameter']);
      $productVo->setFormat($formData['format']);
      $productVo->setWeight($formData['weight']);
      $productVo->setId($formData['id']);

      $return = $this->model->updateProductDeliveryModel($productVo);
    }
    echo json_encode($return, true);
  }

  public function deleteImg()
  {
    $data = file_get_contents("php://input");
    $formData = json_decode($data, true);

    $return = $this->model->deleteImgProductModel($formData);
    echo json_encode($return, true);
  }

  public function loadView(): void
  {

    $this->loadView = new ConfigView("adm/Views/home/home", $this->data);
    $this->loadView->loadViewAdm();
  }

  public function selectImg()
  {
    $data = file_get_contents("php://input");
    $formData = json_decode($data, true);
    $return = $this->model->selectImgProduct($formData['id']);

    echo json_encode($return, true);
  }

  public function uploadImgs()
  {
    // Verificar se algum arquivo foi enviado
    if (!empty($_FILES)) {
      // Verifica se foi enviado também o ID
      if (isset($_POST['id'])) {
        $id = $_POST['id'];
        
        $name = $this->model->selectNameProductCateg($id);
        $file_name = "{$name['product_id']}_{$name['first_word_product_name']}";
        $category_name = "{$name['category_id']}_{$name['first_word_category_name']}";

        // Gerar um número aleatório de 4 dígitos
        // $random_number = rand(1000, 9999);
        // $file_name .= $random_number;
      }

      // Inicializa um array para armazenar informações sobre as imagens enviadas
      $response = array();

      // Itera sobre cada arquivo enviado
      foreach ($_FILES as $fileKey => $file) {
        // Verifica se não há erros no envio do arquivo
        if ($file['error'] === UPLOAD_ERR_OK) {

          $categoryPath = "App/catalog/Public/Images/$category_name/";
          // Criar diretório do produto dentro do diretório da categoria
          $produtoPath = $categoryPath . $file_name;
          if (!is_dir($produtoPath)) {
            mkdir($produtoPath, 0777, true);
          }
          // Obter a extensão do arquivo
          $fileExtension = mime_content_type($file['tmp_name']);
          $fileExtension = explode('/', $fileExtension)[1];
          // Gerar um número aleatório de 4 dígitos 
          $random_number = rand(1000, 9999);
          $file_name .= "_" . $random_number .".". $fileExtension;
          // Diretório onde deseja salvar a imagem
          $destination = $produtoPath ."/". $file_name;

          // Move o arquivo do local temporário para o destino desejado no servidor
          if (move_uploaded_file($file['tmp_name'], $destination)) {
            // Arquivo movido com sucesso
            $response[] = array('success' => true);

            $this->model->insertImgs($file_name, $name['product_id'],  $produtoPath);
          } else {
            // Se houver erros ao mover o arquivo, adiciona uma mensagem de erro ao array de resposta
            $response[] = array('filename' => $file_name, 'success' => false, 'message' => 'Erro ao mover o arquivo');
          }
        } else {
          // Se houver erros no envio do arquivo, adiciona uma mensagem de erro ao array de resposta
          $response[] = array('filename' => $file['name'], 'success' => false, 'message' => 'Erro no envio da imagem');
        }
      }

      // Envia a resposta para o cliente (pode ser JSON, texto, etc.)
      echo json_encode($response);
    } else {
      // Se nenhum arquivo foi enviado, envia uma mensagem de erro para o cliente
      echo json_encode(array('success' => false, 'message' => 'Nenhum arquivo foi enviado'));
    }
  }
}
