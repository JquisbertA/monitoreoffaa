<template>
    <div>
      <div class="page-title">
        <div class="title_left">
          <h3>Gestión Pequeñas Unidades</h3>
        </div>
  
        <div class="title_right">
          <div class="col-md-5 col-sm-5 form-group pull-right top_search">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Buscar..." v-model="buscar" @keyup="BuscarCeo">
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
              <h2>Lista Pequeñas unidades </h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <ul class="nav" style="padding-bottom: 10px;">
                <button type="submit" class="btn btn-success btn-sm" style="vertical-align: top; padding: 5px 50px;" v-on:click="AbrirModal()"><i class="fa fa-plus-circle"></i> Agregar</button>
              </ul>
  
              <div class="table-responsive">
                <table class="table table-striped jambo_table bulk_action">
                  <thead>
                    <tr class="headings">
                      <th class="column-title">CEO</th>
                      <th class="column-title">Fuerza</th>
                      <th class="column-title">Gran Unidad</th>
                      <th class="column-title">Pequeña Unidad</th>
                      <th class="column-title">Abreviatura</th>
                      <th class="column-title">Descripción</th>
                      <th class="column-title">Latitud</th>
                      <th class="column-title">Longitud</th>
                      <th class="column-title">Estado </th>
                      <th class="column-title">Acciones </th>
                    </tr>
                  </thead>
  
                  <tbody>
                    <tr class="even pointer" v-for="l in lista">
                      <td class=" ">{{ l.sigla }}</td>
                      <td class=" ">{{ l.fuerza }}</td>
                      <td class=" ">{{ l.gran_unidad }}</td>
                      <td class=" ">{{ l.peq_unidad }}</td>
                      <td class=" ">{{ l.abreviatura }}</td>
                      <td class=" ">{{ l.descripcion }}</td>
                      <td class=" ">{{ l.lat }}</td>
                      <td class=" ">{{ l.lng }}</td>
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
      <!-- Modal Registrar -->
      <div class="modal" tabindex="-1" id="prueba">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Registrar Pequeña Unidad</h5>
              <button type="button" class="close" data-dismiss="modal" @click="cerrarModal()" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal form-label-left">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label>Fuerza</label>
                    <select class="form-control" v-model="idfuerza" required v-on:change="changeItem1(rowId, $event)">
                      <option value="0" disabled>SELECCIONE</option>
                      <option v-for="fuerza in arrayFuerza" :key="fuerza.id" :value="fuerza.id" v-text="fuerza.fuerza"></option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label>Gran Unidad</label>
                    <select class="form-control" v-model="idgranunidad" required>
                        <option value="0" disabled>SELECCIONE</option>
                        <option v-for="gran_unidad in arrayGranunidad" :key="gran_unidad.id" :value="gran_unidad.id" v-text="gran_unidad.gran_unidad"></option>
                      </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label>Pequeña Unidad</label>
                    <input type="text" class="form-control" placeholder="Ingrese pequeña unidad" v-model="peq_unidad">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label>Abreviatura</label>
                    <input type="text" class="form-control" placeholder="Ingrese abreviatura" v-model="abreviatura">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label>Descripción</label>
                    <input type="text" class="form-control" placeholder="Ingrese descripcion" v-model="descripcion">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label>Latitud</label>
                    <input type="text" class="form-control" placeholder="Ingrese latitud" v-model="latitud">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label>Longitud</label>
                    <input type="text" class="form-control" placeholder="Ingrese longitud" v-model="longitud">
                  </div>
                </div>

              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" @click="cerrarModal()" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" v-on:click="GuardarDatos()">Guardar Cambios</button>
            </div>
          </div>
        </div>
      </div>
  
      <div class="modal" tabindex="-1" id="prueba">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Editar Pequeña Unidad</h5>
              <button type="button" class="close" data-dismiss="modal" @click="cerrarModal()" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal form-label-left">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label>Fuerza</label>
                    <select class="form-control" v-model="idfuerzaE" required v-on:change="changeItem1(rowId, $event)">
                        <option value="0" disabled>SELECCIONE</option>
                        <option v-for="fuerza in arrayFuerza" :key="fuerza.id" :value="fuerza.id" v-text="fuerza.fuerza"></option>
                      </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label>Gran Unidad</label>
                    <select class="form-control" v-model="idgranunidadE" required>
                        <option value="0" disabled>SELECCIONE</option>
                        <option v-for="gran_unidad in arrayGranunidad" :key="gran_unidad.id" :value="gran_unidad.id" v-text="gran_unidad.gran_unidad"></option>
                      </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label>Pequeña Unidad</label>
                    <input type="text" class="form-control" placeholder="Ingrese pequeña unidad" v-model="peq_unidadE">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label>Abreviatura</label>
                    <input type="text" class="form-control" placeholder="Ingrese abreviatura" v-model="abreviaturaE">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label>Descripción</label>
                    <input type="text" class="form-control" placeholder="Ingrese descripcion" v-model="descripcionE">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label>Latitud</label>
                    <input type="text" class="form-control" placeholder="Ingrese latitud" v-model="latitudE">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label>Longitud</label>
                    <input type="text" class="form-control" placeholder="Ingrese longitud" v-model="longitudE">
                  </div>
                </div>

              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" @click="cerrarModal()" data-dismiss="modal">Cerrar</button>
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
          arrayFuerza:[],
          idfuerza:0,
          arrayGranunidad:[],
          idgranunidad:0,
          //modal registro
          peq_unidad:'',
          abreviatura:'',
          descripcion:'',
          latitud:'',
          longitud:'',
          codigo:'',

          idfuerzaE:0,
          idgranunidadE:0,
          //modal editar
          peq_unidadE:'',
          abreviaturaE:'',
          descripcionE:'',
          latitudE:'',
          longitudE:'',
          codigoE:'',
          idE:'',
          rowId : 0,
        }
      },
      mounted() {
        this.Listar();
      },
      methods: {
  
        Listar(){
          let me = this;
          axios
          .post('/unidades/listaPeqUni',{
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
  
        BuscarCeo(){
          clearTimeout(this.setTiemoutBuscador);
          this.setTiemoutBuscador = setTimeout(() => {
            this.Listar(1)
          }, 360)
        },
  
        AbrirModal(){
          $('#prueba').modal('show');
          this.selectFuerza();
          this.selectbuscarGranUnidad(this.idfuerza);
        },
  
        GuardarDatos(){
          let me = this;
          axios
          .post("/unidades/crearPeqUni", {
            id_fuerza:me.idfuerza,
            id_granunidad:me.idgranunidad,
            peq_unidad:me.peq_unidad,
            abreviatura:me.abreviatura,
            descripcion:me.descripcion,
            latitud:me.latitud,
            longitud:me.longitud,
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
          
          //console.log('descrip:'+this.descripcion+', obs:'+this.codigo);
        },
  
        AbrirModalEdit(id){
          console.log(id);
          let me = this;
          me.idE = id; //llamamos al id global
          axios
          .post("/unidades/datosCeo", {
            id: id
          })
          .then(function (response) {
            //Respuesta de la peticion
            console.log(response);
            me.nombreE = response.data.nombre;
            me.siglaE = response.data.sigla;
            me.descripcionE = response.data.descripcion;
            me.regionE = response.data.region;
            me.coordenadaE = response.data.coordenadas;
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
          .post("/unidades/editarCeo", {
            id:me.idE,
            nombre:me.nombreE,
            sigla:me.siglaE,
            descripcion:me.descripcionE,
            region:me.regionE,
            coordenadas:me.coordenadaE
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
          .post("/unidades/estadoCeo", {
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
  
        },

        selectFuerza(){
          let me =this;
          var url='/selectFuerza';
          axios.get(url).then(function (response) {
              var respuesta = response.data;
              console.log(respuesta);
              me.arrayFuerza = respuesta; 
          })
          .catch(function (error) {
          // handle error
          console.log(error);
          })
          .then(function () {
          // always executed
          });
        },

        changeItem1: function changeItem1(rowId, event) { 
          this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
          this.selectbuscarGranUnidad(event.target.value);
        },

        selectbuscarGranUnidad(dest)
        {
            let me =this;
            me.buscarD= dest;
            me.arrayGranunidad=[];
          //  me.prov_codigo=0;
            var url='/unidades/selectbuscarGranUnidad?buscar=' + dest;
            me.selected = url;
            axios.get(url).then(function (response) {

              var respuesta = response.data;
                me.arrayGranunidad = respuesta.gran_unidad; 
                
            })
            .catch(function (error) {
            // handle error 
            me.selected =error;
            console.log(error);
            })
            .then(function () {
              
            // always executed
            }); 
        },
  
  
      },
    }
  
    
  </script>
  
  <style>
  
  </style>