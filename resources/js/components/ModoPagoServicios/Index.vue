<template>
    <div>
      <div class="page-title">
        <div class="title_left">
          <h3>Gestión Modo Pago de Servicios</h3>
        </div>

        <div class="title_right">
          <div class="col-md-5 col-sm-5 form-group pull-right top_search">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Buscar..." v-model="buscar" @keyup="BuscarPago">
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
              <h2>Lista Modo de Pagos Servicios </h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <ul class="nav" style="padding-bottom: 10px;">
                <button type="submit" class="btn btn-success btn-sm" style="vertical-align: top; padding: 5px 50px;" v-on:click="AbrirModal()"><i class="fa fa-plus-circle"></i> Agregar Modo Pago</button>
              </ul>

              <div class="table-responsive">
                <table class="table table-striped jambo_table bulk_action">
                  <thead>
                    <tr class="headings">
                      <th class="column-title">Descripción</th>
                      <th class="column-title">Codigo </th>
                      <th class="column-title">Estado </th>
                      <th class="column-title">Acciones </th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr class="even pointer" v-for="l in lista">
                      <td class=" ">{{ l.descripcion }}</td>
                      <td class=" ">{{ l.codigo }}</td>
                      <template v-if="l.estado == 1">
                        <td style="width: 100px;"><div><span class="badge badge-success">Activo</span></div></td>
                      </template>
                      <template v-else>
                        <td style="width: 100px;"><div><span class="badge badge-danger">Inactivo</span></div></td>
                      </template>
                      <td class="a-center ">
                        <button type="button" class="btn btn-warning btn-sm" v-on:click="AbrirModalEdit(l.id)"><i class="fa fa-edit"></i></button>
                      <button type="button" class="btn btn-danger btn-sm" v-if="l.estado == 1" v-on:click="CambiarEstado(l.estado, l.id)"><i class="fa fa-trash"></i></button>
                      <button type="button" class="btn btn-success btn-sm" v-else v-on:click="CambiarEstado(l.estado, l.id)"><i class="fa fa-check"></i></button>
                      </td>
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
            <h5 class="modal-title">Registrar Modo de Pago</h5>
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
                <label>Codigo</label>
                <input type="text" class="form-control" placeholder="Ingrese Codigo" v-model="codigo">
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

    <div class="modal" tabindex="-1" id="pruebaedit">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Editar Modo de Pago</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="form-horizontal form-label-left">
              <div class="form-group row">
                <label>Descripción</label>
                <input type="text" class="form-control" placeholder="Ingrese Descripcion" v-model="descripcionE">
              </div>
              <div class="form-group row">
                <label>Codigo</label>
                <input type="text" class="form-control" placeholder="Ingrese Codigo" v-model="codigoE">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" v-on:click="EditarDatos()">Editar Cambios</button>
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
        codigo:'',
        //modal editar
        descripcionE:'',
        codigoE:'',
        idE:'',
      }
    },
    mounted() {
      this.Listar();
    },
    methods: {
      Listar(){
        let me = this;
        axios
        .post('/listarPagoServ',{
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

      BuscarPago(){
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
        .post("/guardarPagoServ", {
          descripcion: me.descripcion,
          codigo: me.codigo
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
        
        console.log('descrip:'+this.descripcion+', obs:'+this.codigo);
      },

      AbrirModalEdit(id){
        console.log(id);
        let me = this;
        me.idE = id; //llamamos al id global
        axios
        .post("/datosPagoServ", {
          id: id
        })
        .then(function (response) {
          //Respuesta de la peticion
          console.log(response);
          me.descripcionE = response.data.descripcion;
          me.codigoE = response.data.codigo;
          $('#pruebaedit').modal('show');
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        })

      },

      EditarDatos(){
        //console.log('ya funciona el boton');
        let me = this;
        
        axios
        .post("/editarPagoServ", {
          descripcion: me.descripcionE,
          codigo: me.codigoE,
          id:me.idE
        })
        .then(function (response) {
          //Respuesta de la peticion
          console.log(response);
          $('#pruebaedit').modal('hide');
          me.Listar();
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        })

      },

      CambiarEstado(estado,id){
        let me = this;
        axios
        .post("/estadoPagoServ", {
          estado: estado,
          id : id
        })
        .then(function (response) {
          //Respuesta de la peticion
          me.Listar();
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        })

      }
  },
}


</script>

<style>

</style>