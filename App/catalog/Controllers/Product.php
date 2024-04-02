<?php

namespace Catalog\Controllers;

use Core\ConfigView;
use Catalog\Util\Util;
use Catalog\Models\CommentModel;
use Catalog\Models\ProductModel;
use Catalog\Models\ValueObjects\CommentsOv;

class Product
{

  private array $data;

  public function item(string | null $param = null)
  {
    if (empty($param)) {
      header("Location: " . URL . "login");
    }
    $loadPage = new ProductModel();
    $this->data = $loadPage->index($param);

    if (!empty($this->data['product'])) {

      $this->data['product'][0]['images']['img_name'] =  explode(",", $this->data['product'][0]['img_name']);
      $this->data['product'][0]['images']['path'] = explode(",", $this->data['product'][0]['path']);
      if (!empty($this->data['product'][0]['discount'])) {
        
        $this->data['product'][0]['with_discount'] = Util::calculateDiscount($this->data['product'][0]['price'], $this->data['product'][0]['discount']);

      }

      if(!empty($this->data['product'][0]['description']))
      {
        $this->data['product'][0]['description'] = Util::formatDescricaoProduto($this->data['product'][0]['description']);
      }
    } else {

      header("Location: " . URL . "home");
    }
    if (!empty($this->data['related'])) {
      for ($i = 0; $i < count($this->data['related']); $i++) {

        $this->data['related'][$i]['name_link'] = Util::clearUrl($this->data['related'][$i]['product_name']);
        if ($this->data['related'][$i]['discount'] !== NULL) {
          // Calcula e atribui o desconto para 'related'
          $this->data['related'][$i]['with_discount'] = Util::calculateDiscount($this->data['related'][$i]['price'], $this->data['related'][$i]['discount']);
        }
      }
    }
    $loadView = new ConfigView("Catalog/views/product", $this->data);

    $loadView->loadViewCatalog();
  }

  public function insertComment()
  {
    $data = file_get_contents("php://input");

    $this->data = json_decode($data, true);

    if(!empty($this->data))
    {
      $comment = new CommentsOv();

      $comment->setComment($this->data['comment']);
      $comment->setProduct_id($this->data['product_id']);
      
      $model = new CommentModel();
      $ret = $model->insertComment($comment);
      
      echo json_encode($ret, true);
      
    }
  }

  public function selectComments()
  {
    $data = file_get_contents("php://input");

    $this->data = json_decode($data, true);
    $comment = new CommentsOv();
    $comment->setProduct_id($this->data['product_id']);

    $model = new CommentModel();
    $ret = $model->selectComments($comment);
    echo json_encode($ret, true);
  }
}
