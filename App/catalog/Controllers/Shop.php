<?php

namespace Catalog\Controllers;

use Core\ConfigView;
use Catalog\Util\Util;
use Catalog\Models\ShopModel;

class Shop
{
  private array $data;
  private object $model;
  private array|null $dataForm;
  private int | null $currentPage = null;
  private string $url;
  private array $filters = [];
  private int | null $offset = null;

  
  public function __construct()
  {

    $getUri = filter_input_array(INPUT_GET);

    // $getUri = explode('&', $getUri);
    $this->model = new ShopModel();

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


  public function index($param)
  {
    $this->data = $this->model->index($param, $this->currentPage);
    $this->data['paginate'] = Util::paginate($this->data['total'][0]['total'],12, URL . "shop?", $this->currentPage);
    $this->slugProductAndCategory();
    $this->loadViewCatalog();
  }

  public function search()
  {
    
    $this->data =  $this->model->searchProduct($this->filters['name'] ?? "", $this->currentPage);
    $this->data['search'] = $this->filters['name'] ?? " Nenhum resultado encontrado :(";

    $totalItems = $this->model->countItems($this->filters['name'] ?? "");
    
    $this->data['paginate'] = Util::paginate($totalItems[0]['total'], 12, URL . "shop/search?{$this->url}", $this->currentPage);
    $this->slugProductAndCategory();
    $this->loadViewCatalog();
  }

  private function slugProductAndCategory() : void
  {
    if (!empty($this->data['products'])) {
      foreach ($this->data['products'] as $i => $product) {

        $this->data['products'][$i]['name'] = Util::limitedWords(8, $product['name']);
        $this->data['products'][$i]['name_link'] = Util::slugUrlName($product['name']);

        if ($product['discount'] !== null) {
          $this->data['products'][$i]['with_discount'] = Util::calculateDiscount($product['price'], $product['discount']);
        }
      }
    }

    if(!empty($this->data['category']))
    {
      foreach($this->data['category'] as $key => $value){
        $this->data['category'][$key]['name'] = trim($this->data['category'][$key]['category_name']);
      }
    }
  }

  private function loadViewCatalog()
  {
    $loadView = new ConfigView("Catalog/Views/shop", $this->data);
    $loadView->loadViewCatalog();
  }
}
