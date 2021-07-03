    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?=media()?>img/avatar.png" alt="User Image">
        <div>
          <p class="app-sidebar__user-name">Oscar Cornejo</p>
          <p class="app-sidebar__user-designation">Desarrollador </p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item" href="<?=base_url()?>dashboard">
          <i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a>
        </li>
        
        <li class="treeview">
          <a class="app-menu__item" href="#" data-toggle="treeview">
            <i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Administración</span><i class="treeview-indicator fa fa-angle-right"></i>
          </a>
              <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?=base_url()?>usuarios"><i class="icon fa fa-circle-o"></i> Usuarios</a></li>
                <li><a class="treeview-item" href="<?=base_url()?>roles"><i class="icon fa fa-circle-o"></i> Roles de Usuario</a></li>
                <li><a class="treeview-item" href="<?=base_url()?>sistema"><i class="icon fa fa-circle-o"></i> Configuración Sistema</a></li>
                <li><a class="treeview-item" href="<?=base_url()?>federacion"><i class="icon fa fa-circle-o"></i> Federación</a></li>
              </ul>
        </li>


        <li class="treeview">
          <a class="app-menu__item" href="#" data-toggle="treeview">
            <i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Colegiados</span><i class="treeview-indicator fa fa-angle-right"></i>
          </a>
              <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?=base_url()?>nuevo_colegiado"><i class="icon fa fa-circle-o"></i> Nuevo Colegiado</a></li>
                <li><a class="treeview-item" href="<?=base_url()?>administracion_colegiados"><i class="icon fa fa-circle-o"></i> Administración Colegiados</a></li>
                <li><a class="treeview-item" href="<?=base_url()?>reporte_colegiados"><i class="icon fa fa-circle-o"></i> Reporte Colegiados</a></li>
          </ul>
        </li>


        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Clubes</span><i class="treeview-indicator fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?=base_url()?>nuevo_club"><i class="icon fa fa-circle-o"></i> Nuevo Club</a></li>
                <li><a class="treeview-item" href="<?=base_url()?>administracion_clubs"><i class="icon fa fa-circle-o"></i> Administración Clubes</a></li>
                <li><a class="treeview-item" href="<?=base_url()?>reporte_clubs"><i class="icon fa fa-circle-o"></i> Reporte Clubes</a></li>
              </ul>
        </li>


        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Partidos</span><i class="treeview-indicator fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?=base_url()?>nuevo_partido"><i class="icon fa fa-circle-o"></i> Nuevo Partidos</a></li>
                <li><a class="treeview-item" href="<?=base_url()?>administracion_partidos"><i class="icon fa fa-circle-o"></i> Administración Partidos</a></li>
                <li><a class="treeview-item" href="<?=base_url()?>reporte_partidos"><i class="icon fa fa-circle-o"></i> Reporte Partidos</a></li>
              </ul>
        </li>

        <li><a class="app-menu__item" href="<?=base_url()?>sorteo_partidos"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Sorteo Partidos</span></a></li>
        
        <li><a class="app-menu__item" href="<?=base_url()?>gestion_encuestas"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Encuestas</span></a></li>         
      
        <li><a class="app-menu__item" href="docs.html"><i class="app-menu__icon fa fa-file-code-o"></i><span class="app-menu__label">Docs</span></a></li>
      </ul>
    </aside>