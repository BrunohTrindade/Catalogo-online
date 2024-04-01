<?php

namespace Catalog\Models;

use Catalog\Models\Helpers\Read;
use Catalog\Models\SQL\COMMENT_SQL;
use Catalog\Models\SQL\PRODUCT_SQL;

class ProductModel
{

  private array $data;
  private string $param;

  public function  index($param)
  {
    $this->param = $param;

    $loadView = new Read();

    $loadView->fullRead(PRODUCT_SQL::SELECT_PRODUCT(), "id={$this->param}&limit=1");
    $this->data['product'] = $loadView->getResult();

    $loadView->fullRead(PRODUCT_SQL::SELECT_PRODUCT_RELATED(), "category_id={$this->data['product'][0]['category_id']}&limit=8");
    $this->data['related'] = $loadView->getResult();

    $this->data['comment'] = $this->commentProduct();

    $this->data['average'] = $this->commentAverage();

    return $this->data;
  }

  private function commentProduct(): string | array | null
  {

    $loadView = new Read();
    $loadView->fullRead(COMMENT_SQL::SELECT_COMMENT(), "id={$this->param}&product_id={$this->param}");

    return $loadView->getResult();
  }

  private function commentAverage(): array | null{
    $loadView = new Read();

    $loadView->fullRead(COMMENT_SQL::AVERAGE_STARS(), "product_id=$this->param");
    return $loadView->getResult();
    
  }
}
