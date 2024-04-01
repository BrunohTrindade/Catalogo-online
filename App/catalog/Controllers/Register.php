<?php

namespace Catalog\Controllers;

use Catalog\Models\AccountModel;
use Core\ConfigView;
use Catalog\Models\ValueObjects\UserOv;

class Register
{

  private array|null $data = [];
  private array|null $dataForm;

  public function index()
  {
    $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (!empty($this->dataForm['register'])) {

      $this->data['form'] = $this->dataForm;
      $newUser = new UserOv();

      $newUser->setNameUser($this->dataForm['name']);
      $newUser->setCellUser($this->dataForm['cell']);
      $newUser->setEmailUser($this->dataForm['email']);
      $newUser->setPassUser($this->dataForm['pass']);
      $newUser->setCpfUser("");
      $newUser->setTypeUser(USER_COMMON);

      if ($this->dataForm['email'] !== $this->dataForm['confirmEmail']) {
        $_SESSION['msg'] = 2;
        $this->loadView();
      }

      if ($this->dataForm['pass'] !== $this->dataForm['confirmPass']) {
        $_SESSION['msg'] = 1;
        $this->loadView();
      }

      $newUserModel = new AccountModel();
      $result = $newUserModel->insertNewUser($newUser);
      if ($result === true) {
        $_SESSION['msg'] = 4;
        header("Location: login");
      } else {
        $_SESSION['msg'] = -5;
         $this->loadView();
      }
    }
    $this->loadView();
  }

  public function loadView()
  {
    $loadView = new ConfigView("catalog/views/register/register", $this->data);
    $loadView->loadViewCatalog();
    exit;
  }
}
