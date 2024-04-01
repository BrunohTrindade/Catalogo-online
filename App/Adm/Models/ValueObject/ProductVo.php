<?php 

namespace Adm\Models\ValueObject;

use Adm\Util\Util;

class ProductVo
{
    private int $id;
    private string $name;
    private int $quantity;
    private int $price;
    private string $description;
    private int $status;
    private string $use_mode;
    private int $highlight;
    private string $measure;
    private int $discount;  
    private int $category_id;
    private int $height;
    private int $width;
    private int $length;
    private int $diameter;
    private int $format;
    private int $weight;

  public function getId(): string {
      return $this->id;
  }

  public function setId(string $id): void {
      $this->id = $id;
  }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getQuantity(): int {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void {
        $this->quantity = $quantity;
    }

    public function getPrice(): int {
        return $this->price;
    }

    public function setPrice(int $price): void {
        $this->price = $price;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = Util::formatDescricaoProduto($description);
    }

    public function getStatus(): int {
        return $this->status;
    }

    public function setStatus(int $status): void {
        $this->status = $status;
    }

    public function getUseMode(): string {
        return $this->use_mode;
    }

    public function setUseMode(string $use_mode): void {
        $this->use_mode = $use_mode;
    }

    public function getHighlight(): int {
        return $this->highlight;
    }

    public function setHighlight(int $highlight): void {
        $this->highlight = $highlight;
    }

    public function getMeasure(): string {
        return $this->measure;
    }

    public function setMeasure(string $measure): void {
        $this->measure = $measure;
    }

    public function getDiscount(): int {
        return $this->discount;
    }

    public function setDiscount(int $discount): void {
        $this->discount = $discount;
    }

    public function getCategoryId(): int {
        return $this->category_id;
    }

    public function setCategoryId(int $category_id): void {
        $this->category_id = $category_id;
    }

    public function getHeight(): int {
        return $this->height;
    }

    public function setHeight(int $height): void {
        $this->height = $height;
    }

    public function getWidth(): int {
        return $this->width;
    }

    public function setWidth(int $width): void {
        $this->width = $width;
    }

    public function getLength(): int {
        return $this->length;
    }

    public function setLength(int $length): void {
        $this->length = $length;
    }

    public function getDiameter(): int {
        return $this->diameter;
    }

    public function setDiameter(int $diameter): void {
        $this->diameter = $diameter;
    }

    public function getFormat(): int {
        return $this->format;
    }

    public function setFormat(int $format): void {
        $this->format = $format;
    }

    public function getWeight(): int {
        return $this->weight;
    }

    public function setWeight(int $weight): void {
        $this->weight = $weight;
    }
}
