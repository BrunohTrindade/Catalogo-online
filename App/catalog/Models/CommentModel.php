<?php 

namespace Catalog\Models;

use App\Catalog\Models\Helpers\Conn;
use Catalog\Models\SQL\COMMENT_SQL;
use Catalog\Models\ValueObjects\CommentsOv;
use Exception;

class CommentModel extends Conn
{

  private object $conn;
  private object $stmt;

  public function __construct()
  {
    $this->conn = $this->connectDb();
  }

  public function insertComment(CommentsOv $comment)
  {
    $i = 1;
    $this->stmt = $this->conn->prepare(COMMENT_SQL::INSERT_COMMENT());
    $this->stmt->bindValue($i++, $comment->getCommet());
    $this->stmt->bindValue($i++, $comment->getProduct_id());
    $this->stmt->bindValue($i++, $_SESSION['id']);
    try{

      $this->stmt->execute();
      return true;
    }catch(Exception $e){
      return false;
    }
  }

  public function selectComments(CommentsOv $comment){
    $this->stmt = $this->conn->prepare(COMMENT_SQL::SELECT_COMMENT());
    $this->stmt->bindValue(":id", $comment->getProduct_id());
    $this->stmt->bindValue(":product_id", $comment->getProduct_id());
    $this->stmt->execute();

    return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);

  }
}
?>