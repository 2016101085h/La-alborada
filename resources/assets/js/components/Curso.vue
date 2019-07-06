<template>
    
  <main class="content-wrapper">
       
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cursos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Escritorio</a></li>
              <li class="breadcrumb-item active">Cursos</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                  <i class="fa fa-align-justify"></i> Cursos
                  <button type="button" @click="abrirModal('curso','registrar')" class="btn btn-secondary bg-secondary ml-2 border-transparent " >
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
                        <option value="grado">Grado</option>
                        
                      </select>
                      <input type="text" v-model="buscar" @keyup.enter="listarCurso(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                      <button type="submit" @click="listarCurso(1,buscar,criterio)" class="btn btn-warning text-white rounded-0"><i class="fa fa-search"></i> Buscar</button>
                    </div>
                  </div>
                </div>
                <table class="table table-bordered  table-sm  ">
                  <tr class="bg-info text-center ">
                    <th>Opciones</th>
                    <th>Nombre</th>
                   
                   
                    <th >Estado</th>

                  </tr>
                  <tr v-for="curso in arrayCurso" :key="curso.id">
                    <td >
                        <button type="button" @click="abrirModal('curso','actualizar',curso)" class="btn btn-warning btn-sm" 
                          >
                          <i class="fa fa-pen"></i>
                        </button> &nbsp;
                        <template v-if="curso.condicion">
                         <button type="button" class="btn btn-danger btn-sm" @click="desactivarCurso(curso.id)">
                          <i class="fa fa-trash"></i>
                        </button>
                        </template>
                        <template v-else>
                         <button type="button" class="btn btn-success btn-sm" @click="activarCurso(curso.id)">
                          <i class="fa fa-check"></i>
                        </button>
                        </template>
                    </td>
                    <td v-text="curso.nombre"></td>
                                                 
                    
                    
                    <td>
                        <div v-if="curso.condicion">
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
                 <input type="text" v-model="nombre" class="form-control" placeholder="Nombre del Curso">
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
               <label class="col-md-3 form-control-label" for="email-input">Sexo</label>
               <div class="col-md-9">
                 <input type="text" v-model="sexo" class="form-control" placeholder="Ingrese el sexo">
               </div>
             </div>  -->
            
             <!-- <div class="form-group row">
               <label class="col-md-3 form-control-label" for="email-input">Grado de Intrucción</label>
               <div class="col-md-9">
                 <input type="text" v-model="grado_instruccion" class="form-control" placeholder="Ingrese el grado de instruccion">
               </div>
             </div> -->
              
             
           
              <div v-show="errorCurso" class="form-group row div-error">
                <div class="text-center text-error">
                    <div v-for="error in errorMostrarMsjCurso" :key="error" v-text="error">
                        
                    </div>
                  
                </div>
            </div>
           </form>
         </div>
         <div class="modal-footer">
           <button  @click="cerrarModal()" type="button" class="btn btn-danger" >Cerrar</button>
           <button v-if="tipoAccion==1" type="button" @click="registrarCurso()" class="btn btn-primary">Guardar</button>
           <button v-if="tipoAccion==2" type="button" class="btn btn-primary" @click="actualizarCurso()">Actualizar</button>
         </div>
       </div>
       <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
   </div>
   <!--Fin del modal-->
 

  </main>
 
  
</template>

<script>
    export default {
        data(){
            return{
                curso_id:'',
                nombre:'',
              
                arrayCurso:[],
                modal:0,
                tituloModal:'',
                tipoAccion:0,
                errorCurso:0,
                errorMostrarMsjCurso:[],
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
                arrayGrado:[],
                arrayMaestro:[],


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
            listarCurso(page,buscar,criterio){
                let me= this;
                var url = '/curso?page='+page +'&buscar=' + buscar + '&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta=response.data;
                    // // // handle success
                    // // console.log(response);
                    me.arrayCurso=respuesta.cursos.data;
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
                me.listarCurso(page,buscar,criterio);
            },
            registrarCurso(){
                 if (this.validarCurso()){
                    return;
                }
                let me=this;
                axios.post('curso/registrar',{
                    'nombre':this.nombre,
                    
                   

                    

                }
                ).then(function (response){
                    me.cerrarModal();
                    me.listarCurso(1,'','nombre');
                }).catch(function(error){
                    console.log(error);
                });
            },
            actualizarCurso(){
               if (this.validarCurso()){
                    return;
                }
                
                let me = this;

                axios.put('/curso/actualizar',{
                    'id':this.curso_id,
                    'nombre':this.nombre,
                    
                    
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarCurso(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            desactivarCurso(id){
               const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
                })

                swalWithBootstrapButtons.fire({
                title: 'Esta de seguro de desactivar este Curso?',
                
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me=this;
                    axios.put('curso/desactivar',{
                       
                        'id':id
                    }
                    ).then(function (response){
                        
                        me.listarCurso(1,'','nombre');
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
            activarCurso(id){
                
               const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
                })

                swalWithBootstrapButtons.fire({
                title: 'Esta de seguro de activar este Curso?',
                
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me=this;
                    axios.put('curso/activar',{
                       
                        'id':id
                    }
                    ).then(function (response){
                        
                        me.listarCurso(1,'','nombre');
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
                    case "curso":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tipoAccion=1;
                                this.tituloModal='Registrar Curso';
                                this.nombre='';
                               
                                
                               
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal=1;
                                this.tituloModal='Actualizar Curso';
                                this.tipoAccion=2;
                                this.curso_id=data['id'];
                                this.nombre=data['nombre'];
                                
                               
                                
                               
                                break;
                            }
                        }
                    }
                   

                }
            },
            validarCurso(){
                this.errorCurso=0;
                this.errorMostrarMsjCurso =[];

                if (!this.nombre) this.errorMostrarMsjCurso.push("El nombre del Curso no puede estar vacío.");

                

                if (this.errorMostrarMsjCurso.length) this.erroCurso = 1;

                return this.errorCurso;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre='';
               
                
               
                this.errorCurso=0;
                
            },
        },
        mounted() {
           this.listarCurso(1,this.buscar,this.criterio);
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
