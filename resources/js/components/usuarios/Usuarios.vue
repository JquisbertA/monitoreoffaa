<template>
  <div>
    <div class="page-title">
      <div class="title_left">
        <h3>Usuarios</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Buscar..." v-model="buscar" @keyup="BuscarEmpresa">
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
            <h2>Lista de Usuarios </h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <ul class="nav" style="padding-bottom: 10px;">
              <button type="submit" class="btn btn-success btn-sm" style="vertical-align: top; padding: 5px 20px;" v-on:click="AbrirModal()"><i class="fa fa-plus"></i> Agregar Usuario</button>
            </ul>

            <div class="table-responsive">
              <table class="table table-striped jambo_table bulk_action">
                <thead>
                  <tr class="headings">
                    <th class="column-title">Nombre</th>
                    <th class="column-title">Email</th>
                    <th class="column-title">Rol </th>
                    <th class="column-title">Estado</th>
                    <th class="column-title">Acciones </th>
                  </tr>
                </thead>

                <tbody>
                  <tr class="even pointer" v-for="l in lista">
                    <td class=" ">{{ l.name }}</td>
                    <td class=" ">{{ l.email }}</td>
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
            <h5 class="modal-title">Registrar Nuevo Usuario</h5>
            <button type="button" class="close" data-dismiss="modal" @click="cerrarModal()" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="form-horizontal form-label-left">
              <div class="form-group row">
                <label>Nombre y Apellidos</label>
                <input type="text" class="form-control" placeholder="Ingrese Nombre" v-model="name">
              </div>
              <div class="form-group row">
                <label>Correo Electrónico</label>
                <input type="text" class="form-control" placeholder="Ingrese Email" v-model="email">
              </div>
              <div class="form-group row">
                <label>Rol</label>
                <input type="text" class="form-control" placeholder="Ingrese Rol" v-model="rol">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="cerrarModal()">Cerrar</button>
            <button type="button" class="btn btn-primary" v-on:click="GuardarDatos()">Registrar</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal" tabindex="-1" id="pruebaedit">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Editar Usuario</h5>
            <button type="button" class="close" data-dismiss="modal" @click="cerrarModal()" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="form-horizontal form-label-left">
              <div class="form-group row">
                <label>Nombre y Apellidos</label>
                <input type="text" class="form-control" placeholder="Ingrese nombre" v-model="nameE">
              </div>
              <div class="form-group row">
                <label>Correo Electrónico</label>
                <input type="text" class="form-control" placeholder="Ingrese emial" v-model="emailE">
              </div>
              <div class="form-group row">
                <label>Rol</label>
                <input type="text" class="form-control" placeholder="Ingrese rol" v-model="rolE">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="cerrarModal()">Cerrar</button>
            <button type="button" class="btn btn-primary" v-on:click="EditarUsuario()">Editar Usuario</button>
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
        name:'',
        email:'',
        observaciones:'',
        rol:'',
        //modal editar
        nameE:'',
        emailE:'',
        observacionesE:'',
        rolE:'',
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
        .post('/listarUsuarios',{
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

      BuscarEmpresa(){
        clearTimeout(this.setTiemoutBuscador);
        this.setTiemoutBuscador = setTimeout(() => {
          this.Listar(1)
        }, 360)
      },

      AbrirModal(){
        $('#prueba').modal('show');
      },
      cerrarModal(){
        $('#prueba').modal('hide');
        this.name = '';
        this.email = '';
        this.rol = '';
      },

      GuardarDatos(){
        let me = this;
        axios
        .post("/usuario/CrearUsuario", {
          name:me.name,
          email: me.email,
          //observaciones: me.observaciones,
          rol:me.rol
        })
        .then(function (response) {
          //Respuesta de la peticion
          if(response.data==201){
            return Swal.fire("Mensaje de Advertencia","La Persona es usuario del Sistema","warning");
          }
          if(response.data==404){
            return Swal.fire("Mensaje de Advertencia","Para asignar el rol debe actualizar el correo electrónico de la persona","error");
          }
          if(response.data==400){
            return Swal.fire("Mensaje de Advertencia","No se pudo completar el registro","error");
          }
          if(response.data==200) {
            Swal.fire("Mensaje de Confirmación","Usuario Registrado Correctamente","success");
            me.cerrarModal();
            me.Listar();
          }
          //console.log(response);
          
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        })
        
        console.log('descrip:'+this.name+', obs:'+this.email);
      },

      AbrirModalEdit(id){
        console.log(id);
        let me = this;
        me.idE = id; //llamamos al id global
        axios
        .post("/datosUsuarios", {
          id: id
        })
        .then(function (response) {
          //Respuesta de la peticion
          console.log(response.name);
          me.nameE = response.data.name;
          me.emailE = response.data.email;
          me.rolE = response.data.rol;
          $('#pruebaedit').modal('show');
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        })

      },

      EditarUsuario(){
        //console.log('ya funciona el boton');
        let me = this;
        
        axios
        .put("/editarUsuarios", {
          name: me.nameE,
          email: me.emailE,
          rol: me.rolE,
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
        .put("/desactivarUsuario", {
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