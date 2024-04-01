<?php

namespace Adm\Models\SQL;

use Adm\Util\Util;

class CATEGORY_SQL
{
  public function columnsTable(): array
  {

    $columns = [
      'category' => [
        'id',
        'name',
        'status'
      ]
    ];
    return $columns;
  }

  public static function SELECT_CATEGORY(): string
  {
    return "SELECT * FROM category WHERE id = ?";
  }

  public static function SELECT_ALL_CATEGORY($filters, $offset)
  {
    $sql = "SELECT * FROM category";

    if (!empty($filters)) {
      $objeto = new self();
      $sql .= $objeto->filtersElements($filters);
    }

    $sql .= " LIMIT " . ITEMS_PAGE . " OFFSET " . $offset;
    return $sql;
  }

  public static function COUNT_ALL_CATEGORY($filters): string
  {
    $sql = "SELECT COUNT(*) as total FROM category";

    if (!empty($filters)) {
      $objeto = new self();
      $sql .= $objeto->filtersElements($filters);
    };
    return $sql;
  }

  public static function filtersElements($filters)
  {
    $sql = " WHERE ";
    $conditions = [];
    foreach ($filters as $key => $value) {
      $columns = Util::columnsTable();
      if (in_array($key, $columns['category'])) {
        $conditions[] = ":$key = $key";
      }
    }
    $sql .= implode(" AND ", $conditions);
    return $sql;
  }

  public static function INSERT_CATEGORY(): string
  {
    return "INSERT INTO category (name, description, status) VALUES (?,?,?)";
  }

  public static function UPDATE_CATEGORY(): string
  {
    return "UPDATE category SET name = ?, description = ?, status = ? WHERE id = ?";
  }
}
