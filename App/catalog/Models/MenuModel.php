<?php

namespace Catalog\Models;

use Catalog\Models\Helpers\Read;

class MenuModel{

  private array $data;

  public function menuCategory()
  {
    $loadView = new Read;
    $loadView->fullRead("SELECT c.name, c.id  as id_c
    FROM category AS c 
    INNER JOIN product ON product.category_id = c.id AND product.status = :status
    GROUP BY c.id LIMIT :limit", "status=1&limit=50");

    $this->data = $loadView->getResult();
    return $this->data;
  }
}