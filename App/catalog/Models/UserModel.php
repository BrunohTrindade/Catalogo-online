<?php

namespace Catalog\Models;

use App\Catalog\Models\Helpers\Conn;
use Catalog\Models\SQL\ACCOUNT_SQL;
use Catalog\Models\ValueObjects\UserOv;
use Exception;

class UserModel extends Conn
{

  private array|null $data;
  private object $conn;
  private object $stmt;

  public function insertNewUser(UserOv $newUserOv)
  {

    $this->conn = $this->connectDb();

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

      return $e;
    }
  }

 
}
