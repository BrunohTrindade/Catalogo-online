<?php

namespace Adm\Controllers;

use Core\ConfigView;
use Adm\Models\CategoryModel;
use Adm\Models\ValueObject\ProductVo;
use Adm\Models\ValueObject\CategoryVo;

class CategoryDetail
{
  private object $loadView;
  private array $data;
  private object $model;

  public function __construct()
  {
    $this->model = new CategoryModel();
  }

  public function index($param): void
  {
    // $data = file_get_contents("php://input");
    // $this->data = json_decode($data, true);
    $this->data = $this->model->category($param);

    $this->loadView = new ConfigView("Adm/Views/category/category", $this->data);
    $this->loadView->loadViewAdm();
  }

  public function createCategory()
  {
    $data = file_get_contents("php://input");
    $formData = json_decode($data, true);

    $productVo = new CategoryVo();

    $productVo->setName($formData['name']);
    $productVo->setDescription($formData['description']);
    $productVo->setStatus($formData['status']);

    echo json_encode($this->model->createCategory($productVo), true);
  }

  public function updateCategory()
  {

    $data = file_get_contents("php://input");
    $formData = json_decode($data, true);

    $productVo = new CategoryVo();

    $productVo->setName($formData['name']);
    $productVo->setDescription($formData['description']);
    $productVo->setStatus($formData['status']);
    $productVo->setId($formData['id']);

    echo json_encode($this->model->updateCategory($productVo), true);
  }

  public function deleteImg()
  {
    $data = file_get_contents("php://input");
    $formData = json_decode($data, true);

    $return = $this->model->deleteImgProductModel($formData);
    echo json_encode($return, true);
  }

  public function loadView(): void
  {

    $this->loadView = new ConfigView("adm/Views/Category/Category-list", $this->data);
    $this->loadView->loadViewAdm();
  }
}
