<?php

namespace Adm\Models;

use Adm\Models\SQL\PRODUCT_SQL;
use Adm\Models\ValueObject\ProductVo;
use App\Catalog\Models\Helpers\Conn;
use App\Handlers\Product;
use Catalog\Models\Helpers\Read;
use Exception;

class ProductModel extends Conn
{
  private object $stmt;
  private object $conn;

  public function __construct()
  {
    $this->conn = $this->connectDb();
  }

  public function bindParams($filters)
  {
    // Vinculando os parâmetros
    foreach ($filters as $key => $value) {
      $this->stmt->bindValue(":" . $key, $value, is_int($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR); // Especifique o tipo do parâmetro
    }
  }

  public function product($id)
  {
    $loadView = new Read();
    $loadView->fullRead(PRODUCT_SQL::SELECT_PRODUCT(), "id=$id");

    return $loadView->getResult();
  }

  public function productList(int $page, array $filters)
  {
    $offset = ($page - 1) * ITEMS_PAGE;

    $this->stmt = $this->conn->prepare(PRODUCT_SQL::SELECT_ALL_PRODUCT($filters, $offset));

    // Vincular os parâmetros, independentemente de $filters estar vazio ou não
    $this->bindParams($filters);

    // var_dump(PRODUCT_SQL::SELECT_ALL_PRODUCT($filters, $offset));

    $this->stmt->execute();

    return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function productListTotal(array $filters)
  {
    $this->stmt = $this->conn->prepare(PRODUCT_SQL::COUNT_ALL_PRODUCT($filters));

    $this->bindParams($filters);

    // var_dump(PRODUCT_SQL::COUNT_ALL_PRODUCT($filters));

    $this->stmt->execute();

    return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function category()
  {
    $loadView = new Read();
    $loadView->fullRead(PRODUCT_SQL::ALL_CATEGORY(), "status=1");

    return $loadView->getResult();
  }

  public function createProductModel(ProductVo $vo)
  {

    $this->stmt = $this->conn->prepare(PRODUCT_SQL::INSERT_PRODUCT());
    $i = 1;
    $this->stmt->bindValue($i++, $vo->getName());
    $this->stmt->bindValue($i++, $vo->getQuantity());
    $this->stmt->bindValue($i++, $vo->getPrice());
    $this->stmt->bindValue($i++, $vo->getDescription());
    $this->stmt->bindValue($i++, ($vo->getStatus() == '1' ? 1 : 0), \PDO::PARAM_INT);
    $this->stmt->bindValue($i++, $vo->getUseMode());
    $this->stmt->bindValue($i++, ($vo->getHighlight() == '1' ? 1 : 0), \PDO::PARAM_INT);
    $this->stmt->bindValue($i++, $vo->getMeasure());
    $this->stmt->bindValue($i++, $vo->getDiscount());
    $this->stmt->bindValue($i++, $vo->getCategoryId());

    try {
      $this->stmt->execute();

      return $this->conn->lastInsertId();
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  public function updateProductModel(ProductVo $vo): bool
  {

    $this->stmt = $this->conn->prepare(PRODUCT_SQL::UPDATE_PRODUCT());
    $i = 1;
    $this->stmt->bindValue($i++, $vo->getName());
    $this->stmt->bindValue($i++, $vo->getQuantity());
    $this->stmt->bindValue($i++, $vo->getPrice());
    $this->stmt->bindValue($i++, $vo->getUseMode());
    $this->stmt->bindValue($i++, $vo->getDescription());
    $this->stmt->bindValue($i++, ($vo->getStatus() == '1' ? 1 : 0), \PDO::PARAM_INT);
    $this->stmt->bindValue($i++, ($vo->getHighlight() == '1' ? 1 : 0), \PDO::PARAM_INT);
    $this->stmt->bindValue($i++, $vo->getMeasure());
    $this->stmt->bindValue($i++, $vo->getDiscount());
    $this->stmt->bindValue($i++, $vo->getCategoryId());
    $this->stmt->bindValue($i++, $vo->getId());

    try {

      $this->stmt->execute();
      return true;
    } catch (Exception $e) {
      return false;
    }
  }

  public function updateProductDeliveryModel(ProductVo $vo): bool
  {

    $this->stmt = $this->conn->prepare(PRODUCT_SQL::UPDATE_PRODUCT_DELIVERY());
    $i = 1;
    $this->stmt->bindValue($i++, $vo->getHeight());
    $this->stmt->bindValue($i++, $vo->getWidth());
    $this->stmt->bindValue($i++, $vo->getLength());
    $this->stmt->bindValue($i++, $vo->getDiameter());
    $this->stmt->bindValue($i++, $vo->getFormat());
    $this->stmt->bindValue($i++, $vo->getWeight());
    $this->stmt->bindValue($i++, $vo->getId());

    try {

      $this->stmt->execute();
      return true;
    } catch (Exception $e) {
      return false;
    }
  }

  public function deleteImgProductModel($img)
  {

    $this->stmt = $this->conn->prepare(PRODUCT_SQL::DELETE_IMG($img));
    try {
      // Executar a consulta preparada para cada valor em $img
      foreach ($img as $key => $item) {
        $this->stmt->bindValue(($key + 1), $item, \PDO::PARAM_STR);
      }
      $this->stmt->execute();
      return true;
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  public function selectImgProduct($id)
  {
    $this->stmt = $this->conn->prepare(PRODUCT_SQL::SELECT_IMGS_PRODUCT());
    try {

      $this->stmt->bindValue(1, $id, \PDO::PARAM_INT);

      $this->stmt->execute();
      return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  public function selectNameProductCateg($id)
  {
    $this->stmt = $this->conn->prepare(PRODUCT_SQL::SELECT_NAME_PRODUCT_CATEGORY());
    $this->stmt->bindValue(1, $id, \PDO::PARAM_INT);

    $this->stmt->execute();
    return $this->stmt->fetch(\PDO::FETCH_ASSOC);
  }

  public function insertImgs($name, $product_id, $path)  {
    $this->stmt = $this->conn->prepare(PRODUCT_SQL::INSERT_IMG());
    $this->stmt->bindValue(1, $name, \PDO::PARAM_STR);
    $this->stmt->bindValue(2, $product_id, \PDO::PARAM_INT);
    $this->stmt->bindValue(3, $path, \PDO::PARAM_STR);
    try {

      $this->stmt->execute();
      return true;
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }
}
