<?php

namespace Catalog\Controllers\Account;

use Core\ConfigView;
use Catalog\Models\OrderModel;
use Catalog\Models\AccountModel;
use Catalog\Models\ValueObjects\UserOv;

class Account
{

  private array|null $data;
  private array|null $dataForm;
  private object $accoutModel;

  public function __construct()
  {
    $this->accoutModel = new AccountModel();
  }

  public function index()
  {

    $this->data = $this->accoutModel->index($_SESSION['email']);

    $loadView = new ConfigView("catalog/views/account/account", $this->data);
    $loadView->loadViewCatalogAccount();
  }

  public function address()
  {

    $this->data = $this->accoutModel->address($_SESSION['id']);
    $adressIdsNames = [];

    // Percorre o array e adiciona os valores de 'address_id' ao novo array
    foreach ($this->data as $item) {
      $adressIdsNames[$item['address_id']] = $item['name'];
    }
    $this->data['ids'] =  $adressIdsNames;

    $loadPage = new ConfigView("Catalog/Views/account/address", $this->data);
    $loadPage->loadViewCatalogAccount();
  }

  public function addressCreate()
  {
    $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (!empty($this->dataForm['createAddress'])) {
      $user = new UserOv();

      $user->setNameAddress($this->dataForm['name']);
      $user->setCepAddress($this->dataForm['cep']);
      $user->setStreetAddress($this->dataForm['street']);
      $user->setNumberAddress($this->dataForm['number']);
      $user->setNeighborhoodAddress($this->dataForm['neighborhood']);
      $user->setCityAddress($this->dataForm['city']);
      $user->setStateAddress($this->dataForm['state']);
      $user->setComplementAddress($this->dataForm['complement']);
      $user->setIdUser($this->dataForm['id']);


      $result = $this->accoutModel->insertAddress($user);
      if ($result) {
        echo json_encode(['msg' => $result]);
      } else {
        echo json_encode(['msg' => -3]);
      }
    }
  }

  public function password()
  {
    $loadPage = new ConfigView("Catalog/Views/account/password");
    $loadPage->loadViewCatalogAccount();
  }

  public function updateUser()
  {
    $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (!empty($this->dataForm['update'])) {

      $this->data['form'] = $this->dataForm;
      $user = new UserOv();

      $user->setNameUser($this->dataForm['name']);
      $user->setCellUser($this->dataForm['cell']);
      $user->setCpfUser($this->dataForm['cpf']);
      $user->setIdUser($this->dataForm['id']);

      $result = $this->accoutModel->updateUser($user);

      if ($result) {
        echo json_encode(['msg' => 3]);
      } else {
        echo json_encode(['msg' => $result]);
      }
      exit; // Encerre a execução após enviar a resposta JSON

    } else {
      echo json_encode(['msg' => -1]); // Indicando que não há dados para atualizar
      exit;
    }
  }

  public function updateAddress()
  {
    $data = file_get_contents("php://input");

    $this->dataForm = json_decode($data, true);

    if (!empty($this->dataForm)) {
      $user = new UserOv();
      $user->setNameAddress($this->dataForm['name']);
      $user->setCepAddress($this->dataForm['cep']);
      $user->setStreetAddress($this->dataForm['street']);
      $user->setNumberAddress($this->dataForm['number']);
      $user->setNeighborhoodAddress($this->dataForm['neighborhood']);
      $user->setCityAddress($this->dataForm['city']);
      $user->setStateAddress($this->dataForm['state']);
      $user->setComplementAddress($this->dataForm['complement']);
      $user->setIdAddress($this->dataForm['address_id']);

      $result = $this->accoutModel->updateAddress($user);
      if ($result) {
        echo json_encode(['msg' => 5]);
      } else {
        echo json_encode(['msg' => -3]);
      }
    }
  }

  public function addressId()
  {
    $dadosBrutos = file_get_contents('php://input');

    $this->dataForm = json_decode($dadosBrutos, true);

    $result = $this->accoutModel->address_id($this->dataForm['id']);
    echo json_encode($result);
  }

  public function loadView()
  {
    $loadView = new ConfigView("catalog/views/account", $this->data);
    $loadView->loadViewCatalog();
    exit;
  }

  public function cards()
  {
    $this->data = [];
    $loadView = new ConfigView("catalog/views/account/cards", $this->data);
    $loadView->loadViewCatalogAccount();
  }

  public function verifyPass(): void
  {
    $data = file_get_contents("php://input");
    $this->dataForm = json_decode($data, true);

    $user = new UserOv();
    $user->setEmailUser($this->dataForm['email']);

    $pass = $this->accoutModel->verifyPass($user);

    if (password_verify($this->dataForm['pass'], $pass['pass'])) {

      echo json_encode($pass['id'], true);
    } else {
      echo json_encode(false, true);
    }
  }

  public function verifyEmail(): void
  {
    $data = file_get_contents("php://input");
    $this->dataForm = json_decode($data, true);

    $user = new UserOv();
    $user->setEmailUser($this->dataForm['email']);
    echo json_encode($this->accoutModel->verifyEmail($user));
  }

  public function changePass(): void
  {
    $data = file_get_contents("php://input");
    $this->dataForm = json_decode($data, true);

    $user = new UserOv();
    $user->setPassUser($this->dataForm['pass']);
    $user->setIdUser($this->dataForm['id']);

    echo json_decode($this->accoutModel->recoveryPassword($user), true);
  }

  public function countItems() {
    $cartItems = new OrderModel();
    $this->data['numberItemsCart'] = $cartItems->countProductsCart($_SESSION['id']);

    echo $this->data['numberItemsCart'][0]['total'];
  }
}
