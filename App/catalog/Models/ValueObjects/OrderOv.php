<?php 

namespace Catalog\Models\ValueObjects;

use Catalog\Util\Util;

class OrderOv extends UserOv
{
  private int $order_id;
  private int $status;
  private int $address_id;

  public function setOrderId(int $id) : void {
    $this->order_id = $id;
  }

  public function getOrderId() : int {
    return $this->order_id;
  }

  public function setStatusOrder(int $status) : void {
    $this->status = $status;
  }

  public function getStatusOrder() : int {
    return $this->status;
  }

  public function getDate() : string {
    return Util::getDate();
  }

  public function setAddressId(int $address_id) : void {
    $this->address_id = $address_id;
  }

  public function getAddressId() : int {
    return $this->address_id;
  }

  public function setUserId(int $address_id) : void {
    $this->address_id = $address_id;
  }

  public function getUserId() : int {
    return $this->address_id;
  }
}