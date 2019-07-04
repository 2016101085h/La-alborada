<template>
    
  <main class="content-wrapper">
       
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Asignaturas de Maestros</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Escritorio</a></li>
              <li class="breadcrumb-item active">Asignaturas de Maestros</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                  <i class="fa fa-align-justify"></i> Asignaturas de Maestros
                  <button type="button" @click="abrirModal('maestroasignatura','registrar')" class="btn btn-secondary bg-secondary ml-2 border-transparent " >
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
                        <option value="sexo">Sexo</option>
                        
                      </select>
                      <input type="text" v-model="buscar" @keyup.enter="listarMaestroAsignatura(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                      <button type="submit" @click="listarMaestroAsignatura(1,buscar,criterio)" class="btn btn-warning text-white rounded-0"><i class="fa fa-search"></i> Buscar</button>
                    </div>
                  </div>
                </div>
                <table class="table table-bordered   ">
                  <tr class="bg-info text-center ">
                    <th>Opciones</th>
                    <th>Nombre de Maestro</th>
                    
                    <th>Asignatura</th>
                    <th >Estado</th>

                  </tr>
                  <tr v-for="maestroasignatura in arrayMaestroAsignatura" :key="maestroasignatura.id">
                    <td >
                        <button type="button" @click="abrirModal('maestroasignatura','actualizar',maestroasignatura)" class="btn btn-warning btn-sm" 
                          >
                          <i class="fa fa-pen"></i>
                        </button> &nbsp;
                        <template v-if="maestroasignatura.condicion">
                         <button type="button" class="btn btn-danger btn-sm" @click="desactivarMaestroAsignatura(maestroasignatura.id)">
                          <i class="fa fa-trash"></i>
                        </button>
                        </template>
                        <template v-else>
                         <button type="button" class="btn btn-success btn-sm" @click="activarMaestroAsignatura(maestroasignatura.id)">
                          <i class="fa fa-check"></i>
                        </button>
                        </template>
                    </td>
                    <td v-text="maestroasignatura.nombre+ maestroasignatura.apellido"></td>
                    
                    <td v-text="maestroasignatura.nombre_asignatura"></td>                 
                    
                    
                    <td>
                        <div v-if="maestroasignatura.condicion">
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
             <!-- <div class="form-group row">
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
               
             </div> -->
            <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Maestro</label>
                <div class="col-md-9">
                    <select v-model="maestro_id" class="form-control">
                        <option value="0" disabled>Selecciona el Maestro</option>
                        <option v-for="maestro in arrayMaestro " :key="maestro.id" :value="maestro.id" v-text="maestro.nombre+' - '+maestro.apellido"></option>
                        
                        
                    </select>                                    
                </div>
            </div> 
            <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Asignatura</label>
                <div class="col-md-9">
                    <select v-model="asignatura_id" class="form-control">
                        <option value="1" disabled>Selecciona la Asignatura</option>
                        <option v-for="asignatura in arrayAsignatura " :key="asignatura.id" :value="asignatura.id" v-text="asignatura.nombre"></option>
                        
                        
                    </select>                                    
                </div>
            </div> 
            <!-- <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Sección</label>
                <div class="col-md-9">
                    <select v-model="seccion_grado" class="form-control">
                        <option value="2" disabled>Selecciona la Sección</option>
                        <option v-for="grado in arrayGrado " :key="grado.id" :value="grado.id" v-text="grado.seccion"></option>
                        
                        
                    </select>                                    
                </div>
            </div>  -->
            <!-- <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Turno</label>
                <div class="col-md-9">
                    <select v-model="turno_grado" class="form-control">
                        <option value="3" disabled>Selecciona el Turno</option>
                        <option v-for="grado in arrayGrado " :key="grado.id" :value="grado.id" v-text="grado.turno"></option>
                        
                        
                    </select>                                    
                </div>
            </div>  -->
             
             <!-- <div class="form-group row">
               <label class="col-md-3 form-control-label" for="email-input">Grado de Intrucción</label>
               <div class="col-md-9">
                 <input type="text" v-model="grado_instruccion" class="form-control" placeholder="Ingrese el grado de instruccion">
               </div>
             </div> -->
              
           
           
              <div v-show="errorMaestroAsignatura" class="form-group row div-error">
                <div class="text-center text-error">
                    <div v-for="error in errorMostrarMsjMaestroAsignatura" :key="error" v-text="error">
                        
                    </div>
                  
                </div>
            </div>
           </form>
         </div>
         <div class="modal-footer">
           <button  @click="cerrarModal()" type="button" class="btn btn-danger" >Cerrar</button>
           <button v-if="tipoAccion==1" type="button" @click="registrarMaestroAsignatura()" class="btn btn-primary">Guardar</button>
           <button v-if="tipoAccion==2" type="button" class="btn btn-primary" @click="actualizarMaestroAsignatura()">Actualizar</button>
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
                maestroasignatura_id:'',
                maestro_id:0,
                nombre:'',
                apellido:'',
                asignatura_id:0,
                nombre_asignatura:'',
                
                arrayMaestroAsignatura:[],
                modal:0,
                tituloModal:'',
                tipoAccion:0,
                errorMaestroAsignatura:0,
                errorMostrarMsjMaestroAsignatura:[],
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
                buscar:'',
                arrayMaestro:[],
                arrayAsignatura:[],



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
            listarMaestroAsignatura(page,buscar,criterio){
                let me= this;
                var url = '/maestroasignatura?page='+page +'&buscar=' + buscar + '&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta=response.data;
                    // // // handle success
                    // // console.log(response);
                    me.arrayMaestroAsignatura=respuesta.maestroasignaturas.data;
                        me.pagination=respuesta.pagination;
                    
                    console.log(response);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            selectMaestro(){
                 let me= this;
                var url = '/maestro/selectMaestro';
                axios.get(url).then(function (response) {
                    var respuesta=response.data;
                    // // // handle success
                    // // console.log(response);
                    me.arrayMaestro=respuesta.maestros;
                        // me.pagination=respuesta.pagination;
                    
                    console.log(response);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            selectAsignatura(){
                 let me= this;
                var url = '/asignatura/selectAsignatura';
                axios.get(url).then(function (response) {
                    var respuesta=response.data;
                    // // // handle success
                    // // console.log(response);
                    me.arrayAsignatura=respuesta.asignaturas;
                        // me.pagination=respuesta.pagination;
                    
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
                me.listarMaestroAsignatura(page,buscar,criterio);
            },
            registrarMaestroAsignatura(){
                 if (this.validarMaestroAsignatura()){
                    return;
                }
                let me=this;
                axios.post('maestroasignatura/registrar',{
                    'maestro_id':this.maestro_id,
                    'nombre':this.nombre,
                    'apellido':this.apellido,
                    'asignatura_id':this.asignatura_id,
                    'nombre_asignatura': this.nombre_asignatura,
                    
                   
                    

                }
                ).then(function (response){
                    me.cerrarModal();
                    me.listarMaestroAsignatura(1,'','nombre');
                }).catch(function(error){
                    console.log(error);
                });
            },
            actualizarMaestroAsignatura(){
               if (this.validarMaestroAsignatura()){
                    return;
                }
                
                let me = this;

                axios.put('/maestroasignatura/actualizar',{
                    'maestro_id':this.maestro_id,
                    'id': this.maestroasignatura_id,
                    'nombre':this.nombre,
                    'apellido':this.apellido,
                     'asignatura_id': this.asignatura_id,
                    'nombre_asignatura':this.nombre_asignatura,
                    
                    
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarMaestroAsignatura(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            desactivarMaestroAsignatura(id){
               const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
                })

                swalWithBootstrapButtons.fire({
                title: 'Esta de seguro de desactivar este Alumno?',
                
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me=this;
                    axios.put('maestroasignatura/desactivar',{
                       
                        'id':id
                    }
                    ).then(function (response){
                        
                        me.listarMaestroAsignatura(1,'','nombre');
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
            activarMaestroAsignatura(id){
                
               const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
                })

                swalWithBootstrapButtons.fire({
                title: 'Esta de seguro de activar este Alumno?',
                
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me=this;
                    axios.put('maestroasignatura/activar',{
                       
                        'id':id
                    }
                    ).then(function (response){
                        
                        me.listarMaestroAsignatura(1,'','nombre');
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
                    case "maestroasignatura":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tipoAccion=1;
                                this.tituloModal='Registrar Alumno';
                                this.maestro_id='0';
                                this.nombre='';
                                this.apellido='';
                                this.asignatura_id='1';
                                this.nombre_asignatura='';
                                
                               
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal=1;
                                this.tituloModal='Actualizar Alumno';
                                this.tipoAccion=2;
                                this.maestroasignatura_id=data['id'];
                                this.maestro_id=data['maestro_id']
                                this.nombre=data['nombre'];
                                this.apellido=data['apellido'];
                                // this.grado=data['grado'];
                                // this.seccion_grado=data['seccion_grado'];
                                // this.turno_grado=data['turno_grado'];
                                this.asignatura_id=data['asignatura_id'];
                                this.nombre_asignatura=data['nombre_asignatura'];
                                
                               
                                break;
                            }
                        }
                    }
                    this.selectMaestro();
                    this.selectAsignatura();
                }
            },
            validarMaestroAsignatura(){
                this.errorMaestroAsignatura=0;
                this.errorMostrarMsjMaestroAsignatura =[];

                // if (this.nombre=='') this.errorMostrarMsjMaestroAsignatura.push("El nombre del MaestroAsignatura no puede estar vacío.");
                // if (this.apellido=='') this.errorMostrarMsjMaestroAsignatura.push("El apellido del MaestroAsignatura no puede estar vacio.");
                // if (this.sexo=='sexo') this.errorMostrarMsjMaestroAsignatura.push("El campo de sexo no puede estar vacío");
                // if (this.grado=='0') this.errorMostrarMsjAlumno.push("El campo de grado no puede estar vacío");

                if (this.errorMostrarMsjMaestroAsignatura.length) this.errorMaestroAsignatura = 1;

                return this.errorMaestroAsignatura;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.maestro_id='';
                this.nombre='';
                this.apellido='';
                this.asignatura_id='';
               
                this.nombre_asignatura='';
               
                this.errorMaestroAsignatura=0;
                
            },
        },
        mounted() {
           this.listarMaestroAsignatura(1,this.buscar,this.criterio);
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
