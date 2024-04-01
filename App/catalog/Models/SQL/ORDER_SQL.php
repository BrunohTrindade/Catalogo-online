<?php

namespace Catalog\Models\SQL;

class ORDER_SQL
{
  /**
   * SELECT_ORDER_PRODUCTS
   * 
   */
  
  
  public static function INSERT_ORDER(): string
  {
    $sql = "INSERT INTO `order` (status, created, user_id) VALUES (?,?,?)";

    return $sql;
  }

  public static function SELECT_ORDER_PRODUCTS(): string
  {
    $sql = "SELECT id FROM `order` WHERE user_id = ?";
    return $sql;
  }

  public static function DELETE_PRODUCT_CART() : string {
   return "DELETE FROM order_products WHERE product_id = ?";
  }

  public static function UPDATE_PRODUCT_CART() : string {
    return "UPDATE order_products SET quantity = ? WHERE product_id = ?";
  }

  public static function INSERT_PRODUCT_CART(): string
  {
    $sql = "INSERT INTO order_products (order_id, product_id, quantity, price) VALUES (?,?,?,?)";
    return $sql;
  }

  public static function SELECT_PRODUCT_CART(): string
  {
    $sql = "SELECT      
                product.id AS id_p, 
                product.name, 
                product.price AS price_p, 
                product.discount, 
                MIN(img.name) AS img_name,
                IFNULL(SUM(op.quantity), 0) AS qty,
                img.path
            FROM 
                product 
            INNER JOIN 
                (SELECT product_id, MIN(name) AS name, path FROM img GROUP BY product_id, path) AS img ON img.product_id = product.id
            LEFT JOIN 
                order_products AS op ON op.product_id = product.id
            LEFT JOIN 
                `order` ON `order`.id = op.order_id 
            WHERE
                `order`.user_id = ?
            GROUP BY 
                product.id, img.path";

    return $sql;
  }

  public static function SELECT_VERIFY_PRODUCT_CARD():string
  {
    return " SELECT product_id 
               FROM order_products 
         INNER JOIN `order` ON `order`.id = order_products.order_id
               WHERE product_id = ? 
                 AND order_id = ?";
  }

  public static function COUNT_PRODUCTS_CART() : string {

    return "SELECT COUNT(*) AS total 
              FROM epp.order 
        INNER JOIN order_products 
                ON order_products.order_id = epp.order.id 
             WHERE epp.order.user_id = ?";
  }
}
