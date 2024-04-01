<?php

class Category
{
  private $id;
  private $name_c;
  private $description_c;
  private $situation_c;

  public function getIdCategory(): int
  {
    return $this->id;
  }

  public function setIdCategory(int $id): void
  {
    $this->id = $id;
  }

  public function getNameCategory(): string
  {
    return $this->name_c;
  }

  public function setNameCategory(string $name_c): void
  {
    $this->name_c = $name_c;
  }

  public function getDescriptionCategory(): string
  {
    return $this->description_c;
  }

  public function setDescriptionCategory(string $description): void
  {
    $this->description_c = $description;
  }

  public function getSituationCategory(): int
  {
    return $this->situation_c;
  }

  public function setSituationCategory(int $situation): void
  {
    $this->situation_c = $situation;
  }
}