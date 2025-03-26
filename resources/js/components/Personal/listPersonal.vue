<template>
    <div>
      <div class="page-title">
        <div class="title_left">
          <h3>Personal</h3>
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
              <h2>Lista Personal </h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <ul class="nav" style="padding-bottom: 10px;">
                <button type="submit" class="btn btn-success btn-sm" style="vertical-align: top; padding: 5px 50px;" v-on:click="ModalRegistro()"><i class="fa fa-plus-circle"></i> Registrar Personal</button>
              </ul>
              <div class="table-responsive">
                <table class="table table-striped jambo_table bulk_action">
                  <thead>
                    <tr class="headings">
                      <th class="column-title">Fuerza</th>
                      <th class="column-title">Grado</th>
                      <th class="column-title">Nombres</th>
                      <th class="column-title">Ap. Paterno</th>
                      <th class="column-title">Ap. Materno</th>
                      <th class="column-title">Acciones </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="even pointer" v-for="p in arrayPersonal">
                      <td class=" ">{{ p.fuerza }}</td>
                      <td class=" ">{{ p.abreviatura }}</td>
                      <td class=" ">{{ p.nombre }}</td>
                      <td class=" ">{{ p.ap_paterno }}</td>
                      <td class=" ">{{ p.ap_materno }}</td>
                      <!-- <template v-if="p.estado == 1">
                        <td style="width: 100px;"><div><span class="badge badge-success">Activo</span></div></td>
                      </template>
                      <template v-else>
                        <td style="width: 100px;"><div><span class="badge badge-danger">Inactivo</span></div></td>
                      </template> -->
                      <td class="a-center ">
                        <button type="button" class="btn btn-warning btn-sm" v-on:click="AbrirModalEdit(p.perid)"><i class="fa fa-edit"></i></button>
                        <!-- <button type="button" class="btn btn-danger btn-sm" v-if="l.estado == 1" v-on:click="CambiarEstado(l.estado, l.id)"><i class="fa fa-trash"></i></button>
                        <button type="button" class="btn btn-success btn-sm" v-else v-on:click="CambiarEstado(l.estado, l.id)"><i class="fa fa-check"></i></button> -->
                      </td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal" tabindex="-1" id="registro">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Registrar Personal</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal form-label-left">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Fuerza</label>
                        <!-- <select class="form-control" v-model="fuerza">
                            <option value="" disabled>Seleccione Fuerza</option>
                            <option v-for="fuerza in arrayFuerza" :key="fuerza.id" :value="fuerza.id" v-text="fuerza.fuerza"></option>                        
                        </select> -->
                        <v-select
                            label="fuerza"
                            :options="arrayFuerza"
                            v-model="fuerza"
                            @input="grado = null, ListarGrado(), especialidad = null, ListarEspecialidad(), arma = null, ListarArma()"
                            style="text-transform:uppercase;"
                        >
                            <template v-slot:no-options="{ search, searching }">
                            <template v-if="searching">
                                Lo sentimos, no hay opciones de coincidencia para <em>{{
                                search
                                }}</em
                                >.
                            </template>
                            <em v-else
                                >Lo sentimos, no hay opciones de coincidencia.</em
                            >
                            </template>
                        </v-select>
                    </div>
                    <div class="col-md-6">
                        <label>Escalafon</label>
                        <v-select
                            label="escalafon"
                            :options="arrayEscalafon"
                            v-model="escalafon"
                            style="text-transform:uppercase;"
                        >
                            <template v-slot:no-options="{ search, searching }">
                            <template v-if="searching">
                                Lo sentimos, no hay opciones de coincidencia para <em>{{
                                search
                                }}</em
                                >.
                            </template>
                            <em v-else
                                >Lo sentimos, no hay opciones de coincidencia.</em
                            >
                            </template>
                        </v-select>                   
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Grado</label>
                        <v-select
                            label="abreviatura"
                            :options="arrayGrado"
                            v-model="grado"
                            style="text-transform:uppercase;"
                        >
                            <template v-slot:no-options="{ search, searching }">
                            <template v-if="searching">
                                Lo sentimos, no hay opciones de coincidencia para <em>{{
                                search
                                }}</em
                                >.
                            </template>
                            <em v-else
                                >Lo sentimos, no hay opciones de coincidencia.</em
                            >
                            </template>
                        </v-select>                      
                    </div>
                    <div class="col-md-6">
                        <label>Especialidad</label>
                        <v-select
                            label="abreviatura"
                            :options="arrayEspecialidad"
                            v-model="especialidad"
                            style="text-transform:uppercase;"
                        >
                            <template v-slot:no-options="{ search, searching }">
                            <template v-if="searching">
                                Lo sentimos, no hay opciones de coincidencia para <em>{{
                                search
                                }}</em
                                >.
                            </template>
                            <em v-else
                                >Lo sentimos, no hay opciones de coincidencia.</em
                            >
                            </template>
                        </v-select>                     
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Arma</label>
                        <v-select
                            label="arma"
                            :options="arrayArma"
                            v-model="arma"
                            style="text-transform:uppercase;"
                        >
                            <template v-slot:no-options="{ search, searching }">
                            <template v-if="searching">
                                Lo sentimos, no hay opciones de coincidencia para <em>{{
                                search
                                }}</em
                                >.
                            </template>
                            <em v-else
                                >Lo sentimos, no hay opciones de coincidencia.</em
                            >
                            </template>
                        </v-select> 
                    </div>
                    <div class="col-md-6">
                        <label>Nombres</label>
                        <input type="text" class="form-control" placeholder="Ingrese Nombres" v-model="nombre">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Apellido Paterno</label>
                        <input type="text" class="form-control" placeholder="Ingrese Apellido Paterno" v-model="ap_paterno">
                    </div>
                    <div class="col-md-6">
                        <label>Apellido Materno</label>
                        <input type="text" class="form-control" placeholder="Ingrese Apellido Materno" v-model="ap_materno">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Cedula de Identidad</label>
                        <input type="text" class="form-control" placeholder="Ingrese Nro. Cedula" v-model="ci">
                    </div>
                    <div class="col-md-6">
                        <label>Carnet Militar</label>
                        <input type="text" class="form-control" placeholder="Ingrese Nro. Carnet Militar" v-model="cm">
                    </div>
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
              <h5 class="modal-title">Editar Servicio</h5>
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
                  <label>Observaciones</label>
                  <input type="text" class="form-control" placeholder="Ingrese Observacion" v-model="observacionesE">
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
            fuerza : '',
            escalafon : '',
            grado : '',
            especialidad : '',
            nombre : '',
            ap_paterno : '',
            ap_materno : '',
            ci : '',
            cm : '',
            arma : '',
            arrayPersonal : [],
            arrayFuerza : [],
            arrayEscalafon : [],
            arrayGrado : [],
            arrayEspecialidad : [],
            arrayArma : [],


          buscar:'',
          //modal registro
          descripcion:'',
          observaciones:'',
          //modal editar
          descripcionE:'',
          observacionesE:'',
          idE:'',
        }
      },
      mounted() {
        this.ListarPersonal();
        this.ListarFuerza();
        this.ListarEscalafon();
        this.ListarGrado();
        this.ListarEspecialidad();
        this.ListarArma();
      },
      methods: {
  
        ListarPersonal(){
          let me = this;
          axios
        //   .post('/listarGrupServ',{
          .post('/listarPersonal',{
            // buscar : me.buscar,
          })
          .then(function (response) {
            //Respuesta de la peticion
            //console.log(response);
            me.arrayPersonal = response.data.personal;
  
            console.log(me.arrayPersonal);
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          });
        },

        ListarFuerza(){
          let me = this;
          axios
        //   .post('/listarGrupServ',{
          .post('/listarFuerza',{
            // buscar : me.buscar,
          })
          .then(function (response) {
            //Respuesta de la peticion
            //console.log(response);
            me.arrayFuerza = response.data.fuerza;
  
            console.log(me.arrayFuerza);
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          });
        },

        ListarEscalafon(){
          let me = this;
          axios
        //   .post('/listarGrupServ',{
          .post('/listarEscalafon',{
            // buscar : me.buscar,
          })
          .then(function (response) {
            //Respuesta de la peticion
            //console.log(response);
            me.arrayEscalafon = response.data.escalafon;
  
            console.log(me.arrayEscalafon);
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          });
        },

        ListarGrado(){
          let me = this;
          axios
        //   .post('/listarGrupServ',{
          .post('/listarGrado',{
            fuerza : me.fuerza.id,
          })
          .then(function (response) {
            //Respuesta de la peticion
            //console.log(response);
            me.arrayGrado = response.data.grado;
  
            console.log(me.arrayGrado);
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          });
        },

        ListarEspecialidad(){
          let me = this;
          axios
        //   .post('/listarGrupServ',{
          .post('/listarEspecialidad',{
            fuerza : me.fuerza.id,
          })
          .then(function (response) {
            //Respuesta de la peticion
            //console.log(response);
            me.arrayEspecialidad = response.data.especialidad;
  
            console.log(me.arrayEspecialidad);
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          });
        },

        ListarArma(){
          let me = this;
          axios
        //   .post('/listarGrupServ',{
          .post('/listarArma',{
            fuerza : me.fuerza.id,
          })
          .then(function (response) {
            //Respuesta de la peticion
            //console.log(response);
            me.arrayArma = response.data.arma;
  
            console.log(me.arrayArma);
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
  
        ModalRegistro(){
          $('#registro').modal('show');
        },
  
        GuardarDatos(){
          let me = this;
          axios
          .post("/crearPersonal", {
            id_fuerza : me.fuerza.id,
            id_escalafon : me.escalafon.id,
            id_grado : me.grado.id,
            id_especialidad : me.especialidad.id,
            id_arma : me.arma.id,
            nombre : me.nombre,
            ap_paterno : me.ap_paterno,
            ap_materno : me.ap_materno,
            ci : me.ci,
            cm : me.cm
          })
          .then(function (response) {
            //Respuesta de la peticion
            console.log(response);
            $('#registro').modal('hide');
            me.ListarPersonal();
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
          
          console.log('descrip:'+this.ap_paterno+', obs:'+this.ap_materno);
        },
  
        AbrirModalEdit(id){
          console.log(id);
          let me = this;
          me.idE = id; //llamamos al id global
          axios
          .post("/datosGrupServ", {
            id: id
          })
          .then(function (response) {
            //Respuesta de la peticion
            console.log(response);
            me.descripcionE = response.data.descripcion;
            me.observacionesE = response.data.observaciones;
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
          .post("/editarGrupServ", {
            descripcion: me.descripcionE,
            observaciones: me.observacionesE,
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
          .post("/estadoGrupServ", {
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