<template>
    
  <main class="content-wrapper">
       
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Aula de los Maestros</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Escritorio</a></li>
              <li class="breadcrumb-item active">Aula de los Maestros</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                  <i class="fa fa-align-justify"></i> Grados de Maestros
                  <button type="button" @click="abrirModal('maestroaula','registrar')" class="btn btn-secondary bg-secondary ml-2 border-transparent " >
                    <i class="fa fa-plus"></i>&nbsp;Nuevo
                  </button>
                  <button type="button" @click="cargarPdf()" class="btn btn-secondary bg-primary ml-2 border-dark  " style="background-color:#ABEBC6">
                    <i class="fas fa-file"></i>&nbsp;Reporte
                  </button>
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group row">
                  <div class="col-md-6">
                    <div class="input-group">
                      <select class="form-control col-md-3" v-model="criterio">
                        <option value="grado">Grado</option>
                        <option value="nombre">Nombre</option>
                        
                        
                        
                      </select>
                      <input type="text" v-model="buscar" @keyup.enter="listarMaestroAula(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                      <button type="submit" @click="listarMaestroAula(1,buscar,criterio)" class="btn btn-warning text-white rounded-0"><i class="fa fa-search"></i> Buscar</button>
                    </div>
                  </div>
                </div>
                <table class="table table-bordered table-sm ">
                  <tr class="bg-info text-center ">
                    <th>Opciones</th>
                    <th>Maestro</th>

                    <th>Grado</th>
                    <th>Sección</th>
                
                    
                                      
                    <th >Estado</th>

                  </tr>
                  <tr v-for="maestroaula in arrayMaestroAula" :key="maestroaula.id">
                    <td >
                        <button type="button" @click="abrirModal('maestroaula','actualizar',maestroaula)" class="btn btn-warning btn-sm" 
                          >
                          <i class="fa fa-pen"></i>
                        </button> &nbsp;
                        <template v-if="maestroaula.condicion">
                         <button type="button" class="btn btn-danger btn-sm" @click="desactivarMaestroAula(maestroaula.id)">
                          <i class="fa fa-trash"></i>
                        </button>
                        </template>
                        <template v-else>
                         <button type="button" class="btn btn-primary btn-sm" @click="activarMaestroAula(maestroaula.id)">
                          <i class="fa fa-check"></i>
                        </button>
                        </template>
                    </td>
                    <td v-text="maestroaula.apellido+ ', ' +maestroaula.nombre  "></td>
                    <td v-text="maestroaula.grado "></td>
                    <td v-text="maestroaula.seccion "></td>
                   
                                 
                    
                    
                    <td>
                        <div v-if="maestroaula.condicion">
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
                        <option value="1" disabled>Selecciona el Maestro</option>
                        <option v-for="maestro in arrayMaestro " :key="maestro.id" :value="maestro.id" v-text="maestro.apellido+', '+maestro.nombre"></option>
                        
                        
                    </select>                                    
                </div>
            </div> 
            <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Aula</label>
                <div class="col-md-9">
                    <select v-model="aula_id" class="form-control">
                        <option value="0" disabled>Selecciona el aula</option>
                        <option v-for="aula in arrayAula " :key="aula.id" :value="aula.id" v-text="aula.grado + ' - '+ aula.seccion"></option>
                        
                        
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
              
           
           
              <div v-show="errorMaestroAula" class="form-group row div-error">
                <div class="text-center text-error">
                    <div v-for="error in errorMostrarMsjMaestroAula" :key="error" v-text="error">
                        
                    </div>
                  
                </div>
            </div>
           </form>
         </div>
         <div class="modal-footer">
           <button  @click="cerrarModal()" type="button" class="btn btn-danger" >Cerrar</button>
           <button v-if="tipoAccion==1" type="button" @click="registrarMaestroAula()" class="btn btn-primary">Guardar</button>
           <button v-if="tipoAccion==2" type="button" class="btn btn-primary" @click="actualizarMaestroAula()">Actualizar</button>
         </div>
       </div>
       <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
   </div>
   <!--Fin del modal-->
   
   <!-- Fin del modal Eliminar -->

  </main>
 
  
</template>

<script>
    export default {
        data(){
            return{
                maestroaula_id:'',
                maestro_id:0,
                id:0,
                nombre:'',
                apellido:'',
                aula_id:0,
                seccion:'',
                grado:'',
               
                nombre_curso:'',
               
                
                
                arrayMaestroAula:[],
                modal:0,
                tituloModal:'',
                tipoAccion:0,
                errorMaestroAula:0,
                errorMostrarMsjMaestroAula:[],
                pagination:{
                    'total':0,
                    'current_page':0,
                    'per_page':0,
                    'last_page':0,
                    'from':0,
                    'to':0,
                },
                offset:3,
                criterio:'grado',
                buscar:'',
                arrayAula:[],
                
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
            listarMaestroAula(page,buscar,criterio){
                let me= this;
                var url = '/maestroaula?page='+page +'&buscar=' + buscar + '&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta=response.data;
                    // // // handle success
                    // // console.log(response);
                    me.arrayMaestroAula=respuesta.maestro_aulas.data;
                        me.pagination=respuesta.pagination;
                    
                    console.log(response);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            cargarPdf(){
              window.open('http://localhost:8000/maestroaula/listarPdf','_blank')
            },
            selectMaestro(){
                 let me= this;
                var url = '/maestro/selectmaestro';
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
            selectAula(){
                 let me= this;
                var url = '/aula/selectaula';
                axios.get(url).then(function (response) {
                    var respuesta=response.data;
                    // // // handle success
                    // // console.log(response);
                    me.arrayAula=respuesta.aulas;
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
                me.listarMaestroAula(page,buscar,criterio);
            },
            registrarMaestroAula(){
                 if (this.validarMaestroAula()){
                    return;
                }
                let me=this;
                axios.post('maestroaula/registrar',{
                    'maestro_id':this.maestro_id,
                    'nombre':this.nombre,
                    'apellido':this.apellido,
                    'aula_id':this.aula_id,
                    'seccion':this.seccion,
                    'grado':this.grado,
                    
                    
                    
                   
                    

                }
                ).then(function (response){
                    me.cerrarModal();
                    me.listarMaestroAula(1,'','nombre');
                }).catch(function(error){
                    console.log(error);
                });
            },
            actualizarMaestroAula(){
               if (this.validarMaestroAula()){
                    return;
                }
                
                let me = this;

                axios.put('/maestroaula/actualizar',{
                    'id': this.maestroaula_id,
                    'maestro_id':this.maestro_id,
                    'nombre':this.nombre,
                    'apellido':this.apellido,
                    'aula_id':this.aula_id,
                    'seccion':this.seccion,
                    'grado':this.grado,
                    
                    
                    
                    
                    
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarMaestroAula(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            desactivarMaestroAula(id){
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
                    axios.put('maestroaula/desactivar',{
                       
                        'id':id
                    }
                    ).then(function (response){
                        
                        me.listarMaestroAula(1,'','nombre');
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
            activarMaestroAula(id){
                
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
                    axios.put('maestroaula/activar',{
                       
                        'id':id
                    }
                    ).then(function (response){
                        
                        me.listarMaestroAula(1,'','nombre');
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
                    case "maestroaula":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tipoAccion=1;
                                this.tituloModal='Registrar Aula del Maestro';
                                this.maestro_id='1';
                                this.nombre='';
                                this.apellido='';
                                this.aula_id='0';
                                this.seccion='';
                                this.grado='';
                               
                                
                                
                               
                               
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal=1;
                                this.tituloModal='Actualizar  Aula del Maestro';
                                this.tipoAccion=2;
                                this.maestroaula_id=data['id'];
                                this.maestro_id=data['maestro_id'];
                                this.nombre=data['nombre'];
                                this.apellido=data['apellido'];
                                this.aula_id=data['aula_id'];
                                this.seccion=data['seccion'];
                                this.grado=data['grado'];
                              
                               
                                // this.grado=data['grado'];
                                // this.seccion_grado=data['seccion_grado'];
                                // this.turno_grado=data['turno_grado'];
                               
                                
                               
                                break;
                            }
                        }
                    }
                    this.selectMaestro();
                    this.selectAula();
                    
                }
            },
            validarMaestroAula(){
                this.errorMaestroAula=0;
                this.errorMostrarMsjMaestroAula =[];

            //    if (this.grado=='0') this.errorMostrarMsjGrado.push("El grado no puede estar vacío.");
            //     if (this.maestro_id=='1') this.errorMostrarMsjGrado.push("La sección no puede estar vacío.");

            //     if (this.errorMostrarMsjGradoMaestro.length) this.errorGradoMaestro = 1;

            //     return this.errorGradoMaestro;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.grado_id='';
                this.grado='';
                this.seccion='';
                
                this.maestro_id='';
                this.nombre='';
                this.apellido='';
                
                
               
                this.errorMaestroAula=0;
                
            },
        },
        mounted() {
           this.listarMaestroAula(1,this.buscar,this.criterio);
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
