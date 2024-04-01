<?php

namespace Catalog\Util;

class Util
{
  private string $message;

  public static function columnsTable(): array
  {

    $columns = [
      'products' => [
        'id_p',
        'product_name',
        'price',
        'discount',
        'highlight',
        'status',
        'category_name'
      ],
      'category' => [
        'category_id',
        'name',
        'status'
      ]
    ];
    return $columns;
  }

  public static function clearUrl($url): string
  {
    // Elimina as tags
    $url = strip_tags($url);
    // Elimina espaços em branco
    $url = trim($url);
    //Eliminar Barra no final da URL
    $url = rtrim($url, "/");

    //Eliminar caracteres indesejaveis
    $format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
    $format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr-------------------------------------------------------------------------------------------------';

    $url = strtr(
      mb_convert_encoding($url, 'ISO-8859-1'),
      mb_convert_encoding($format['a'], 'ISO-8859-1', 'UTF-8'),
      mb_convert_encoding($format['b'], 'ISO-8859-1', 'UTF-8')
    );
    return self::slugUrlName($url);
  }

  public static function calculateDiscount(float $price, int $discount)
  {
    $calculate = $price * ($discount / 100); // Convertendo a porcentagem para decimal

    $result = $price - $calculate;

    // Formata o resultado com a quantidade exata de casas decimais
    $result = sprintf("%." . '2' . "f", $result);

    return $result;
  }

  public static function slugUrlName($url): string
  {
    //Converter para minusculo e remove os espaços do inicio e final
    $url = trim(strtolower($url));
    //Converter o espaco em braco para traço
    $url = str_replace(" ", "-", $url);
    $url = str_replace("%", "-", $url);
    //Converter a primeira letra de cada palavra para maiusculo
    $url = ucwords($url);
    
    return $url;
  }

  public static function limitedWords($n, $text): string
  {
    $string = explode(" ", $text);
    $slice = array_slice($string, 0, $n);
    $string = implode(' ', $slice);
    return $string . " ...";
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

  public static function getIdString($string)
  {
     // Remova caracteres não numéricos e obtenha os números no final da string
     preg_match_all('/\d+/', $string, $matches);
    
     // Verifique se há pelo menos um número encontrado
     if (!empty($matches[0])) {
         // Retorna o último número encontrado
         return end($matches[0]);
     } else {
         // Se nenhum número foi encontrado, retorna uma string vazia
         return "";
     }
  }

  public static function slugString($palavra): string|int
  {

    $especiais = array(".", ",", ";", "!", "@", "#", "%", "¨", "*", "(", ")", "+", "/", "?", "[", "]", "{", "}", "'", "&", "´", "`", "~", "^", "$", " ", "-", ":", "|", "¬", "º", "ª", "§", "//", "\\", "<", ">");
    $palavra = strip_tags($palavra);
    $palavra = str_replace($especiais, "", trim($palavra));

    return $palavra;
  }

  public static function passGenerate() : string {
    
    $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $pass = '';
    for($i = 0; $i <= 8; $i++)
    {
      $pass .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }

    return $pass;
  }

  public static function paginate($totalItems, $perPage = 10, $url = '', $currentPage = 1)
{
    // Calcula o número total de páginas com base no número total de itens e no número de itens por página
    $totalPages = ceil($totalItems / $perPage);

    // Gera o HTML dos links de paginação
    $paginationHtml = '<ul>';

    // Link para a página anterior
    if ($currentPage > 1) {
        $paginationHtml .= '<li><a href="' . $url . 'page=' . ($currentPage - 1) . '">&lt;</a></li>';
    }

    // Links para as páginas
    for ($i = 1; $i <= $totalPages; $i++) {
        $paginationHtml .= '<li class="' . ($i == $currentPage ? 'active' : '') . '"><a href="' . $url . 'page=' . $i . '">' . $i . '</a></li>';
    }

    // Link para a próxima página
    if ($currentPage < $totalPages) {
        $paginationHtml .= '<li><a href="' . $url . 'page=' . ($currentPage + 1) . '">&gt;</a></li>';
    }

    $paginationHtml .= '</ul>';

    return $paginationHtml;
}

}

