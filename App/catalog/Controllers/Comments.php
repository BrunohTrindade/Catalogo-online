<?php

namespace Catalog\Controllers;

use Catalog\Models\CommentModel;
use Catalog\Models\ValueObjects\CommentsOv;

class Comments{

  private array|null $data;

  public function index()
  {
    $data = file_get_contents("php://input");

    $this->data = json_decode($data, true);

    if(!empty($this->data))
    {
      $comment = new CommentsOv();

      $comment->setComment($this->data['comment']);
      $comment->setStar($this->data['star']);
      $comment->setProduct_id($this->data['product_id']);

      $model = new CommentModel();
      $ret = $model->insertComment($comment);
      
      echo json_encode($ret, true);
      
    }
  }
}