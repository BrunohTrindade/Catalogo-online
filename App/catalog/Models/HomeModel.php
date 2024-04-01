<?php

namespace Catalog\Models;

use Catalog\Models\Helpers\Read;
use Catalog\Models\SQL\PRODUCT_SQL;

class HomeModel
{
  private array | null $data;

  public function  index()
  {

    $loadView = new Read;

    // $loadView->exeRead("p.id as p_id, nome_p, preco, desconto, name_img ","produtos as p", " INNER JOIN img on p.id = img.id WHERE situacao_p=:situacao_p AND destaque=:destaque LIMIT :limit", "situacao_p=1&destaque=1&limit=8");

    $loadView->fullRead(PRODUCT_SQL::SELECT_PRODUCTS_HIGHLIGHT(), "status=1&highlight=1&limit=8");
    $this->data = $loadView->getResult();
    return $this->data;
  }
}
