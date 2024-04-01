<?php

namespace App\Handlers;

class Product
{
  private int $id;
  private string $name_p;
  private int $qntt; // quantity
  private float $price;
  private string $description_p;
  private int $situation_p;
  private string $use_mode;
  private int $status;
  private int $highlight; // Destaque 
  private string $measure; // medida
  private string $img;

  public function getIdProduct(): int
  {
    return $this->id;
  }

  public function setIdProduct(int $id): void
  {
    $this->id = $id;
  }

  public function getNameProduct(): string
  {
    return $this->name_p;
  }

  public function setNameProduct(string $name_p): void
  {
    $this->name_p = $name_p;
  }

  public function getQntProduct(): int
  {
    return $this->qntt;
  }

  public function setQntProduct(int $qntt): void
  {
    $this->qntt = $qntt;
  }

  public function getPriceProduct(): string
  {
    return $this->price;
  }

  public function setPriceProduct(string $price): void
  {
    $this->price = $price;
  }

  public function getDescriptionProduct(): string
  {
    return $this->description_p;
  }

  public function setDescriptionProduct(string $description): void
  {
    $this->description_p = $description;
  }

  public function getUseModeProduct(): string
  {
    return $this->use_mode;
  }

  public function setUseModeProduct(string $use_mode): void
  {
    $this->use_mode = $use_mode;
  }

  public function getStatusProduct(): int
  {
    return $this->status;
  }

  public function setStatustProduct(int $status): void
  {
    $this->status = $status;
  }

  public function getHighLightProduct(): int
  {
    return $this->highlight;
  }

  public function setHighLightProduct(int $highlight): void
  {
    $this->highlight = $highlight;
  }

  public function getMeasureProduct(): string
  {
    return $this->measure;
  }

  public function setMeasureProduct(string $measure): void
  {
    $this->measure = $measure;
  }

  public function getImgProduct(): string
  {
    return $this->img;
  }

  public function setImgProduct(string $img): void
  {
    $this->img = $img;
  }



}
