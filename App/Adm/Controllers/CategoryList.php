<?php

namespace Adm\Controllers;

use Adm\Util\Util;
use Core\ConfigView;
use Adm\Models\CategoryModel;

class CategoryList
{

  private object $loadView;
  private  $data = [];
  private int | null $currentPage = null;
  private string $url;
  private array $filters = [];
  private object $model;
  
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
    // var_dump($this->filters);
  }

  
  public function index() : void {
    
    $this->model = new CategoryModel();
    $totalItems = $this->model->categoryListTotal($this->filters);
    $this->data['offset'] = $totalItems;
    $this->data['category'] =  $this->model->getAllCategory($this->currentPage, $this->filters);
    $this->data['filters'] =  $this->filters;
    $this->data['pagination'] = Util::paginate($totalItems[0]['total'], ITEMS_PAGE, URL . "category-list?{$this->url}", $this->currentPage);


  $loadView = new ConfigView("adm/Views/Category/category-list", $this->data);
  $loadView->loadViewAdm();
  }

}