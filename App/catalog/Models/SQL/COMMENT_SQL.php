<?php

namespace Catalog\Models\SQL;

class COMMENT_SQL
{

  public static function SELECT_COMMENT(): string
  {
    $sql = "SELECT stars, comment, rating.created,
            user.name,
           (SELECT count(*) FROM rating WHERE product_id = :id) AS total_comment
            FROM rating 
            INNER JOIN product ON product_id = product.id
            INNER JOIN user ON user_id = user.id
            WHERE product_id = :product_id";

    return $sql;
  }

  public static function INSERT_COMMENT(): string
  {
    $sql = "INSERT INTO rating set comment = ?, product_id = ?, user_id = ?, created = NOW()";

    return $sql;
    
  }

  public static function AVERAGE_STARS(): string
  {
    $sql = "SELECT 
              ROUND(AVG(stars), 1) AS average_stars
            FROM  rating 
            INNER JOIN 
              product ON rating.product_id = product.id
            WHERE 
              product_id = :product_id";
    
    return $sql;
  }
}
