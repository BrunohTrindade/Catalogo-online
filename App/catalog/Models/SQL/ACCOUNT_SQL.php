<?php

namespace Catalog\Models\SQL;

class ACCOUNT_SQL
{

  public static function INSERT_NEWUSER(): string
  {
    $sql = "INSERT INTO user 
            (name, email, cell, cpf, pass, type, created) 
            VALUES
            (:name, :email, :cell, :cpf, :pass, :type, NOW())";
    return $sql;
  }

  public static function SELECT_ALL_ACCOUNT(): string
  {
    $sql = "SELECT id, name, email, cell, cpf, pass, type FROM user WHERE email = ?";

    return $sql;
  }

  public static function SELECT_ACCOUNT(): string
  {
    $sql = "SELECT id, name, email FROM user WHERE email = ?";

    return $sql;
  }
  
  public static function UPDATE_ACCOUNT(): string
  {
    $sql = "UPDATE user SET name = :name, cell = :cell, cpf = :cpf, modified = :date WHERE id = :id";

    return $sql;
  }

  public static function INSERT_ADDRESS(): string
  {

    $sql = "INSERT INTO address (user_id, city_id, street, neighborhood, cep, number, complement, name)
            VALUES (:user_id, :city_id, :street, :neighborhood, :cep, :number, :complement, :name)";

    return $sql;
  }

  public static function UPDATE_ADDRESS(): string
  {
    $sql = "UPDATE address SET 
            city_id = ?,
            street = ?,
            neighborhood = ?,
            cep = ?,
            number = ?,
            complement = ?,
            name = ?
            WHERE id = ?";
    return $sql;
  }

  public static function VERIFY_CITY(): string
  {
    $sql = "SELECT city.id as city_id 
            FROM city 
            INNER JOIN state ON state.id = city.state_id
            WHERE city = :city
            AND state = :state";

    return $sql;
  }

  public static function INSERT_CITY(): string
  {
    $sql = "INSERT INTO city (city, state_id) VALUES (:city, :state_id)";

    return $sql;
  }

  public static function VERIFY_STATE(): string
  {
    $sql = "SELECT id FROM state WHERE state = :state";

    return $sql;
  }

  public static function INSERT_STATE(): string
  {
    $sql = "INSERT INTO state (state) VALUES (:state)";
    return $sql;
  }

  public static function SELECT_ADDRESS(): string
  {

    $sql = "SELECT Ad.id as address_id, user_id, street, neighborhood, cep, number, complement, ad.name,
    city, state_id, ci.id as city_id, state
    FROM address AS ad
    INNER JOIN user ON ad.user_id = user.id
    INNER JOIN city AS ci ON ci.id = ad.city_id
    INNER JOIN state ON state.id = ci.state_id
    WHERE user.id = :user_id";

    return $sql;
  }

  public static function SELECT_ADDRESS_ID(): string
  {

    $sql = "SELECT ad.id as address_id, user_id, street, neighborhood, cep, number, complement, ad.name,
    city, state_id, ci.id as city_id, state
    FROM address AS ad
    INNER JOIN user ON ad.user_id = user.id
    INNER JOIN city AS ci ON ci.id = ad.city_id
    INNER JOIN state ON state.id = ci.state_id
    WHERE ad.id = :id";

    return $sql;
  }

  public static function SELECT_CREDITS_CARD(): string
  {
    return 0;
  }

  public static function UPDATE_PASSWORD(): string
  {
    return "UPDATE user SET pass = ? WHERE id = ?";
  }
}
