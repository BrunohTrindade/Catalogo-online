<?php

namespace Adm\Models\SQL;

class PRODUCT_SQL
{

  public function columnsTable(): array
  {

    $columns = [
      'products' => [
        'id_p',
        'name',
        'product_name',
        'price',
        'discount',
        'highlight',
        'status',
        'category_name'
      ],
      'category' => [
        'category_id'
      ]
    ];
    return $columns;
  }

  public static function SELECT_IMGS_PRODUCT(): string
  {
    $sql = "SELECT path, name FROM img WHERE product_id = ?";
    return $sql;
  }

  public static function SELECT_PRODUCT(): string
  {
    $sql = "SELECT p.id as id_p, 
                  p.name as product_name, 
                  p.quantity, 
                  p.price, 
                  p.category_id, 
                  p.description, 
                  p.discount,
                  p.measure,
                  p.use_mode,
                  p.highlight,
                  p.status,
                  category.name as category_name,
                  GROUP_CONCAT(img.name) as img_name,
                  MAX(img.path) as path,
                  p.height,
                  p.width,
                  p.length,
                  p.diameter,
                  p.format,
                  p.weight
                  FROM 
                      product as p
                  LEFT JOIN 
                      img ON p.id = img.product_id
                  INNER JOIN 
                      category on p.category_id = category.id
                  WHERE 
                      p.id = :id
                  GROUP BY 
                  p.id, p.name, p.quantity, p.price, p.category_id, p.description, p.discount, category.name";

    return $sql;
  }

  public static function SELECT_ALL_PRODUCT($filters, $offset): string
  {
    $sql = "SELECT 
                p.id as id_p, 
                p.name as product_name,
                p.price,
                p.discount,
                p.highlight,
                p.status,
                category.name as category_name
            FROM 
                product as p
            INNER JOIN 
                category on p.category_id = category.id";

    if (!empty($filters)) {
      $objeto = new self();
      $sql .= $objeto->filtersElements($filters);
    }

    $sql .= " LIMIT " . ITEMS_PAGE . " OFFSET " . $offset;
    return $sql;
  }

  public static function COUNT_ALL_PRODUCT($filters): string
  {
    $sql = "SELECT COUNT(*) as total
            FROM product as p
            INNER JOIN 
            category on p.category_id = category.id ";

    if (!empty($filters)) {
      $objeto = new self();
      $sql .= $objeto->filtersElements($filters);
    }

    return $sql;
  }

  public function filtersElements($filters)
  {

    $conditions = [];

    $objeto = new self();
    $columns = $objeto->columnsTable();
    $sql = "";
    foreach ($filters as $key => $value) {
      // Verifica se a chave do filtro corresponde a uma coluna da tabela
      $sql = " WHERE ";
      $paramKey = $key;
      if (in_array($key, $columns['products'])) {

        $paramKey = 'p.' . $key;

        if ($key == 'nome'){
          $sql .= 'LIKE ?';
        }
      }
      
  $conditions[] = "$paramKey = :$key";  
    }

    $sql .= implode(" AND ", $conditions);

    return $sql;
  }

  public static function ALL_CATEGORY(): string
  {
    $sql = "SELECT name, id FROM category WHERE status = :status";

    return $sql;
  }

  public static function INSERT_PRODUCT(): string
  {

    $sql = "INSERT INTO product 
                        (name, quantity, 
                        price, description, 
                        status, use_mode, 
                        highlight, measure, 
                        discount, category_id,
                        created)
                      VALUES
                       (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

    return $sql;
  }
  public static function INSERT_IMG(): string
  {
    $sql = "INSERT INTO img (name, product_id, path) VALUES (?, ?, ?)";

    return $sql;
  }

  public static function UPDATE_PRODUCT(): string
  {
    $sql = "UPDATE product  SET
                  name = ?, 
                  quantity = ?, 
                  price = ?, 
                  use_mode = ?,
                  description = ?,
                  status = ?,
                  highlight = ?,
                  measure = ?,
                  discount = ?,
                  category_id = ?,
                  modified = NOW()
            WHERE id = ?";

    return $sql;
  }

  public static function UPDATE_PRODUCT_DELIVERY(): string
  {
    $sql = "UPDATE product  SET
                  height = ?,
                  width = ?,
                  length = ?,
                  diameter = ?,
                  format = ?,
                  weight = ?,
                  modified = NOW()
            WHERE id = ?";

    return $sql;
  }

  public static function DELETE_IMG($img): string
  {
    $placeholders = rtrim(str_repeat('?,', count($img)), ',');

    $sql = "DELETE FROM img WHERE name IN ($placeholders)";

    return $sql;
  }

  public static function SELECT_NAME_PRODUCT_CATEGORY(): string
  {
    $sql = "SELECT p.id as product_id, 
                SUBSTRING_INDEX(p.name, ' ', 1) AS first_word_product_name, 
                c.id as category_id,
                SUBSTRING_INDEX(c.name, ' ', 1) AS first_word_category_name
            FROM product AS p
            INNER JOIN category AS c ON c.id = p.category_id
            WHERE p.id = ?";

    return $sql;
  }
}
