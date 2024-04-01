<?php

namespace Core;

use Catalog\Controllers\Menu;
use Catalog\Util\Util;

class ConfigView
{
  private  $dataMenu;
  private object $util;

  public function __construct(private string $nameView, private array | null | string $data = null)
  {
    $this->util =  new Util();

    $data = new Menu();
    $this->dataMenu = $data->index();

  }


  public function loadViewCatalog(): void
  {
    // Crie uma instância da classe Util
    

    if (file_exists('app/' . $this->nameView . '.php')) {
      require "app/Catalog/Views/Templates/include/header.php";
      require "app/Catalog/Views/Templates/include/menu.php";
      require "app/" . $this->nameView . ".php";
      require "app/Catalog/Views/Templates/include/footer.php";
    }
  }

  public function loadViewCatalogAccount(): void
  {
    if (file_exists('app/' . $this->nameView . '.php')) {
      require "app/Catalog/Views/Templates/include/header.php";
      require "app/Catalog/Views/Templates/include/menu.php";
      require "app/Catalog/Views/Templates/include/sidebar.php";
      require "app/" . $this->nameView . ".php";
      require "app/Catalog/Views/Templates/include/footer.php";
    }
  }

  public function loadViewAdm(): void
  {
    if (file_exists("app/" . $this->nameView . ".php")) {
      require "app/Adm/Views/Templates/include/header.php";
      require "app/Adm/Views/Templates/include/navbar.php";
      require "app/Adm/Views/Templates/include/aside_menu.php";
      require "app/" . $this->nameView . ".php";
      require "app/Adm/Views/Templates/include/footer.php";
    }
  }
}
