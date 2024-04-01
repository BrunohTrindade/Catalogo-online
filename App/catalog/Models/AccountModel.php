<?php

namespace Catalog\Models;

use Exception;
use Catalog\Models\Helpers\Read;
use Catalog\Models\SQL\ACCOUNT_SQL;
use App\Catalog\Models\Helpers\Conn;
use Catalog\Models\ValueObjects\UserOv;
use Catalog\Util\Util;
use User\User;

class AccountModel extends Conn
{

  private array| null $data;
  private object $conn;
  private object $stmt;

  public function __construct()
  {
    $this->conn = $this->connectDb();
  }

  public function index($param)
  {

    $this->stmt = $this->conn->prepare(ACCOUNT_SQL::SELECT_ALL_ACCOUNT());
    $this->stmt->bindValue(1, $param);
    $this->stmt->execute();

    return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);   
  }

  public function address($id)
  {
    $this->stmt = $this->conn->prepare(ACCOUNT_SQL::SELECT_ADDRESS());
    $this->stmt->bindValue(":user_id", $id);
    $this->stmt->execute();

    return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function address_id($id)
  {
    $this->stmt = $this->conn->prepare(ACCOUNT_SQL::SELECT_ADDRESS_ID());
    $this->stmt->bindValue(":id", $id);
    $this->stmt->execute();

    return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
  }


  public function insertNewUser(UserOv $newUserOv): bool
  {

    $this->stmt = $this->conn->prepare(ACCOUNT_SQL::INSERT_NEWUSER());
    $this->stmt->bindValue(":name", $newUserOv->getNameUser());
    $this->stmt->bindValue(":email", $newUserOv->getEmailUser());
    $this->stmt->bindValue(":cell", $newUserOv->getCellUser());
    $this->stmt->bindValue(":cpf", $newUserOv->getCpfUser());
    $this->stmt->bindValue(":pass", $newUserOv->getPassUser());
    $this->stmt->bindValue(":type", $newUserOv->getTypeUser());

    try {
      $this->stmt->execute();
      return true;
    } catch (Exception $e) {
      // echo $e->getMessage();
      return false;
    }
  }

  public function updateUser(UserOv $user): bool
  {

    $this->stmt = $this->conn->prepare(ACCOUNT_SQL::UPDATE_ACCOUNT());
    $this->stmt->bindValue(":name", $user->getNameUser());
    $this->stmt->bindValue(":cell", $user->getCellUser());
    $this->stmt->bindValue(":cpf", $user->getCpfUser());
    $this->stmt->bindValue(":id", $user->getIdUser());
    $this->stmt->bindValue(":date", Util::getDate());

    try {
      $this->stmt->execute();
      return true;
    } catch (Exception $e) {
      // echo $e->getMessage();
      return false;
    }
  }

  public function insertAddress(UserOv $user)
  {

    $this->conn->beginTransaction();
    try {
      $this->stmt = $this->conn->prepare(ACCOUNT_SQL::VERIFY_CITY());
      $this->stmt->bindValue(":city", $user->getCityAddress());
      $this->stmt->bindValue(":state", $user->getStateAddress());
      $this->stmt->execute();

      $city = $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
      if (count($city) > 0) {
        $city_id = $city[0]['city_id'];
      } else {
        $this->stmt = $this->conn->prepare(ACCOUNT_SQL::VERIFY_STATE());
        $this->stmt->bindvalue(":state", $user->getStateAddress());
        $this->stmt->execute();

        $state = $this->stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (count($state) > 0) {
          $state_id = $state[0]['id'];
        } else {
          $this->stmt = $this->conn->prepare(ACCOUNT_SQL::INSERT_STATE());
          $this->stmt->bindValue(":state", $user->getStateAddress());
          $this->stmt->execute();
          $state_id = $this->conn->lastInsertId();
        }

        $this->stmt = $this->conn->prepare(ACCOUNT_SQL::INSERT_CITY());
        $this->stmt->bindValue(":city", $user->getCityAddress());
        $this->stmt->bindValue(":state_id", $state_id);
        $this->stmt->execute();

        $city_id = $this->conn->lastInsertId();
      }

      $this->stmt = $this->conn->prepare(ACCOUNT_SQL::INSERT_ADDRESS());
      $this->stmt->bindvalue(":user_id", $user->getIdUser());
      $this->stmt->bindvalue(":city_id", $city_id);
      $this->stmt->bindvalue(":street", $user->getStreetAddress());
      $this->stmt->bindvalue(":neighborhood", $user->getNeighborhoodAddress());
      $this->stmt->bindvalue(":cep", $user->getCepAddress());
      $this->stmt->bindvalue(":number", $user->getNumberAddress());
      $this->stmt->bindvalue(":complement", $user->getComplementAddress());
      $this->stmt->bindvalue(":name", $user->getNameAddress());

      $this->stmt->execute();

      $this->conn->commit();
      return true;
    } catch (Exception $e) {
      $this->conn->rollback();
      // return  $e->getMessage();
      return false;
    }
  }

  public function updateAddress(UserOv $user): bool
  {

    $this->conn->beginTransaction();
    try {

      $this->stmt = $this->conn->prepare(ACCOUNT_SQL::VERIFY_CITY());
      $this->stmt->bindValue(":city", $user->getCityAddress());
      $this->stmt->bindValue(":state", $user->getStateAddress());
      $this->stmt->execute();
      $city = $this->stmt->fetchAll(\PDO::FETCH_ASSOC);

      if (count($city) > 0) {
        $city_id = $city[0]['city_id'];
      } else {

        $this->stmt = $this->conn->prepare(ACCOUNT_SQL::VERIFY_STATE());
        $this->stmt->bindValue(":state", $user->getStateAddress());
        $this->stmt->execute();
        $state = $this->stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (count($state) > 0) {
          $state_id = $state[0]['id'];
        } else {
          $this->stmt = $this->conn->prepare(ACCOUNT_SQL::INSERT_STATE());
          $this->stmt->bindValue(":state", $user->getStateAddress());
          $this->stmt->execute();

          $state_id = $this->conn->lastInsertId();
        }

        $this->stmt = $this->conn->prepare(ACCOUNT_SQL::INSERT_CITY());
        $this->stmt->bindValue(":city", $user->getCityAddress());
        $this->stmt->bindValue(":state", $state_id);
        $this->stmt->execute();

        $city_id = $this->conn->lastInsertId();
      }
      $i = 1;
      $this->stmt = $this->conn->prepare(ACCOUNT_SQL::UPDATE_ADDRESS());
      $this->stmt->bindValue($i++, $city_id);
      $this->stmt->bindValue($i++, $user->getStreetAddress());
      $this->stmt->bindValue($i++, $user->getNeighborhoodAddress());
      $this->stmt->bindValue($i++, $user->getCepAddress());
      $this->stmt->bindValue($i++, $user->getNumberAddress());
      $this->stmt->bindValue($i++, $user->getComplementAddress());
      $this->stmt->bindValue($i++, $user->getNameAddress());
      $this->stmt->bindvalue($i++, $user->getIdAddress());
      $this->stmt->execute();

      $this->conn->commit();

      return true;
    } catch (Exception $e) {
      return false;
    }
  }

  public function verifyPass(UserOv $user)
  {

    $this->stmt = $this->conn->prepare(ACCOUNT_SQL::SELECT_ALL_ACCOUNT());
    $this->stmt->bindValue(1, $user->getEmailUser());
    $this->stmt->execute();

    $result = $this->stmt->fetch();

    return $result;
  }

  public function verifyEmail(UserOv $user): array | bool
  {
    $this->stmt = $this->conn->prepare(ACCOUNT_SQL::SELECT_ACCOUNT());
    $this->stmt->bindValue(1, $user->getEmailUser());
    $this->stmt->execute();
    if ($this->stmt->rowCount() > 0) {
      return $this->stmt->fetch();
    } else {
      return false;
    }
  }

  public function recoveryPassword(UserOv $user): bool
  {
    $this->stmt = $this->conn->prepare(ACCOUNT_SQL::UPDATE_PASSWORD());
    $this->stmt->bindValue(1, $user->getPassUser());
    $this->stmt->bindValue(2, $user->getIdUser());

    try {
      $this->stmt->execute();
      return true;
    } catch (Exception $e) {
      return false;
    }
  }
  private function exeInstruction()
  {
    try {
      $this->stmt->execute();
      return true;
    } catch (Exception $e) {
      return false;
      // return false;
    }
  }
}
