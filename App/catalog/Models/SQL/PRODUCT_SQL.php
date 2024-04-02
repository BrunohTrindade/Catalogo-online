<?php

namespace Catalog\Models\SQL;

class PRODUCT_SQL
{

  public static function SELECT_PRODUCTS_HIGHLIGHT(): string
  {
    $sql = "SELECT p.id as p_id, 
                   p.name as product_name, 
                   price, 
                   discount, 
                   img.name as image_name, 
                   img.path 
              FROM product as p
        INNER JOIN img on p.id = img.product_id  
             WHERE status=:status 
               AND highlight=:highlight 
          ORDER BY RAND() 
             LIMIT :limit";

    return $sql;
  }

  public static function SELECT_ALL_PRODUCTS($offset): string
  {
    $sql = "SELECT p.id AS p_id, 
                   p.name, 
                   p.price, 
                   p.discount, 
                   img.name AS img_name, 
                   img.path
              FROM product AS p 
        INNER JOIN img ON p.id = img.product_id  
             WHERE status = :status
          GROUP BY img.name, 
                   img.product_id, 
                   img.path
             LIMIT ". ITEMS_PAGE . " OFFSET ". $offset;

    return $sql;
  }

  public static function SELECT_COUNT_ALL_PRODUCTS(): string
  {
    return "SELECT count(*) as total
              FROM product AS p 
        INNER JOIN img ON p.id = img.product_id  
             WHERE status = :status";
  }

  public static function SELECT_SEARCH_PRODUCT($offset): string
  {
    $sql = "SELECT p.id AS p_id, p.name, p.price, p.discount, 
                   img.name AS img_name, img.path
              FROM product AS p 
        INNER JOIN (
            SELECT product_id, name, path
              FROM (
            SELECT product_id, name, path, ROW_NUMBER() 
              OVER (PARTITION BY product_id ORDER BY RAND()) AS rn
              FROM img) AS img_rn
              WHERE rn = 1) AS img 
                 ON p.id = img.product_id  
              WHERE status = :status 
                AND p.name LIKE :name
              LIMIT " . ITEMS_PAGE . " OFFSET " . $offset;

    return $sql;
  }

  public static function SELECT_PRODUCTS_CATEGORY($offset): string
  {
    $sql = "SELECT p.id AS p_id, 
                   p.name, 
                   price, 
                   discount, 
                   MIN(img.name) AS img_name, 
                   MIN(path) AS path, 
                   c.name AS category_name
              FROM product AS p 
        INNER JOIN img ON p.id = img.product_id
        INNER JOIN category AS c
                ON p.category_id = c.id
             WHERE p.status= :status  AND c.id = :category_id
          GROUP BY p.id, 
                   p.name, 
                   p.price, p.discount
            ORDER BY RAND() LIMIT ". ITEMS_PAGE . " OFFSET " . $offset;

    return $sql;
  }

  public static function SELECT_PRODUCT(): string
  {
    $sql = "SELECT p.id as id_p, 
                   p.name as product_name, 
                   p.quantity, p.price, 
                   p.category_id, 
                   p.description, 
                   p.discount,
                   category.name as category_name,
                   GROUP_CONCAT(img.name) as img_name,
                   GROUP_CONCAT(img.path) as path
              FROM 
                  product as p
              LEFT JOIN 
                  img ON p.id = img.product_id
              INNER JOIN 
                  category on p.category_id = category.id
              WHERE 
                  p.id = :id
              GROUP BY 
              p.id, p.name, p.quantity, p.price, p.category_id, p.description, p.discount, category.name
               LIMIT :limit";

    return $sql;
  }

  public static function SELECT_PRODUCT_RELATED(): string
  {
    $sql = "SELECT p.id AS id_p, 
                   p.name AS product_name, 
                   p.price, 
                   p.discount,
                   MIN(img.name) AS img_name,
                   MIN(img.path) AS path
              FROM product AS p 
        INNER JOIN category AS id_c 
                ON p.category_id = id_c.id
        INNER JOIN img AS img 
                ON img.product_id = p.id                       
             WHERE p.category_id = :category_id
          GROUP BY p.id, p.name, p.price, p.discount
            LIMIT :limit";

    return $sql;
  }

  public static function COUNT_ITEMS_SEARCH(): string
  {
    return "SELECT COUNT(*) AS total
              FROM product AS p 
        INNER JOIN (
            SELECT product_id, name, path
              FROM (
            SELECT product_id, name, path, ROW_NUMBER() 
              OVER (PARTITION BY product_id ORDER BY RAND()) AS rn
              FROM img) AS img_rn
             WHERE rn = 1) AS img 
                ON p.id = img.product_id  
             WHERE status = :status 
               AND p.name LIKE :name";
  }

  public static function SELECT_ALL_CATEGORY(): string
  {
    return "SELECT c.name as category_name, c.id 
              FROM category AS c 
        INNER JOIN product ON product.category_id = c.id 
               AND product.status = :status
          GROUP BY c.id";
  }


  public static function COUNT_PRODUCTS_CATEGORY(): string
  {
    return "SELECT count(*) as total
              FROM product AS p 
        INNER JOIN category AS c
                ON p.category_id = c.id
             WHERE p.status= :status  AND c.id = :category_id";
  }
}
