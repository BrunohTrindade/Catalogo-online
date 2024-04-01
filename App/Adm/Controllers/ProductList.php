<?php

namespace Adm\Controllers;

use Core\ConfigView;
use Adm\Util\Util;
use Adm\Models\ProductModel;

class ProductList
{
  private object $loadView;
  private array $data;
  private int | null $currentPage = null;
  private string $url;
  private array $filters = [];

  public function __construct()
  {

    $getUri = filter_input_array(INPUT_GET);

    // $getUri = explode('&', $getUri);

    $this->url = "";
    foreach($getUri as $item => $value)
    {
      if($item != 'url' && $item != 'page')
      {
        $this->{$item} = intval($value);
        $this->url .= "{$item}={$value}&";
      }

      if($item != 'url' && $item != 'page')
      {
        $columns = Util::columnsTable();
        if(in_array($item, $columns['products']) || in_array($item, $columns['category'])){
        $this->filters[$item] = $value;}
      }
      
    }
    $this->currentPage = max($_GET['page'] ?? "", 1); //Garante que a página atual seja pelo menos 1
  }

  public function index()
  {
    $model = new ProductModel(); 
    
    $totalItems = $model->productListTotal($this->filters);

    $this->data['products'] = $model->productList($this->currentPage, $this->filters);

    $this->data['pagination'] = Util::paginate($totalItems[0]['total'], ITEMS_PAGE, URL . "product-list?{$this->url}", $this->currentPage);

    $this->loadView();
  }

  public function category()
  {
    $model = new ProductModel();
    echo json_encode($model->category(), true);
  }

  public function loadView(): void
  {
    $this->loadView = new ConfigView("Adm/Views/products/product-list", $this->data);
    $this->loadView->loadViewAdm();
  }
}
