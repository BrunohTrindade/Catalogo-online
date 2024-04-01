<?php

namespace Catalog\Controllers;

use Catalog\Controllers\helpers\SendEmail;
use Core\ConfigView;
use Catalog\Util\Util;
use Catalog\Models\AccountModel;
use Catalog\Models\ValueObjects\UserOv;

class RecoveryPassword
{
  private object $loadView;
  private array $dataForm;
  private object $accountModel;

  public function __construct()  {
    $this->accountModel = new AccountModel();
  }

  public function index()
  {
    $this->loadView();
  }

  public function verifyEmail(): void
  {
    $data = file_get_contents("php://input");
    $this->dataForm = json_decode($data, true);

    $user = new UserOv();
    $user->setEmailUser($this->dataForm['email']);
    $id = $this->accountModel->verifyEmail($user);
    echo json_encode($id,true);
  }

  public function changePassByEmail(): void
  {
    $data = file_get_contents("php://input");
    $this->dataForm = json_decode($data, true);

    $user = new UserOv();

    $newPass = Util::passGenerate();

    $user->setPassUser($newPass);
    $user->setIdUser($this->dataForm['id']);
    $user->setEmailUser($this->dataForm['email']);

    if($this->accountModel->recoveryPassword($user)){

     $user_info = $this->accountModel->verifyEmail($user);
     $user_info['pass'] = $newPass;
     $sendEmail = new SendEmail($user_info);
     $sendEmail->sendEmail($user_info);
     $sendEmail->getResult();
    }else{
      $result = false;
    }
    echo json_encode(true, true);
  }

  public function loadView(): void
  {
    $this->loadView = new ConfigView("catalog/views/recoveryPassword");
    $this->loadView->loadViewCatalog();
  }
}
