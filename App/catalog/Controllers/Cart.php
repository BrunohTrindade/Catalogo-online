<?php

namespace Catalog\Controllers;

use Core\ConfigView;
use Catalog\Util\Util;
use Catalog\Models\OrderModel;
use Catalog\Models\ValueObjects\CartOv;
use Catalog\Models\ValueObjects\OrderOv;

class Cart
{
  private array | null $data;
  private array | null $dataForm;
  private object $model;

  public function __construct()
  {
    $this->model = new OrderModel();
  }

  public function index(): void
  {
    $this->data = $this->model->selectProductsCart($_SESSION['id']);

    $loadView = new ConfigView("Catalog/Views/cart", $this->data);
    $loadView->loadViewCatalog();
  }

  public function indexFetch()
  {
    $data = file_get_contents("php://input");
    $this->dataForm = json_decode($data, true);

    $this->data['response'] = $this->model->selectProductsCart($this->dataForm['user_id']);

    foreach ($this->data['response'] as $i => $product) {
      $this->data['response'][$i]['name_link'] = Util::slugUrlName($product['name']);
    }
    echo json_encode($this->data, true);
  }

  public function addCart(): void
  {
    $data = file_get_contents("php://input");
    $this->dataForm = json_decode($data, true);

    /**
     * 
     * If para verificar se há produtos no carrinho, caso não haja, cria um novo
     * se houver um carrinho criado, insere mais um produto
     * 
     */
    if (!isset($_SESSION['id'])) {
      echo json_encode("login", true);
      exit;
    }


    $order_id = $this->model->verifyCart($_SESSION['id']);

    if (!$order_id) {
      $order = new OrderOv;
      $order->setStatusOrder(1);
      $order->setUserId($_SESSION['id']);
      $order_id = $this->model->insertNewOrder($order);
    }

    if (!$this->model->verifyProductCard($this->dataForm['product_id'], $order_id)) {

      $cart = new CartOv();
      $cart->setOrderId($order_id);
      $cart->setProductId($this->dataForm['product_id']);
      $cart->setQty($this->dataForm['qty']);
      $cart->setPrice($this->dataForm['price']);

      $response = $this->model->insertProductCart($cart);

      echo json_encode($response, true);
    } else {
      $response = false;
      echo json_encode($response, true);
    }
  }

  public function deleteProductCart(): void
  {
    $data = file_get_contents("php://input");
    $this->dataForm = json_decode($data, true);

    $this->data['response'] = $this->model->deleteProductCart($this->dataForm['product_id']);

    echo json_encode($this->data, true);
    exit;
  }

  public function updateProductCart(): void
  {
    $data = file_get_contents("php://input");
    $this->dataForm = json_decode($data, true);

    $this->data['response'] = $this->model->updateProductCart($this->dataForm['product_id'], $this->dataForm['quantity']);

    echo json_encode($this->data, true);
  }
}
