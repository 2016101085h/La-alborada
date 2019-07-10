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
                  <button type="button" @click="abrirModal('maestro','registrar')" class="btn btn-secondary bg-secondary ml-2 border-transparent " >
                    <i class="fa fa-plus"></i>&nbsp;Nuevo
                  </button>
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group row">
                  <div class="col-md-6">
                    <div class="input-group">
                      <select class="form-control col-md-3" v-model="criterio">
                        <option value="nombre">Nombre</option>
                        <option value="apellido">Apellidos</option>
                        <option value="sexo">Sexo</option>
                        
                      </select>
                      <input type="text" v-model="buscar" @keyup.enter="listarMaestro(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                      <button type="submit" @click="listarMaestro(1,buscar,criterio)" class="btn btn-warning text-white rounded-0"><i class="fa fa-search"></i> Buscar</button>
                    </div>
                  </div>
                </div>
                <table class="table table-bordered  table-sm  ">
                  <tr class="bg-info text-center ">
                    <th>Opciones</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Sexo</th>
                    <th>Grado de Instruccion</th>
                    <th>Dni</th>
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
                        <template v-if="maestro.condicion">
                         <button type="button" class="btn btn-danger btn-sm" @click="desactivarMaestro(maestro.id)">
                          <i class="fa fa-trash"></i>
                        </button>
                        </template>
                        <template v-else>
                         <button type="button" class="btn btn-success btn-sm" @click="activarMaestro(maestro.id)">
                          <i class="fa fa-check"></i>
                        </button>
                        </template>
                    </td>
                    <td v-text="maestro.nombre"></td>
                    <td v-text="maestro.apellido"></td>
                    <td v-text="maestro.fech_nacimiento"></td>
                    <td v-text="maestro.sexo"></td>
                    <td v-text="maestro.grado_instruccion"></td>
                    <td v-text="maestro.dni"></td>
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
                    <li class="page-item" v-if="pagination.current_page > 1">
                      <a class="page-link" href="#" @click.prevent="cambiarpagina(pagination.current_page - 1,buscar,criterio)" >&laquo;</a>
                    </li>
                    <li class="page-item " v-for="page in pagesNumber" :key="page" :class = "[page == isActived ? 'active' :'' ]">
                        <a class="page-link" href="#" @click.prevent="cambiarpagina(page,buscar,criterio)" v-text="page"></a>
                    </li>
                  
                     <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                         <a class="page-link" href="#" @click.prevent="cambiarpagina(pagination.current_page + 1,buscar,criterio)">&raquo;</a>
                     </li>
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
                        <option value="sexo" disabled>Selecciona tu sexo</option>
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
                <label class="col-md-3 form-control-label" for="text-input">Grado Académico</label>
                <div class="col-md-9">
                    <select v-model="grado_instruccion" class="form-control">
                        <option value="grado" disabled>Selecciona su Grado Académico</option>
                        <option value="Docente">Docente</option>
                        <option value="Auxiliar">Auxiliar</option>
                        <option value="Licenciado">Licenciado</option>  
                        <option value="Magister">Magister</option>
                        
                    </select>                                    
                </div>
            </div> 
             <div class="form-group row">
               <label class="col-md-3 form-control-label" for="email-input">Dni</label>
               <div class="col-md-9">
                 <input type="number" v-model="dni" class="form-control" placeholder="Ingrese el documento de Identidad">
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
                 <input type="number" v-model="num_celular" class="form-control" placeholder="Ingrese el numero de Telefono">
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
           <button v-if="tipoAccion==2" type="button" class="btn btn-primary" @click="actualizarMaestro()">Actualizar</button>
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
           <p>Estas seguro de eliminar el Maestro?</p>
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
                maestro_id:'',
                nombre:'',
                apellido:'',
                fech_nacimiento:'',
                sexo:'',
                grado_instruccion:'',
                dni:0,
                direccion:'',
                num_celular:0,
                arrayMaestro:[],
                modal:0,
                tituloModal:'',
                tipoAccion:0,
                errorMaestro:0,
                errorMostrarMsjMaestro:[],
                pagination:{
                    'total':0,
                    'current_page':0,
                    'per_page':0,
                    'last_page':0,
                    'from':0,
                    'to':0,
                },
                offset:3,
                criterio:'nombre',
                buscar:''


            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //calcula los elemenos de la paginacion
            pagesNumber: function(){
                if(!this.pagination.to){
                    return [];
                }
                var from = this.pagination.current_page-this.offset;
                if(from<1){
                    from=1;
                }
                var to = from+(this.offset*2);
                if(to>=this.pagination.last_page){
                    to=this.pagination.last_page;
                }
                var pagesArray=[];
                while(from <= to){

                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        methods:{
            listarMaestro(page,buscar,criterio){
                let me= this;
                var url = '/maestro?page='+page +'&buscar=' + buscar + '&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta=response.data;
                    // // // handle success
                    // // console.log(response);
                    me.arrayMaestro=respuesta.personas.data;
                        me.pagination=respuesta.pagination;
                    
                    console.log(response);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
             cambiarpagina(page,buscar,criterio){
                let me = this;
                //Actualiza la pagina actual
                me.pagination.current_page = page;

                //Envia la peticion para visualizar la data de esa pagina
                me.listarMaestro(page,buscar,criterio);
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
                    'dni':this.dni,
                    'direccion':this.direccion,
                    'num_celular': this.num_celular

                }
                ).then(function (response){
                    me.cerrarModal();
                    me.listarMaestro(1,'','nombre');
                }).catch(function(error){
                    console.log(error);
                });
            },
            actualizarMaestro(){
               if (this.validarMaestro()){
                    return;
                }
                
                let me = this;

                axios.put('/maestro/actualizar',{
                    'id': this.maestro_id,
                   'nombre':this.nombre,
                    'apellido':this.apellido,
                    'fech_nacimiento':this.fech_nacimiento,
                    'sexo':this.sexo,
                    'grado_instruccion':this.grado_instruccion,
                    'dni':this.dni,
                    'direccion':this.direccion,
                    'num_celular': this.num_celular
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarMaestro(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            desactivarMaestro(id){
               const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
                })

                swalWithBootstrapButtons.fire({
                title: 'Esta de seguro de desactivar este Maestro?',
                
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me=this;
                    axios.put('maestro/desactivar',{
                       
                        'id':id
                    }
                    ).then(function (response){
                        
                        me.listarMaestro(1,'','nombre');
                          swalWithBootstrapButtons.fire(
                            'Desactivado!',
                            'El registro ha sido desactivado con exito.',
                            'success'
                            )
                    }).catch(function(error){
                        console.log(error);
                    });
                  
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                    )
                }
                }) 
            },
            activarMaestro(id){
                
               const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
                })

                swalWithBootstrapButtons.fire({
                title: 'Esta de seguro de activar este Maestro?',
                
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me=this;
                    axios.put('maestro/activar',{
                       
                        'id':id
                    }
                    ).then(function (response){
                        
                        me.listarMaestro(1,'','nombre');
                          swalWithBootstrapButtons.fire(
                            'Activado!',
                            'El registro ha sido activado con exito.',
                            'success'
                            )
                    }).catch(function(error){
                        console.log(error);
                    });
                  
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                    )
                }
                }) 
            },
            
            abrirModal(modelo,accion,data= []){

                switch(modelo){
                    case "maestro":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tipoAccion=1;
                                this.tituloModal='Registrar Maestro';
                                this.nombre='';
                                this.apellido='';
                                this.fech_nacimiento='';
                                this.sexo='sexo',
                                this.grado_instruccion='grado',
                                this.dni=0,
                                this.direccion='',
                                this.num_celular=0;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal=1;
                                this.tituloModal='Actualizar Maestro';
                                this.tipoAccion=2;
                                this.maestro_id=data['id'];
                                this.nombre=data['nombre'];
                                this.apellido=data['apellido'];
                                this.fech_nacimiento=data['fech_nacimiento'];
                                this.sexo=data['sexo'],
                                this.grado_instruccion=data['grado_instruccion'],
                                this.dni=data['dni'],
                                this.direccion=data['direccion'],
                                this.num_celular=data['num_celular'];
                                break;
                            }
                        }
                    }
                }
            },
            validarMaestro(){
                this.errorMaestro=0;
                this.errorMostrarMsjMaestro =[];

                if (!this.nombre) this.errorMostrarMsjMaestro.push("El nombre del Maestro no puede estar vacío.");
                if (!this.apellido) this.errorMostrarMsjMaestro.push("El apellido del Maestro no puede estar vacio.");
                if (this.sexo=='sexo') this.errorMostrarMsjMaestro.push("El campo de sexo no puede estar vacío");
                if (this.grado_instruccion=='grado') this.errorMostrarMsjMaestro.push("El campo de Grado de Instruccion no puede estar vacío    ");
                if (this.num_celular.length<9 || this.num_celular.length>9) this.errorMostrarMsjMaestro.push("El telefono debe del Maestro debe contener 9 digitos.");

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
                this.dni='',
                this.direccion='',
                this.num_celular=0;
                this.errorMaestro=0;
                
            },
        },
        mounted() {
           this.listarMaestro(1,this.buscar,this.criterio);
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
