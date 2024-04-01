<?php

namespace Core;

/**
 * Recebe a URL e manipula
 * Carregar a CONTROLLER
 * 
 * @author Cesar <cesar@celke.com.br>
 */
class ConfigController extends Config
{
  /** @var string $url Recebe a URL do .htaccess */
  private string $url;
  /** @var array $urlArray Recebe a URL convertida para array */
  private array $urlArray;
  /** @var string $urlController Recebe da URL o nome da controller */
  private string $urlController;
  /** @var string $urlParamentro Recebe da URL o parâmetro */
  /*private string $urlParameter;*/
  private string $urlSlugController;
  /** @var array $format Recebe o array de caracteres especiais que devem ser substituido */
  private array $format;
  /** @var string $classe Recebe a classe */
  private string $classLoad;
  /** @var string $urlMetodo recebe a posição 2 do array urlArray que é o metodo */
  private string $urlMethod;
  /** @var string $urlParam recebe a posição 3 do array urlArray que são os parametros  */
  private string $urlParam;
  /** @var array $listPagePublic recebe a lista das classes que são de acesso publico  */
  private array $listPagePublic;
  /** @var array $listPagePrivate recebe a lista das classes que são de acesso restrito, somente com login  */
  private array $listPagePrivate;

  /**
   * Recebe a URL do .htaccess
   * Validar a URL
   */
  public function __construct()
  {
    $this->config();
   
    if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
      $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);

      $this->clearUrl(); // Limpa url

      $this->urlArray = explode("/", $this->url); // converte em um array a string URL atraves do separador "/"

      if (isset($this->urlArray[0])) {
        // Defini a classe da controller como o item da posição [0]
        $this->urlController = $this->slugController($this->urlArray[0]);

        if (isset($this->urlArray[1])) {
          // Defini o metodo como o item da posição [1]
          $this->urlMethod = $this->slugController($this->urlArray[1]);
        } else {
          $this->urlMethod = 'index';
        }

        if (isset($this->urlArray[2])) {
          // Defini o parametro do metodo como o item da posição [2]
          $this->urlParam = $this->urlArray[2];
          $param = explode("/", $this->urlParam);

          // Caso haja mais de um parametro, adiciona ao array na posição segundo o elemento da vez do foreach
          for ($i = 0; $i < count($param); $i++) {
            if (isset($param[$i])) {
              $this->urlArray[$i + 3] = $param[$i];
            }
          }

          // faz o tratamento da string
          $this->urlParam = $this->slugController($this->urlArray[2]);
        } else {
          $this->urlParam = '';
        }
      } else {
        $this->urlController = $this->slugController(CONTROLLER_ERRO);
      }
    } else {
      /**
       * Se não houver nada na url após a raiz, definimos as propriedades manualmente.
       */
      $this->urlController = $this->slugController(CONTROLLER);
      $this->urlMethod = 'index';
      $this->urlParam = '';
    }
  }

  /**
   * 
   * Limpara a URL, elimando as TAG, os espaços em brancos, retirar a barra no final da URL e retirar os caracteres especiais
   *
   * @return void
   */
  private function clearUrl(): void
  {
    // Elimina as tags
    $this->url = strip_tags($this->url);
    // Elimina espaços em branco
    $this->url = trim($this->url);
    //Eliminar Barra no final da URL
    $this->url = rtrim($this->url, "/");

    //Eliminar caracteres indesejaveis
    $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
    $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr-------------------------------------------------------------------------------------------------';

    $this->url = strtr(
      mb_convert_encoding($this->url, 'ISO-8859-1'),
      mb_convert_encoding($this->format['a'], 'ISO-8859-1', 'UTF-8'),
      mb_convert_encoding($this->format['b'], 'ISO-8859-1', 'UTF-8')
    );
  }

  /**
   * Converter o valor obtido da URL "product-detail" e converter no formato da classe "ProductDetail".
   * Utilizado as funções para converter tudo para minúsculo, converter o traço pelo espaço, converter cada letra da primeira palavra para maiúsculo, retirar os espaços em branco
   *
   * @param string $slugController Nome da classe
   * @return string Retorna a controller "product-detail" convertido para o nome da Classe "ProductDetail"
   */
  private function slugController($slugController): string
  {
    //Converter para minusculo
    $this->urlSlugController = strtolower($slugController);
    //Converter o traco para espaco em braco
    $this->urlSlugController = str_replace("-", " ", $this->urlSlugController);
    //Converter a primeira letra de cada palavra para maiusculo
    $this->urlSlugController = ucwords($this->urlSlugController);
    //Retirar espaco em branco
    $this->urlSlugController = str_replace(" ", "", $this->urlSlugController);
    return $this->urlSlugController;
  }

  /**
   * Carregar as Controllers.
   * Instanciar as classes da controller e carregar o método index.
   *
   * @return void
   */
  public function loadPage(): void
  {

    $this->pagePublic();

    if (class_exists($this->classLoad)) {
      $this->loadMethod();
    } else {
      $this->urlController = $this->slugController(CONTROLLER_ERRO);
      $this->urlMethod = $this->slugController('index');
      $this->urlParam = '';
      $_SESSION['msg'] = "Página não encontrada";
      $this->loadPage();
    }
  }

  public function pagePublic(): bool
  {
    $this->listPagePublic = [
      "Home", "Product",
      "Login", "Erro",
      "Register", "Logout",
      "Shop", "Comments",
      "Cart", "Recoverypassword"
    ];

    if (in_array($this->urlController, $this->listPagePublic)) {

      $this->classLoad = "\\Catalog\\Controllers\\" . $this->urlController;
    } else {
      $this->pagePrivate();
    }

    return false;
  }

  public function pagePrivate(): void
  {
    $this->listPagePrivate = [
      "Adm", "Edit",
      "Account", "Menu",
      "Comments", "ProductDetail",
      "ProductList", "CategoryList",
      "CategoryDetail"
    ];

    if (in_array($this->urlController, ($this->listPagePrivate))) {
      $this->verifyLogin();
    } else {
      $_SESSION['msg'] = "Página não encontrada";
      $urlRedirect = URL . "Erro";
      header("Location: " . $urlRedirect);
    }
  }

  public function verifyLogin(): void
  {
    if (isset($_SESSION['type'])) {
      switch ($_SESSION['type']) {
        case USER_COMMON:
          $this->classLoad = "\\Catalog\\Controllers\\Account\\" . $this->urlController;
          break;

        case USER_ADM:
          $this->classLoad = "\\Adm\\Controllers\\" . $this->urlController;
          break;
      }
    } else {
      $_SESSION['msg'] = "Usário sem permissão para acessar essa página!";
      $urlRedirect = URL . "Erro";
      header("Location: " . $urlRedirect);
    }
  }

  private function loadMethod(): void
  {

    $classload = new $this->classLoad();
    if (method_exists($classload, $this->urlMethod)) {
      $classload->{$this->urlMethod}($this->urlParam);
    } else {
      if ($this->urlController === "Product") {
        $classload->item();
      } else {
        $classload->index($this->urlParam ?? "");
      }
    }
  }
}
