<template>
    <div>
      <div class="page-title">
        <div class="title_left">
          <h3>Gestión Pago de Servicios</h3>
        </div>

        <div class="title_right">
        <div class="col-md-5 col-sm-5  form-group pull-right top_search">
          <div class="input-group">
            Panel Administrador / Pago de Servicios
          </div>
        </div>
      </div>

      </div>
      <div class="clearfix"></div>
      <br>
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              <h2>Lista Modo de Pagos Servicios </h2>
              <ul class="nav navbar-right panel_toolbox">
                <button type="submit" class="btn btn-success btn-sm" style="vertical-align: top; padding: 5px 50px;"><i class="fa fa-plus-circle"></i> Agregar modo de pago</button>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="col-md-4 col-sm-4  form-group pull-right ">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Ingresar datos">
                  <span class="input-group-btn">
                    <button class="btn btn-dark" type="button">Buscar</button>
                  </span>
                </div>
              </div>

              <div class="table-responsive">
                <table class="table table-striped jambo_table bulk_action">
                  <thead>
                    <tr class="headings">
                      <th class="column-title">Acciones </th>
                      <th class="column-title">Descripción</th>
                      <th class="column-title">Codigo </th>
                      <th class="column-title">Estado </th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr class="even pointer">
                      <td class="a-center ">
                        <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                      </td>
                      <td class=" ">ANUAL </td>
                      <td class=" ">121000210 </td>

                      <td style="width: 100px; text-align: center;"><div><span class="badge badge-success">Activo</span></div></td>

                    </tr>
                    <tr class="even pointer">
                      <td class="a-center ">
                        <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                      </td>
                      <td class=" ">BIMESTRAL </td>
                      <td class=" ">121000210 </td>

                      <td style="width: 100px; text-align: center;"><div><span class="badge badge-success">Activo</span></div></td>

                    </tr>
                    <tr class="even pointer">
                      <td class="a-center ">
                        <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                      </td>
                      <td class=" ">MENSUAL </td>
                      <td class=" ">121000210 </td>

                      <td style="width: 100px; text-align: center;"><div><span class="badge badge-success">Activo</span></div></td>

                    </tr>
                    <tr class="even pointer">
                      <td class="a-center ">
                        <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                      </td>
                      <td class=" ">SEMESTRAL </td>
                      <td class=" ">121000210 </td>

                      <td style="width: 100px; text-align: center;"><div><span class="badge badge-success">Activo</span></div></td>

                    </tr>
                    
                    

                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        
      }
    },
    mounted() {
      
    },
    methods: {
      
  },
}


</script>

<style>

</style>