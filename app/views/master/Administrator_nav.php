
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?= URL ?>?req=home" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                <?= LANG['home'] ?>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= URL ?>?req=users" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Usuarios
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview <?= $objHome->menu_treeview_class('providers_list', 'homologaciones'); ?>">
            <a href="#" class="nav-link">
              <i class="fa-solid fa-people-carry-box nav-icon"></i>
              <p>
                Proveedores
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= URL ?>?req=providers_list" class="nav-link <?= $objHome->menu_active_class('providers_list'); ?>">
                  <i class="fas fa-chevron-right nav-icon"></i>
                  <p>Lista de proveedores</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?= URL ?>?req=branches" class="nav-link">
              <i class="nav-icon fa-solid fa-cubes"></i>
              <p>
                Rubros
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= URL ?>?req=admin_reports" class="nav-link <?= $objHome->menu_active_class('admin_reports'); ?>">
              <i class="nav-icon fa-solid fa-file-lines"></i>
              <p>
                Reportes
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview <?= $objHome->menu_treeview_class('profile', 'support_request', 'info'); ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fab fa-buffer"></i>
              <p>
                <?= LANG['others'] ?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= URL ?>?req=profile" class="nav-link <?= $objHome->menu_active_class('profile'); ?>">
                  <i class="fas fa-chevron-right nav-icon"></i>
                  <p><?= LANG['my_user'] ?></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= URL ?>?req=info" class="nav-link <?= $objHome->menu_active_class('info'); ?>">
                  <i class="fas fa-chevron-right nav-icon"></i>
                  <p><?= LANG['info_sys'] ?></p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?= URL ?>?event=logout" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                <?= LANG['logout'] ?>
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
