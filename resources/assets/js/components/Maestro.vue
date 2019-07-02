<template>
    
  <main class="content-wrapper">
       
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Maestros</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Escritorio</a></li>
              <li class="breadcrumb-item active">Maestros</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                  <i class="fa fa-align-justify"></i> Maestro
                  <button type="button" @click="abrirModal('maestro','registrar')" class="btn btn-secondary bg-primary ml-2 border-transparent " >
                    <i class="fa fa-plus"></i>&nbsp;Nuevo
                  </button>
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group row">
                  <div class="col-md-6">
                    <div class="input-group">
                      <select class="form-control col-md-3" id="opcion" name="opcion">
                        <option value="nombre">Nombre</option>
                        <option value="descripcion">Descripción</option>
                      </select>
                      <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar">
                      <button type="submit" class="btn btn-warning text-white rounded-0"><i class="fa fa-search"></i> Buscar</button>
                    </div>
                  </div>
                </div>
                <table class="table table-bordered   ">
                  <tr class="bg-info text-center ">
                    <th>Opciones</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Sexo</th>
                    <th>Grado de Instruccion</th>
                    <th>Dirección</th>
                    <th >Celular</th>
                    <th >Estado</th>

                  </tr>
                  <tr v-for="maestro in arrayMaestro" :key="maestro.id">
                    <td >
                        <button type="button" @click="abrirModal('maestro','actualizar',maestro)" class="btn btn-warning btn-sm" 
                          >
                          <i class="fa fa-pen"></i>
                        </button> &nbsp;
                        <button type="button" class="btn btn-danger btn-sm" 
                          >
                          <i class="fa fa-trash"></i>
                        </button>
                    </td>
                    <td v-text="maestro.nombre"></td>
                    <td v-text="maestro.apellido"></td>
                    <td v-text="maestro.fech_nacimiento"></td>
                    <td v-text="maestro.sexo"></td>
                    <td v-text="maestro.grado_instruccion"></td>
                    <td v-text="maestro.direccion"></td>
                    <td v-text="maestro.num_celular"></td>
                    <td>
                        <div v-if="maestro.condicion">
                            <span class="badge bg-success">Activo</span>
                        </div>
                        <div v-else>
                            <span class="badge bg-danger">Inactivo</span>
                        </div>
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
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!--Inicio del modal agregar/actualizar-->
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
                 <input type="text" v-model="nombre" class="form-control" placeholder="Nombre del Maestro(a)">
               </div>
               
             </div>
             <div class="form-group row">
               <label class="col-md-3 form-control-label" for="text-input">Apellidos </label>
               <div class="col-md-9">
                 <input type="text" v-model="apellido" class="form-control" placeholder="Apellido del Maestro(a)">
               </div>
               
             </div>
             <div class="form-group row">
               <label class="col-md-3 form-control-label" for="">Fecha de Nacimiento</label>
               <div class="col-md-9">
                 <input type="date" v-model="fech_nacimiento" class="form-control" placeholder="Ingrese la fecha de Nacimiento">
               </div>
             </div>
              <!-- <div class="form-group row">
               <label class="col-md-3 form-control-label" for="email-input">Sexo</label>
               <div class="col-md-9">
                 <input type="text" v-model="sexo" class="form-control" placeholder="Ingrese el sexo">
               </div>
             </div>  -->
            <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Sexo</label>
                <div class="col-md-9">
                    <select v-model="sexo" class="form-control">
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                        
                    </select>                                    
                </div>
            </div> 
             <!-- <div class="form-group row">
               <label class="col-md-3 form-control-label" for="email-input">Grado de Intrucción</label>
               <div class="col-md-9">
                 <input type="text" v-model="grado_instruccion" class="form-control" placeholder="Ingrese el grado de instruccion">
               </div>
             </div> -->
              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Grado de Instrucción</label>
                <div class="col-md-9">
                    <select v-model="grado_instruccion" class="form-control">
                        <option value="Docente">Docente</option>
                        <option value="Auxiliar">Auxiliar</option>
                        <option value="Licenciado">Licenciado</option>
                        <option value="Magister">Magister</option>
                        
                    </select>                                    
                </div>
            </div> 
             <div class="form-group row">
               <label class="col-md-3 form-control-label" for="email-input">Dirección de Domicilio</label>
               <div class="col-md-9">
                 <input type="text" v-model="direccion" class="form-control" placeholder="Ingrese la dirección de Domicilio">
               </div>
             </div>
             <div class="form-group row">
               <label class="col-md-3 form-control-label" for="email-input">Telefono</label>
               <div class="col-md-9">
                 <input type="tel" v-model="num_celular" class="form-control" placeholder="Ingrese el numero de Telefono">
               </div>
             </div>
              <div v-show="errorMaestro" class="form-group row div-error">
                <div class="text-center text-error">
                    <div v-for="error in errorMostrarMsjMaestro" :key="error" v-text="error">

                    </div>
                </div>
            </div>
           </form>
         </div>
         <div class="modal-footer">
           <button  @click="cerrarModal()" type="button" class="btn btn-danger" >Cerrar</button>
           <button v-if="tipoAccion==1" type="button" @click="registrarMaestro()" class="btn btn-primary">Guardar</button>
           <button v-if="tipoAccion==2" type="button" class="btn btn-primary">Actualizar</button>
         </div>
       </div>
       <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
   </div>
   <!--Fin del modal-->
   <!-- Inicio del modal Eliminar -->
   <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     style="display: none;" aria-hidden="true">
     <div class="modal-dialog modal-danger" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h4 class="modal-title">Eliminar Categoría</h4>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">×</span>
           </button>
         </div>
         <div class="modal-body">
           <p>Estas seguro de eliminar la categoría?</p>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
           <button type="button" class="btn btn-danger">Eliminar</button>
         </div>
       </div>
       <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
   </div>
   <!-- Fin del modal Eliminar -->

  </main>
 
  
</template>

<script>
    export default {
        data(){
            return{

                nombre:'',
                apellido:'',
                fech_nacimiento:'',
                sexo:'',
                grado_instruccion:'',
                direccion:'',
                num_celular:0,
                arrayMaestro:[],
                modal:0,
                tituloModal:'',
                tipoAccion:0,
                errorMaestro:0,
                errorMostrarMsjMaestro:[],


            }
        },
        methods:{
            listarMaestro(){
                let me= this;
                axios.get('/maestro').then(function (response) {
                    // var respuesta=response.data;
                    // // // handle success
                    // // console.log(response);
                    me.arrayMaestro=response.data;
                    // me.pagination=respuesta.pagination;
                    console.log(response);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            registrarMaestro(){
                 if (this.validarMaestro()){
                    return;
                }
                let me=this;
                axios.post('maestro/registrar',{
                    'nombre':this.nombre,
                    'apellido':this.apellido,
                    'fech_nacimiento':this.fech_nacimiento,
                    'sexo':this.sexo,
                    'grado_instruccion':this.grado_instruccion,
                    'direccion':this.direccion,
                    'num_celular': this.num_celular

                }
                ).then(function (response){
                    me.cerrarModal();
                    me.listarMaestro();
                }).catch(function(error){
                    console.log(error);
                });
            },
            abrirModal(modelo,accion,data= []){

                switch(modelo){
                    case "maestro":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Registrar Maestro';
                                this.nombre='';
                                this.apellido='';
                                this.fech_nacimiento='';
                                this.sexo='',
                                this.grado_instruccion='',
                                this.direccion='',
                                this.num_celular=0;
                                this.tipoAccion=1;
                            }
                            case 'actualizar':
                        }
                    }
                }
            },
            validarMaestro(){
                this.errorMaestro=0;
                this.errorMostrarMsjMaestro =[];

                if (!this.nombre) this.errorMostrarMsjMaestro.push("El nombre del Maestro no puede estar vacío.");
                if (!this.apellido) this.errorMostrarMsjMaestro.push("El apellido del Maestro no puede estar vacio.");

                if (this.errorMostrarMsjMaestro.length) this.errorMaestro = 1;

                return this.errorMaestro;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre='';
                this.apellido='';
                this.fech_nacimiento='';
                this.sexo='',
                this.grado_instruccion='',
                this.direccion='',
                this.num_celular=0;
                this.errorMaestro=0;
                
            },
        },
        mounted() {
           this.listarMaestro();
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
