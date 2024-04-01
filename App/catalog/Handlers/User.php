<?php

namespace User;

class User
{
  private int $id;
  private string $name;
  private string $pass;
  private string $token;
  private string $email;
  private string $tel;
  private int $type;

  public function getIdUser(): int
  {
    return $this->id;
  }

  public function setIdUser($id): void
  {
    $this->id = $id;
  }

  public function getName(): int
  {
    return $this->name;
  }

  public function setName($name): void
  {
    $this->name = $name;
  }

  public function getEmail(): int
  {
    return $this->email;
  }

  public function setEmail($email): void
  {
    $this->email = $email;
  }

  public function getTel(): int
  {
    return $this->tel;
  }

  public function setTel($tel): void
  {
    $this->tel = $tel;
  }

  public function getPass(): int
  {
    return $this->pass;
  }

  public function setPass($pass): void
  {
    $this->pass = $pass;
  }

  public function getType(): int
  {
    return $this->type;
  }

  public function setType($type): void
  {
    $this->type = $type;
  }

  public function getToken(): int
  {
    return $this->token;
  }

  public function setToken($token): void
  {
    $this->token = $token;
  }

}
