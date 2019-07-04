<template>
    
  <main class="content-wrapper">
       
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Simple Tables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Simple Tables</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                  <i class="fa fa-align-justify"></i> Alumnos
                  <button type="button" class="btn btn-secondary bg-info ml-2 border-transparent " @click="abrirModal('nuevo')">
                    <i class="fa fa-plus"></i>&nbsp;Nuevo
                  </button>
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group row">
                  <div class="col-md-6">
                    <div class="input-group">
                      <select class="form-control col-md-3" id="opcion" v-model="criterio">
                        <option value="nombre">Nombre</option>
                        <option value="apellido">Apellido</option>
                        <option value="seccion">Grado</option>
                      </select>
                      <input type="text" id="texto" v-model="buscar" class="form-control" placeholder="Texto a buscar">
                      <button type="submit" class="btn btn-warning text-white rounded-0" @key.up="listarAlumnos(criterio, buscar)"><i class="fa fa-search"></i> Buscar</button>
                    </div>
                  </div>
                </div>
                <table class="table table-striped">
                  <tr>
                    <th>Opciones</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Grado</th>
                    <th>Sexo</th>
                    <th>Fecha de nacimiento</th>
                    <th>Direccion</th>
                    <th>Condicion</th>
                  </tr>
                  <tr v-for="alumno in arrayAlumnos" :key="alumno.id">
                    <td>
                        <button type="button" class="btn btn-warning btn-sm" @click="abrirModal('actualizar', alumno)">
                          <i class="fa fa-pen"></i>
                        </button> &nbsp;
                        <button v-if="alumno.condicion" type="button" class="btn btn-danger btn-sm" @click="desactivarAlumno(alumno.id)">
                          <i class="fa fa-trash"></i>
                        </button>
                        <button style="background-color: green" v-else type="button" class="btn btn-danger btn-sm" @click="activarAlumno(alumno.id)">
                          <i class="fa fa-check"></i>
                        </button>
                    </td>
                    <td v-text="alumno.nombre"></td>
                    <td v-text="alumno.apellido"></td>
                    <td v-text="alumno.seccion"></td>
                    <td v-text="alumno.sexo"></td>
                    <td v-text="alumno.fech_nacimiento"></td>
                    <td v-text="alumno.direccion"></td>
                    <td>
                      <span class="badge bg-success" v-if="alumno.condicion">Activo</span>
                      <span class="badge bg-danger" v-else>Inactivo</span>
                    </td>
                  </tr>
                                  
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
              </div>
            </div>
            <!-- /.card -->

          
          </div>
          <!-- /.col -->
          
        </div>
        <!-- /.row -->

   <div class="modal fade" :class="{'mostrar': modal} " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     style="display: none;" aria-hidden="true">
     <div class="modal-dialog modal-primary modal-lg" role="document">
       <div class="modal-content">
         <div class="modal-header bg-info">
           <h4 class="modal-title" v-text="tituloModal" ></h4>
           <button @click="cerrarModal()" type="button" class="close"  aria-label="Close">
             <span aria-hidden="true">×</span>
           </button>
         </div>
         <div class="modal-body">
           <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
             <div class="form-group row">
               <label class="col-md-3 form-control-label" for="text-input">Nombre </label>
               <div class="col-md-9">
                 <input type="text" v-model="nombre" class="form-control" placeholder="Nombre del Alumno(a)">
               </div>
               
             </div>
             <div class="form-group row">
               <label class="col-md-3 form-control-label" for="text-input">Apellidos </label>
               <div class="col-md-9">
                 <input type="text" v-model="apellido" class="form-control" placeholder="Apellido del Alumno(a)">
               </div>
               
             </div>
             <div class="form-group row">
               <label class="col-md-3 form-control-label" for="">Fecha de Nacimiento</label>
               <div class="col-md-9">
                 <input type="date" v-model="fech_nacimiento" class="form-control" placeholder="Ingrese la fecha de Nacimiento">
               </div>
             </div>

            <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Sexo</label>
                <div class="col-md-9">
                    <select v-model="sexo" class="form-control">
                        <option value="" disabled>Seleccione su sexo</option>
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                        
                    </select>                                    
                </div>
            </div> 

            <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Grado</label>
                <div class="col-md-9">
                    <select v-model="grado_id" class="form-control">
                        <option value="0">Seleccione grado</option>
                        <option :value="grado.id" v-for="grado in arrayGrados" :key="grado.id" v-text="grado.seccion"></option>
                        
                    </select>                                    
                </div>
            </div> 
             <div class="form-group row">
               <label class="col-md-3 form-control-label" for="email-input">Dirección de Domicilio</label>
               <div class="col-md-9">
                 <input type="text" v-model="direccion" class="form-control" placeholder="Ingrese la dirección de Domicilio">
               </div>
             </div>

              <div v-show="errorAlumno" class="form-group row div-error">
                <div class="text-center text-error">
                    <div v-for="error in errorMostrarMsjAlumno" :key="error" v-text="error">

                    </div>
                </div>
            </div>
           </form>
         </div>
         <div class="modal-footer">
           <button  @click="cerrarModal()" type="button" class="btn btn-danger" >Cerrar</button>
           <button v-if="accion==1" type="button" @click="registrarAlumno()" class="btn btn-primary">Guardar</button>
           <button v-if="accion==2" type="button" @click="actualizarAlumno()" class="btn btn-primary">Actualizar</button>
         </div>
       </div>
       <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
   </div>
   <!--Fin del modal-->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  </main>
 
  
</template>

<script>
    export default {

        data() {
          return {
            alumno_id: 0,
            grado_id : 0,
            nombre: '',
            apellido: '',
            sexo: '',
            fech_nacimiento: '',
            direccion: '',
            criterio: 'nombre',
            buscar: '',
            arrayAlumnos: [],
            arrayGrados: [],
            tituloModal: '',
            modal: 0,
            errorAlumno: 0,
            errorMostrarMsjAlumno: [],
            accion: 0
          }
        },

        methods: {
          listarAlumnos(){
            let me = this;
            axios.get('/alumno').then(function (response) {
                    var respuesta=response.data;
                    me.arrayAlumnos= respuesta.alumnos;
                    me.arrayGrados= respuesta.grados;
                    // me.pagination=respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
          },
          registrarAlumno(){
            let me = this;
            axios.post('/alumno/registrar', {
                'grado_id': this.grado_id,
                'nombre': this.nombre,
                'apellido': this.apellido,
                'sexo': this.sexo,
                'fech_nacimiento': this.fech_nacimiento,
                'direccion': this.direccion
            })
                .then(function (response) {
                    me.cerrarModal();
                    me.listarAlumnos();
                })
                .catch(function (error) {
                    console.log(error);
                });
          },
          actualizarAlumno(){
            let me = this;
            axios.put('/alumno/actualizar', {
                'id': this.alumno_id,
                'grado_id': this.grado_id,
                'nombre': this.nombre,
                'apellido': this.apellido,
                'sexo': this.sexo,
                'fech_nacimiento': this.fech_nacimiento,
                'direccion': this.direccion
            })
                .then(function (response) {
                    me.cerrarModal();
                    me.listarAlumnos();
                })
                .catch(function (error) {
                    console.log(error);
                });
          },
          desactivarAlumno(id){
            let me = this;
            axios.put('/alumno/desactivar', {
                'id': id
            })
                .then(function (response) {
                    me.listarAlumnos();
                })
                .catch(function (error) {
                    console.log(error);
                });
          },
          activarAlumno(id){
            let me = this;
            axios.put('/alumno/activar', {
                'id': id
            })
                .then(function (response) {
                    me.listarAlumnos();
                })
                .catch(function (error) {
                    console.log(error);
                });
          },
          abrirModal(accion, data = []){
            switch(accion) {
              case("nuevo"):{
                  this.modal = 1;
                  this.nombre = '';
                  this.apellido = '';
                  this.grado_id = 0;
                  this.sexo = '';
                  this.fech_nacimiento = '';
                  this.direccion = '';
                  this.accion = 1;
                  this.tituloModal = 'Nuevo ALumno';
              break;
              }
              case("actualizar"):{
                  this.modal = 1;
                  this.nombre = data['nombre'];
                  this.apellido = data['apellido'];
                  this.grado_id = data['grado_id'];
                  this.alumno_id = data['id'];
                  this.sexo = data['sexo'];
                  this.fech_nacimiento = data['fech_nacimiento'];
                  this.direccion = data['direccion'];
                  this.accion = 2;
                  this.tituloModal = 'Actualizar ALumno';
              break;
              }
            }
          },
          cerrarModal(){
            this.modal = 0;
            this.tituloModal='';
            this.nombre='';
            this.apellido='';
            this.fech_nacimiento='';
            this.sexo='',
            this.grado_id='',
            this.direccion='',
            this.errorAlumno=0;
          }
        },

        mounted() {
            this.listarAlumnos();
        }
    }
</script>

<style >
    .modal-content{
        width: 100%;
        position: absolute !important;
        top: 5rem;
        border-radius: 10px!important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
       
        background-color: #3c29297a !important;
        transition: all .5s ease-in-out !important;
    }
    .mostrar:hover{
        opacity: 2 !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>