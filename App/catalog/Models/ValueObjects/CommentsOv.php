<?php

namespace Catalog\Models\ValueObjects;

class CommentsOv
{
  private string | int $comment;
  private int $star;
  private int $product_id;

  public function setComment(string | int $comment)
  {
    $this->comment = strip_tags($comment);
  }

  public function getCommet(): string | int
  {
    return $this->comment;
  }

  public function setStar(int $star)
  {
    $this->star = strip_tags($star);
  }

  public function getStar(): int
  {
    return $this->star;
  }

  public function setProduct_id(int $product_id)
  {
    $this->product_id = strip_tags($product_id);
  }

  public function getProduct_id(): int
  {
    return $this->product_id;
  }
}
