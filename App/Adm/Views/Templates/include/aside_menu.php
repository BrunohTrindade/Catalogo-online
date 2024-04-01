    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="product-list" class="brand-link">
        <span class="brand-text font-weight-light">
          <strong>
           <center> EP PISCINAS</center>
          </strong>
        </span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="<?= URL ?>product-list" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Produtos
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= URL ?>product-detail/index" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Novo Produto
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= URL ?>category-list/index" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Categorias
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= URL ?>category-detail/index" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Nova Categoria
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">