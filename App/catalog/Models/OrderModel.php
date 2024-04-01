<?php

namespace Catalog\Models;

use App\Catalog\Models\Helpers\Conn;
use Catalog\Models\SQL\ACCOUNT_SQL;
use Catalog\Models\SQL\ORDER_SQL;
use Catalog\Models\ValueObjects\CartOv;
use Catalog\Models\ValueObjects\OrderOv;
use Exception;

class OrderModel extends Conn
{

  private object $conn;
  private object $stmt;

  public function __construct() {
    $this->conn = $this->connectDb();
  }

  public function insertNewOrder(OrderOv $ov)
  {
    $this->stmt = $this->conn->prepare(ORDER_SQL::INSERT_ORDER());
    $this->stmt->bindValue(1, $ov->getStatusOrder());
    $this->stmt->bindValue(2, $ov->getDate());
    $this->stmt->bindValue(3, $ov->getUserId());

    try {
      $this->stmt->execute();

      return $this->conn->lastInsertId();
    } catch (Exception $e) {
      return false;
    }
  }

  public function insertProductCart(CartOv $ov)
  {
    $this->stmt = $this->conn->prepare(ORDER_SQL::INSERT_PRODUCT_CART());
    $this->stmt->bindValue(1, $ov->getOrderId());
    $this->stmt->bindValue(2, $ov->getProductId());
    $this->stmt->bindValue(3, $ov->getQty());
    $this->stmt->bindValue(4, $ov->getPrice());

    try {
      $this->stmt->execute();
      return true;
    } catch (Exception $e) {
      // return $e->getMessage();
      return false;
    }
  }

  public function verifyCart($user_id): bool | int |array
  {

    $this->stmt = $this->conn->prepare(ORDER_SQL::SELECT_ORDER_PRODUCTS());
    $this->stmt->bindValue(1, $user_id);

    $this->stmt->execute();

    if ($this->stmt->rowCount() > 0) {
      return $this->stmt->fetch()['id'] ?? null;
    } else {
      return false;
    }
  }

  public function selectProductsCart(int $user_id)
  {
    $this->stmt = $this->conn->prepare(ORDER_SQL::SELECT_PRODUCT_CART());
    $this->stmt->bindValue(1, $user_id);

    $this->stmt->execute();
    return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function countProductsCart(int $user_id) {
    $this->stmt = $this->conn->prepare(ORDER_SQL::COUNT_PRODUCTS_CART());
    $this->stmt->bindValue(1, $user_id);

    $this->stmt->execute();
    return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function deleteProductCart(int $product_id) : bool {
    $this->stmt = $this->conn->prepare(ORDER_SQL::DELETE_PRODUCT_CART());
    $this->stmt->bindValue(1, $product_id);

    try{
      $this->stmt->execute();
      return true;
    }catch(Exception $e)
    {
      return false;
    }
  }

  public function updateProductCart(int $product_id, int $qty) : bool {
    $this->stmt = $this->conn->prepare(ORDER_SQL::UPDATE_PRODUCT_CART());
    $this->stmt->bindValue(1, $qty);
    $this->stmt->bindValue(2, $product_id);

    try{
      $this->stmt->execute();
      return true;
    }catch(Exception $e)
    {
      return false;
    }
  }

  public function verifyProductCard(int $product_id, int $order_id) : bool {

    $this->stmt = $this->conn->prepare(ORDER_SQL::SELECT_VERIFY_PRODUCT_CARD());
    $this->stmt->bindValue(1, $product_id);
    $this->stmt->bindValue(2, $order_id);

    $this->stmt->execute();
    if($this->stmt->rowCount() > 0){
      return true;
    }else{
      return false;
    }
    
  }
}
