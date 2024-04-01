<?php 

namespace Catalog\Models\ValueObjects;

use Catalog\Util\Util;

class UserOv extends AddressOv{

  private int $id;
  private string $name;
  private string $email;
  private int $cell;
  private string $cpf;
  private string $pass;
  private int $type;
  private string $token;

  public function setIdUser(string $id) :void
  {
    $this->id = $id;
  }

  public function getIdUser() :string
  {
    return $this->id;
  }

  public function setNameUser(string $name) :void
  {
    $this->name = $name;
  }

  public function getNameUser() :string
  {
    return $this->name;
  }

  public function setEmailUser(string $email) :void
  {
    $this->email = $email;
  }
  
  public function getEmailUser() :string
  {
    return $this->email;
  }

  public function setCellUser(string $cell) :void
  {
    $this->cell = Util::slugString($cell);
  }
  
  public function getCellUser() :string
  {
    return $this->cell;
  }

  public function setCpfUser(string $cpf) :void
  {
    $this->cpf = Util::slugString($cpf);
  }
  
  public function getCpfUser() :string
  {
    return $this->cpf;
  }

  public function setPassUser(string $pass) :void
  {
    $this->pass = password_hash($pass, PASSWORD_DEFAULT);
  }
  
  public function getPassUser() :string
  {
    return $this->pass;
  }

  public function setTokenUser(string $token) :void
  {
    $this->token = $token;
  }
  
  public function getTokenUser() :string
  {
    return $this->token;
  }

  public function setTypeUser(int $type) :void
  {
    $this->type = $type;
  }
  
  public function getTypeUser() :int
  {
    return $this->type;
  }


}