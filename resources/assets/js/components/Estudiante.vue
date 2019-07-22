<template>
    
  <main class="content-wrapper">
       
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Estudiante</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Escritorio</a></li>
              <li class="breadcrumb-item active">Estudiante</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                  <i class="fa fa-align-justify"></i> Estudiante
                  <button type="button" @click="abrirModal('estudiante','registrar')" class="btn btn-secondary bg-secondary ml-2 border-transparent " >
                    <i class="fa fa-plus"></i>&nbsp;Nuevo
                  </button>
                  <button type="button" @click="cargarPdf()" class="btn btn-secondary bg-primary ml-2 border-dark " style="background-color:#ABEBC6">
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
                      <input type="text" v-model="buscar" @keyup.enter="listarEstudiante(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                      <button type="submit" @click="listarEstudiante(1,buscar,criterio)" class="btn btn-warning text-white rounded-0"><i class="fa fa-search"></i> Buscar</button>
                    </div>
                  </div>
                </div>
                <table class="table table-bordered  table-sm  ">
                  <tr class="bg-info text-center ">
                    <th>Opciones</th>
                    <th>Aula</th>

                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Sexo</th>
                    <th>DNI</th>
                    <th>Dirección</th>               
                    <th >Estado</th>

                  </tr>
                  <tr v-for="estudiante in arrayEstudiante" :key="estudiante.id">
                    <td >
                        <button type="button" @click="abrirModal('estudiante','actualizar',estudiante)" class="btn btn-warning btn-sm" 
                          >
                          <i class="fa fa-pen"></i>
                        </button> &nbsp;
                        <template v-if="estudiante.condicion">
                         <button type="button" class="btn btn-danger btn-sm" @click="desactivarEstudiante(estudiante.id)">
                          <i class="fa fa-trash"></i>
                        </button>
                        </template>
                        <template v-else>
                         <button type="button" class="btn btn-primary btn-sm" @click="activarEstudiante(estudiante.id)">
                          <i class="fa fa-check"></i>
                        </button>
                        </template>
                    </td>
                    <td v-text="estudiante.grado + ' '+ estudiante.seccion  "></td>
                    <td v-text="estudiante.nombre "></td>
                    <td v-text="estudiante.apellido "></td>
                    <td v-text="estudiante.fech_nacimiento "></td>
                    <td v-text="estudiante.sexo "></td>
                   
                    <td v-text="estudiante.dni"></td>                 
                    <td v-text="estudiante.direccion"></td>                 
                    
                    
                    <td>
                        <div v-if="estudiante.condicion">
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
                <label class="col-md-3 form-control-label" for="text-input">Aula</label>
                <div class="col-md-9">
                    <select v-model="aula_id" class="form-control">
                        <option value="0" disabled>Selecciona el aula</option>
                        <option v-for="aula in arrayAula " :key="aula.id" :value="aula.id" v-text="aula.grado + ' - '+ aula.seccion"></option>
                        
                        
                    </select>                                    
                </div>
            </div> 
           
             
            <!-- <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Turno</label>
                <div class="col-md-9">
                    <select v-model="turno_grado" class="form-control">
                        <option value="3" disabled>Selecciona el Turno</option>
                        <option v-for="grado in arrayGrado " :key="grado.id" :value="grado.id" v-text="grado.turno"></option>
                        
                        
                    </select>                                    
                </div>
            </div>  -->
             
            <div class="form-group row">
               <label class="col-md-3 form-control-label" for="email-input">Nombre del Estudiante</label>
               <div class="col-md-9">
                 <input type="text" v-model="nombre" class="form-control" placeholder="Ingrese el Nombre del Estudiante">
               </div>
             </div> 
            <div class="form-group row">
               <label class="col-md-3 form-control-label" for="email-input">Apellido del Estudiante</label>
               <div class="col-md-9">
                 <input type="text" v-model="apellido" class="form-control" placeholder="Ingrese los Apellidos del Estudiante">
               </div>
             </div> 
            <div class="form-group row">
               <label class="col-md-3 form-control-label" for="email-input">Fecha de Nacimiento</label>
               <div class="col-md-9">
                 <input type="date" v-model="fech_nacimiento" class="form-control" placeholder="Ingrese la fecha de nacimiento del Estudiante">
               </div>
             </div> 
           
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
            <div class="form-group row">
               <label class="col-md-3 form-control-label" for="email-input">DNI</label>
               <div class="col-md-9">
                 <input type="number" v-model="dni" class="form-control" placeholder="Ingrese el Documento de Identidad del Estudiante">
               </div>
             </div> 
              <div class="form-group row">
               <label class="col-md-3 form-control-label" for="email-input">Dirección</label>
               <div class="col-md-9">
                 <input type="text" v-model="direccion" class="form-control" placeholder="Ingrese la Dirección del Estudiante">
               </div>
             </div> 
           
              <div v-show="errorEstudiante" class="form-group row div-error">
                <div class="text-center text-error">
                    <div v-for="error in errorMostrarMsjEstudiante" :key="error" v-text="error">
                        
                    </div>
                  
                </div>
            </div>
           </form>
         </div>
         <div class="modal-footer">
           <button  @click="cerrarModal()" type="button" class="btn btn-danger" >Cerrar</button>
           <button v-if="tipoAccion==1" type="button" @click="registrarEstudiante()" class="btn btn-primary">Guardar</button>
           <button v-if="tipoAccion==2" type="button" class="btn btn-primary" @click="actualizarEstudiante()">Actualizar</button>
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
                estudiante_id:'',
                aula_id:0,
                grado:'',
                seccion:'',
                nombre:'',
                apellido:'',
                sexo:'',
                fech_nacimiento:'',
                dni:0,
                direccion:'',        
                
                arrayEstudiante:[],
                modal:0,
                tituloModal:'',
                tipoAccion:0,
                errorEstudiante:0,
                errorMostrarMsjEstudiante:[],
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
            listarEstudiante(page,buscar,criterio){
                let me= this;
                var url = '/estudiante?page='+page +'&buscar=' + buscar + '&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta=response.data;
                    // // // handle success
                    // // console.log(response);
                    me.arrayEstudiante=respuesta.estudiantes.data;
                        me.pagination=respuesta.pagination;
                    
                    console.log(response);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            cargarPdf(){
              window.open('http://localhost:8000/estudiante/listarPdf','_blank')
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
                me.listarEstudiante(page,buscar,criterio);
            },
            registrarEstudiante(){
                 if (this.validarEstudiante()){
                    return;
                }
                let me=this;
                axios.post('estudiante/registrar',{
                    'aula_id':this.aula_id,
                    'grado':this.grado,
                    'seccion':this.seccion,
                    'nombre':this.nombre,
                    'apellido':this.apellido,
                    'fech_nacimiento':this.fech_nacimiento,
                    'sexo':this.sexo,
                    'dni':this.dni,
                    'direccion':this.direccion,
            
                }
                ).then(function (response){
                    me.cerrarModal();
                    me.listarEstudiante(1,'','nombre');
                }).catch(function(error){
                    console.log(error);
                });
            },
            actualizarEstudiante(){
               if (this.validarEstudiante()){
                    return;
                }
                
                let me = this;

                axios.put('/estudiante/actualizar',{
                    'id': this.estudiante_id,
                    'aula_id':this.aula_id,
                    'grado':this.grado,
                    'seccion':this.seccion,
                    'nombre':this.nombre,
                    'apellido':this.apellido,
                    'fech_nacimiento':this.fech_nacimiento,
                    'sexo':this.sexo,
                    'dni':this.dni,
                    'direccion':this.direccion,
                    
                    
                    
                    
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarEstudiante(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            desactivarEstudiante(id){
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
                    axios.put('estudiante/desactivar',{
                       
                        'id':id
                    }
                    ).then(function (response){
                        
                        me.listarEstudiante(1,'','nombre');
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
            activarEstudiante(id){
                
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
                    axios.put('estudiante/activar',{
                       
                        'id':id
                    }
                    ).then(function (response){
                        
                        me.listarEstudiante(1,'','nombre');
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
                    case "estudiante":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tipoAccion=1;
                                this.tituloModal='Registrar Estudiante';
                                this.aula_id='0';
                                this.grado='';
                                this.seccion='';
                                this.nombre='';
                                this.apellido='';
                                this.fech_nacimiento='';
                                this.sexo='sexo';
                                this.dni=0;
                                this.direccion='';
                                
                                
                               
                               
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal=1;
                                this.tituloModal='Actualstrar Estudiante';
                                this.tipoAccion=2;
                                this.estudiante_id=data['id'];
                                this.aula_id=data['aula_id'];
                                this.seccion=data['seccion'];
                                this.grado=data['grado'];
                                this.nombre=data['nombre'];
                                this.apellido=data['apellido'];
                                this.fech_nacimiento=data['fech_nacimiento'];
                                this.sexo=data['sexo'];
                                this.dni=data['dni'];
                                this.direccion=data['direccion'];
                                
                               
                                // this.grado=data['grado'];
                                // this.seccion_grado=data['seccion_grado'];
                                // this.turno_grado=data['turno_grado'];
                               
                                
                               
                                break;
                            }
                        }
                    }
                    
                    this.selectAula();
                    
                }
            },
            validarEstudiante(){
                this.errorEstudiante=0;
                this.errorMostrarMsjEstudiante =[];

            //    if (this.grado=='0') this.errorMostrarMsjGrado.push("El grado no puede estar vacío.");
            //     if (this.maestro_id=='1') this.errorMostrarMsjGrado.push("La sección no puede estar vacío.");

            //     if (this.errorMostrarMsjGradoMaestro.length) this.errorGradoMaestro = 1;

            //     return this.errorGradoMaestro;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.aula_id='';
                this.grado='';
                this.seccion='';
                
                this.nombre='';
                this.apellido='';
                this.fech_nacimiento='';
                this.sexo='',
                this.dni='',
                this.direccion='',
                
               
                this.errorEstudiante=0;
                
            },
        },
        mounted() {
           this.listarEstudiante(1,this.buscar,this.criterio);
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
