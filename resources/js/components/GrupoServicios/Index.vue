<template>
  <div>
    <div class="page-title">
      <div class="title_left">
        <h3>Gestión Grupo Servicios</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Buscar..." v-model="buscar" @keyup="BuscarServicio">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Buscar</button>
            </span>
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
            <h2>Lista Grupo Servicios </h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <ul class="nav" style="padding-bottom: 10px;">
              <button type="submit" class="btn btn-success btn-sm" style="vertical-align: top; padding: 5px 50px;" v-on:click="AbrirModal()"><i class="fa fa-plus-circle"></i> Agregar servicio</button>
            </ul>
            <div class="table-responsive">
              <table class="table table-striped jambo_table bulk_action">
                <thead>
                  <tr class="headings">
                    <th class="column-title">Acciones </th>
                    <th class="column-title">Descripción</th>
                    <th class="column-title">Observaciones</th>
                    <th class="column-title">Estado </th>
                  </tr>
                </thead>

                <tbody>
                  <tr class="even pointer" v-for="l in lista">
                    <td class="a-center ">
                      <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                      <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </td>
                    <td class=" ">{{ l.descripcion }}</td>
                    <td class=" ">{{ l.observaciones }}</td>
                    <template v-if="l.estado == 1">
                      <td style="width: 100px;"><div><span class="badge badge-success">Activo</span></div></td>
                    </template>
                    <template v-else>
                      <td style="width: 100px;"><div><span class="badge badge-danger">Inactivo</span></div></td>
                    </template>
                  </tr>
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal" tabindex="-1" id="prueba">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Registrar Servicio</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="form-horizontal form-label-left">
              <div class="form-group row">
                <label>Descripción</label>
                <input type="text" class="form-control" placeholder="Ingrese Descripcion" v-model="descripcion">
              </div>
              <div class="form-group row">
                <label>Observaciones</label>
                <input type="text" class="form-control" placeholder="Ingrese Observacion" v-model="observaciones">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" v-on:click="GuardarDatos()">Guardar Cambios</button>
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
        lista:[],
        buscar:'',
        //modal registro
        descripcion:'',
        observaciones:''
        //modal editar
      }
    },
    mounted() {
      this.Listar();
    },
    methods: {

      Listar(){
        let me = this;
        axios
        .post('/listarGrupServ',{
          buscar : me.buscar,
        })
        .then(function (response) {
          //Respuesta de la peticion
          //console.log(response);
          me.lista = response.data;

          console.log(me.lista);
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });

      },

      BuscarServicio(){
        clearTimeout(this.setTiemoutBuscador);
        this.setTiemoutBuscador = setTimeout(() => {
          this.Listar(1)
        }, 360)
      },

      AbrirModal(){
        $('#prueba').modal('show');
      },

      GuardarDatos(){
        let me = this;
        axios
        .post("/guardarGrupServ", {
          descripcion: me.descripcion,
          observaciones: me.observaciones
        })
        .then(function (response) {
          //Respuesta de la peticion
          console.log(response);
          $('#prueba').modal('hide');
          me.Listar();
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        })
        
        console.log('descrip:'+this.descripcion+', obs:'+this.observaciones);
      }
  },
}


</script>

<style>

</style>