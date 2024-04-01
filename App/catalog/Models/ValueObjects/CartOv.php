<?php 

namespace Catalog\Models\ValueObjects;

class CartOv extends OrderOv
{
  private int $cart_id;
  private int $product_id;
  private int $qty;
  private float $price;

  public function setCartId(int $id) : void {
    $this->cart_id = $id;
  }

  public function getCartId() : int {
    return $this->cart_id;
  }

  public function setProductId(int $id) : void {
    $this->product_id = $id;
  }

  public function getProductId() : int {
    return $this->product_id;
  }

  public function setQty(int $qty) : void {
    $this->qty = $qty;
  }

  public function getQty() : int {
    return $this->qty;
  }

  public function setPrice(int $price) : void {
    $this->price = $price;
  }

  public function getPrice() : int {
    return $this->price;
  }


}