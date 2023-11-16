
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
          <li class="nav-item has-treeview <?= $objHome->menu_treeview_class('new_user', 'users', 'user_profile'); ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                <?= LANG['users'] ?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= URL ?>?req=new_user" class="nav-link <?= $objHome->menu_active_class('new_user'); ?>">
                  <i class="fas fa-chevron-right nav-icon"></i>
                  <p><?= LANG['new_user'] ?></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= URL ?>?req=users" class="nav-link <?= $objHome->menu_active_class('users'); ?> <?= $objHome->menu_active_class('user_profile'); ?>">
                  <i class="fas fa-chevron-right nav-icon"></i>
                  <p><?= LANG['user_list'] ?></p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?= $objHome->menu_treeview_class('nueva_solicitud', 'solicitudes'); ?>">
            <a href="#" class="nav-link">
              <i class="fas fa-basket-shopping nav-icon"></i>
              <p>
                Compras
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= URL ?>?req=solicitudes" class="nav-link <?= $objHome->menu_active_class('solicitudes'); ?>">
                  <i class="fas fa-chevron-right nav-icon"></i>
                  <p>Solicitudes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= URL ?>?req=nueva_solicitud" class="nav-link <?= $objHome->menu_active_class('nueva_solicitud'); ?>">
                  <i class="fas fa-chevron-right nav-icon"></i>
                  <p>Nueva Solicitud</p>
                </a>
              </li>
            </ul>
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
          <li class="nav-item has-treeview <?= $objHome->menu_treeview_class('product_list', 'new_product'); ?>">
            <a href="#" class="nav-link">
              <i class="fa-solid fa-boxes-stacked nav-icon"></i>
              <p>
                Productos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= URL ?>?req=product_list" class="nav-link <?= $objHome->menu_active_class('product_list'); ?>">
                  <i class="fas fa-chevron-right nav-icon"></i>
                  <p>Lista de productos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= URL ?>?req=new_product" class="nav-link <?= $objHome->menu_active_class('new_product'); ?>">
                  <i class="fas fa-chevron-right nav-icon"></i>
                  <p>Solicitudes de ingreso</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?= $objHome->menu_treeview_class('rubros', 'proyectos', 'actividades', 'financiadores', 'centros_costo', 'cuentas_contables'); ?>">
            <a href="#" class="nav-link">
              <i class="fa-solid fa-desktop nav-icon"></i>
              <p>
                Administración
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= URL ?>?req=rubros" class="nav-link <?= $objHome->menu_active_class('rubros'); ?>">
                  <i class="fas fa-chevron-right nav-icon"></i>
                  <p>Rubros</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= URL ?>?req=proyectos" class="nav-link <?= $objHome->menu_active_class('proyectos'); ?>">
                  <i class="fas fa-chevron-right nav-icon"></i>
                  <p>Proyectos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= URL ?>?req=actividades" class="nav-link <?= $objHome->menu_active_class('actividades'); ?>">
                  <i class="fas fa-chevron-right nav-icon"></i>
                  <p>Actividades</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= URL ?>?req=financiadores" class="nav-link <?= $objHome->menu_active_class('financiadores'); ?>">
                  <i class="fas fa-chevron-right nav-icon"></i>
                  <p>Financiadores</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= URL ?>?req=centros_costo" class="nav-link <?= $objHome->menu_active_class('centros_costo'); ?>">
                  <i class="fas fa-chevron-right nav-icon"></i>
                  <p>Centros de costo</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= URL ?>?req=cuentas_contables" class="nav-link <?= $objHome->menu_active_class('cuentas_contables'); ?>">
                  <i class="fas fa-chevron-right nav-icon"></i>
                  <p>Cuentas contables</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?= $objHome->menu_treeview_class('default_reports', 'custom_reports'); ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-invoice"></i>
              <p>
                <?= LANG['reports'] ?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= URL ?>?req=default_reports" class="nav-link <?= $objHome->menu_active_class('default_reports'); ?>">
                  <i class="fas fa-chevron-right nav-icon"></i>
                  <p><?= LANG['default_reports'] ?></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= URL ?>?req=custom_reports" class="nav-link <?= $objHome->menu_active_class('custom_reports'); ?>">
                  <i class="fas fa-chevron-right nav-icon"></i>
                  <p><?= LANG['custom_reports'] ?></p>
                </a>
              </li>
            </ul>
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
