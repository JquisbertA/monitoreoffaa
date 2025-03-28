<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="index.html" class="site_title" ><i class="fa fa-bolt" style="border: none !important"></i> <span>SerBasFAB</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <div class="profile_pic">
        <img src="{{ asset('img/fotografias/quisbert.jpg') }}" alt="..." class="img-circle profile_img" style="margin-top:0px;padding: 1px;">
      </div>
      <div class="profile_info" style="padding: 5px 1px 1px">
        <span>Sgto. 1ro. Tec. Quisbert</span>
        <h2>Administrador</h2>
      </div>
    </div>
    <!-- /menu profile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
          <li><a href="/" class="nav-link active"><i class="fa fa-home"></i>Inicio</a>
          </li>
          <li><a><i class="fa fa-users"></i> Personal <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li>
                <router-link class="nav-link" to='/personal'>
                  <p class="mb-0">Personal</p>
                </router-link>
              </li>
              {{-- <li>
                <router-link class="nav-link" to='/empresaServicio'>
                  <p class="mb-0">Unidades</p>
                </router-link>
              </li>
              <li><a href="widgets.html">Tipo Servicio</a></li>
              <li>
                <router-link class="nav-link" to='/modoPagoServicio'>
                  <p class="mb-0">Incidentes</p>
                </router-link>
              </li> --}}

            </ul>
          </li>
          <li><a><i class="fa fa-list"></i> Unidades <span class="fa fa-chevron-down"></span></a>{{-- UNIDADES --}}
            <ul class="nav child_menu">
              <li>
                <router-link class="nav-link" to='/ceo'>CEO's</router-link>
              </li>
              <li>
                <router-link class="nav-link" to='/gguu'>Grandes Unidades</router-link>
              </li>
              <li>
                <router-link class="nav-link" to='/ppuu'>Pequeñas Unidades</router-link>
              </li>
              <li>
                <router-link class="nav-link" to="/mapa">Ver Mapa</router-link>
            </li>
            
            </ul>
          </li>
          <li><a><i class="fa fa-warning"></i> Incidentes <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
   

            <li>
            <router-link class="nav-link" to='/Incidente'>
                  <p class="mb-0">Incidente</p>
                </router-link>
                </li>


              <li><a href="form_advanced.html">Reporte 2</a></li>
              <li><a href="form_validation.html">Reporte 3</a></li>
              <li><a href="form_wizards.html">Reporte 4</a></li>
              <li><a href="form_upload.html">Reporte 5</a></li>
              <li><a href="form_buttons.html">Reporte 6</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-print"></i> Reportes <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="form.html">Reporte 1</a></li>
              <li><a href="form_advanced.html">Reporte 2</a></li>
              <li><a href="form_validation.html">Reporte 3</a></li>
              <li><a href="form_wizards.html">Reporte 4</a></li>
              <li><a href="form_upload.html">Reporte 5</a></li>
              <li><a href="form_buttons.html">Reporte 6</a></li>
            </ul>
          </li>
          
        </ul>
      </div>
      <div class="menu_section">
        <h3>Acceso</h3>
        <ul class="nav side-menu">
          <li><a><i class="fa fa-user-times"></i> Usuarios <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li>
                <router-link class="nav-link" to='/usu'>Usuarios</router-link>
              </li>
              <li>
                <router-link class="nav-link" to='/lrol'>Roles</router-link>
              </li>
              <li>
                <router-link class="nav-link" to='/per'>Permisos</router-link>
              </li>
              <li>
                <router-link class="nav-link" to='/mod'>Modulos</router-link>
              </li>
            </ul>
          </li>

        </ul>
      </div>

    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>