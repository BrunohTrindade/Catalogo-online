<?php

namespace Adm\Util;

class Util
{
  public static function columnsTable(): array
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
        'category_name',
        'category_id'
      ],
      'category' =>[
        'id_c',
        'status'
      ]
    ];
    return $columns;
  }

  public static function  formatDescricaoProduto($descricao): string
  {
    // Converte as quebras de linha para <br>
    $descricao_formatada = nl2br($descricao);

    // Remove explicitamente \r\n, \r, e \n
    $descricao_formatada = str_replace(["\\r\\n", "\\r", "\\n", "'", "\\"], '', $descricao_formatada);

    // Remove espaços extras
    $descricao_formatada = trim($descricao_formatada);

    return $descricao_formatada;
  }

  public static function calculateDiscount(float $price, int $discount)
  {
    $calculate = $price * ($discount / 100); // Convertendo a porcentagem para decimal

    $result = $price - $calculate;

    // Formata o resultado com a quantidade exata de casas decimais
    $result = sprintf("%." . '2' . "f", $result);

    return $result;
  }

  public static function limitedWords($n, $text): string
  {
    $string = explode(" ", $text);
    $slice = array_slice($string, 0, $n);
    $string = implode(' ', $slice);
    return $string . " ...";
  }


  public static function setDefaultTime(): void
  {
    date_default_timezone_set('America/Sao_Paulo');
  }

  public static function getDate(): string
  {
    self::setDefaultTime();
    return date('Y-m-d');
  }

  public static function setMessage($msg, $status)
  {
    $_SESSION['msg'] =  "<span style='color: $status'> " . $msg;
  }

  public static function paginate($totalItems, $perPage = 10, $url = '',$currentPage = 1)
  {
    // Calcula o número total de páginas com base no número total de itens e no número de itens por página
    $totalPages = ceil($totalItems / $perPage);

    // Gera o HTML dos links de paginação
    $paginationHtml = '<ul class="pagination">';
    // Link para a página anterior
    if ($currentPage > 1) {
      $paginationHtml .= '<li class="page-item"><a class="page-link" href="' . $url . 'page=' . ($currentPage - 1) . '">&laquo;</a></li>';
    }
    // Links para as páginas
    for ($i = 1; $i <= $totalPages; $i++) {
      $paginationHtml .= '<li class="page-item ' . ($i == $currentPage ? 'active' : '') . '"><a class="page-link" href="' . $url . 'page=' . $i . '">' . $i . '</a></li>';
    }
    // Link para a próxima página
    if ($currentPage < $totalPages) {
      $paginationHtml .= '<li class="page-item"><a class="page-link" href="' . $url . 'page=' . ($currentPage + 1) . '">&raquo;</a></li>';
    }
    $paginationHtml .= '</ul>';
    return $paginationHtml;
  }
}
