<template>
    
  <main class="content-wrapper">
       
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Grados</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Escritorio</a></li>
              <li class="breadcrumb-item active">Grados</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                  <i class="fa fa-align-justify"></i> Grados
                  <button type="button" @click="abrirModal('grado','registrar')" class="btn btn-secondary bg-secondary ml-2 border-transparent " >
                    <i class="fa fa-plus"></i>&nbsp;Nuevo
                  </button>
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group row">
                  <div class="col-md-6">
                    <div class="input-group">
                      <select class="form-control col-md-3" v-model="criterio">
                        <option value="seccion">Sección</option>
                        <option value="grado">Grado</option>
                        <option value="turno">Turno</option>
                        
                      </select>
                      <input type="text" v-model="buscar" @keyup.enter="listarGrado(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                      <button type="submit" @click="listarGrado(1,buscar,criterio)" class="btn btn-warning text-white rounded-0"><i class="fa fa-search"></i> Buscar</button>
                    </div>
                  </div>
                </div>
                <table class="table table-bordered table-sm   ">
                  <tr class="bg-info text-center ">
                    <th>Opciones</th>
                    <th>Grado</th>
                    <th>Sección</th>
                    <th>Turno</th>
                    <th >Estado</th>

                  </tr>
                  <tr v-for="grado in arrayGrado" :key="grado.id">
                    <td >
                        <button type="button" @click="abrirModal('grado','actualizar',grado)" class="btn btn-warning btn-sm" 
                          >
                          <i class="fa fa-pen"></i>
                        </button> &nbsp;
                        <template v-if="grado.condicion">
                         <button type="button" class="btn btn-danger btn-sm" @click="desactivarGrado(grado.id)">
                          <i class="fa fa-trash"></i>
                        </button>
                        </template>
                        <template v-else>
                         <button type="button" class="btn btn-success btn-sm" @click="activarGrado(grado.id)">
                          <i class="fa fa-check"></i>
                        </button>
                        </template>
                    </td>
                    <td v-text="grado.grado"></td>
                    <td v-text="grado.seccion"></td>
                    <td v-text="grado.turno"></td>
                    
                    <td>
                        <div v-if="grado.condicion">
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
               <label class="col-md-3 form-control-label" for="text-input">Sección </label>
               <div class="col-md-9">
                 <input type="text" v-model="seccion" class="form-control" placeholder="Ingrese la sección">
               </div>
               
             </div> -->
             <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Grado</label>
                <div class="col-md-9">
                    <select v-model="grado" class="form-control">
                        <option value="gra" disabled>Selecciona el Grado</option>
                        <option value="primero">Primero</option>
                        <option value="segundo">Segundo</option>
                        <option value="tercero">Tercero</option>
                        <option value="cuarto">Cuarto</option>
                        <option value="quinto">Quinto</option>
                        <option value="sexto">Sexto</option>
                        
                    </select>                                    
                </div>
            </div> 
             <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Sección</label>
                <div class="col-md-9">
                    <select v-model="seccion" class="form-control">
                        <option value="seccion" disabled>Selecciona la Seccion</option>
                        <option value="A">Sección A</option>
                        <option value="B">Sección B</option>
                        <option value="C">Sección C</option>
                        <option value="D">Sección D</option>
                      
                        
                    </select>                                    
                </div>
            </div> 
             <!-- <div class="form-group row">
               <label class="col-md-3 form-control-label" for="text-input">Turno </label>
               <div class="col-md-9">
                 <input type="text" v-model="turno" class="form-control" placeholder="Ingrese el turno">
               </div>
               
             </div> -->
               <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Turno</label>
                <div class="col-md-9">
                    <select v-model="turno" class="form-control">
                        <option value="turno" disabled>Selecciona el turno</option>
                        <option value="Mañana">Mañana</option>
                        <option value="Tarde">Tarde</option>
                        
                    </select>                                    
                </div>
            </div> 
             
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
               
             
             
              <div v-show="errorGrado" class="form-group row div-error">
                <div class="text-center text-error">
                    <div v-for="error in errorMostrarMsjGrado" :key="error" v-text="error">
                        
                    </div>
                  
                </div>
            </div>
           </form>
         </div>
         <div class="modal-footer">
           <button  @click="cerrarModal()" type="button" class="btn btn-danger" >Cerrar</button>
           <button v-if="tipoAccion==1" type="button" @click="registrarGrado()" class="btn btn-primary">Guardar</button>
           <button v-if="tipoAccion==2" type="button" class="btn btn-primary" @click="actualizarGrado()">Actualizar</button>
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
                grado_id:'',
                grado:'',
                seccion:'',
                turno:'',
                
                arrayGrado:[],
                modal:0,
                tituloModal:'',
                tipoAccion:0,
                errorGrado:0,
                errorMostrarMsjGrado:[],
                pagination:{
                    'total':0,
                    'current_page':0,
                    'per_page':0,
                    'last_page':0,
                    'from':0,
                    'to':0,
                },
                offset:3,
                criterio:'seccion',
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
            listarGrado(page,buscar,criterio){
                let me= this;
                var url = '/grado?page='+page +'&buscar=' + buscar + '&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta=response.data;
                    // // // handle success
                    // // console.log(response);
                    me.arrayGrado=respuesta.grados.data;
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
                me.listarGrado(page,buscar,criterio);
            },
            registrarGrado(){
                 if (this.validarGrado()){
                    return;
                }
                let me=this;
                axios.post('grado/registrar',{
                    'grado':this.grado,
                    'seccion':this.seccion,
                    'turno':this.turno,
                    

                }
                ).then(function (response){
                    me.cerrarModal();
                    me.listarGrado(1,'','seccion');
                }).catch(function(error){
                    console.log(error);
                });
            },
            actualizarGrado(){
               if (this.validarGrado()){
                    return;
                }
                
                let me = this;

                axios.put('/grado/actualizar',{
                    'id': this.grado_id,
                    'grado':this.grado,
                   'seccion':this.seccion,
                    'turno':this.turno,
                   
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarGrado(1,'','seccion');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            desactivarGrado(id){
               const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
                })

                swalWithBootstrapButtons.fire({
                title: 'Esta de seguro de desactivar este Grado?',
                
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me=this;
                    axios.put('grado/desactivar',{
                       
                        'id':id
                    }
                    ).then(function (response){
                        
                        me.listarGrado(1,'','seccion');
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
            activarGrado(id){
                
               const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
                })

                swalWithBootstrapButtons.fire({
                title: 'Esta de seguro de activar este Grado?',
                
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me=this;
                    axios.put('grado/activar',{
                       
                        'id':id
                    }
                    ).then(function (response){
                        
                        me.listarGrado(1,'','seccion');
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
                    case "grado":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tipoAccion=1;
                                this.tituloModal='Registrar Grado';
                                this.grado='gra';
                                this.seccion='seccion';
                                this.turno='turno';
                                
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal=1;
                                this.tituloModal='Actualizar Grado';
                                this.tipoAccion=2;
                                this.grado_id=data['id'];
                                this.grado=data['grado']
                                this.seccion=data['seccion'];
                                this.turno=data['turno'];
                                
                                break;
                            }
                        }
                    }
                }
            },
            validarGrado(){
                this.errorGrado=0;
                this.errorMostrarMsjGrado =[];

                
                // if (this.turno=='turno') this.errorMostrarMsjGrado.push("El turno no puede estar vacio.");
               if (this.grado=='gra') this.errorMostrarMsjGradoMaestro.push("El grado no puede estar vacío.");
                if (this.seccion=='seccion') this.errorMostrarMsjGradoMaestro.push("La sección no puede estar vacío.");
                if (this.turno=='turno') this.errorMostrarMsjGradoMaestro.push("El turno no puede estar vacio.");

                if (this.errorMostrarMsjGrado.length) this.errorGrado = 1;

                return this.errorGrado;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.grado='';
                this.seccion='';
                this.turno='';
                this.errorGrado=0;
                
            },
        },
        mounted() {
           this.listarGrado(1,this.buscar,this.criterio);
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
