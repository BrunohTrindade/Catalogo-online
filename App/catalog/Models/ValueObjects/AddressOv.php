<?php

namespace Catalog\Models\ValueObjects;

use Catalog\Util\Util;

class AddressOv
{

  private int $id;
  private string $name;
  private int $cep;
  private string $street;
  private int $number;
  private string $neighborhood;
  private string $city;
  private string $state;
  private string $complement;

  public function setIdAddress(string $id): void
  {
    $this->id = Util::slugString($id);
  }

  public function getIdAddress(): string
  {
    return $this->id;
  }


  public function setNameAddress(string $name): void
  {
    $this->name = strip_tags($name);
  }

  public function getNameAddress(): string
  {
    return $this->name;
  }

  public function setCepAddress(int $cep): void
  {
    $this->cep = Util::slugString($cep);
  }

  public function getCepAddress(): int
  {
    return $this->cep;
  }

  public function setStreetAddress(string $street): void
  {
    $this->street = strip_tags($street);
  }

  public function getStreetAddress(): string
  {
    return $this->street;
  }
  
  public function setNumberAddress(int $number): void
  {
    $this->number = strip_tags($number);
  }

  public function getNumberAddress(): int
  {
    return $this->number;
  }

  public function setNeighborhoodAddress(string $neighborhood): void
  {
    $this->neighborhood = strip_tags($neighborhood);
  }

  public function getNeighborhoodAddress(): string
  {
    return $this->neighborhood;
  }

  public function setCityAddress(string $city): void
  {
    $this->city = Util::slugString($city);
  }

  public function getCityAddress(): string
  {
    return $this->city;
  }

  public function setStateAddress(string $state): void
  {
    $this->state = Util::slugString($state);
  }

  public function getStateAddress(): string
  {
    return $this->state;
  }

  public function setComplementAddress(string $complement): void
  {
    $this->complement = strip_tags(trim($complement));
  }

  public function getComplementAddress(): string
  {
    return $this->complement;
  }
  
}
