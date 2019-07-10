<template>
    
  <main class="content-wrapper">
       
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Notas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Escritorio</a></li>
              <li class="breadcrumb-item active">Notas</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                  <i class="fa fa-align-justify"></i> Notas
                  <button type="button" @click="abrirModal('nota','registrar')" class="btn btn-secondary bg-secondary ml-2 border-transparent " >
                    <i class="fa fa-plus"></i>&nbsp;Nuevo
                  </button>
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group row">
                  <div class="col-md-6">
                    <div class="input-group">
                      <select class="form-control col-md-3" v-model="criterio">
                        <option value="nombre_competencia">Competencia</option>
                        <option value="nombre_estudiante">Nombre</option>
                        <option value="calificacion">Calificacion</option>
                        
                        
                        
                      </select>
                      <input type="text" v-model="buscar" @keyup.enter="listarNota(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                      <button type="submit" @click="listarNota(1,buscar,criterio)" class="btn btn-warning text-white rounded-0"><i class="fa fa-search"></i> Buscar</button>
                    </div>
                  </div>
                </div>
                <table class="table table-bordered table-sm ">
                  <tr class="bg-info text-center ">
                    <th>Opciones</th>
                    <th>Competencia</th>
                    <th>Estudiante</th>

                    <th>Curso</th>
                    <th>Periodo</th>
                    <th>Calificacion</th>
                   
                    
                                      
                    <th >Estado</th>

                  </tr>
                  <tr v-for="nota in arrayNota" :key="nota.id">
                    <td >
                        <button type="button" @click="abrirModal('nota','actualizar',nota)" class="btn btn-warning btn-sm" 
                          >
                          <i class="fa fa-pen"></i>
                        </button> &nbsp;
                        <template v-if="nota.condicion">
                         <button type="button" class="btn btn-danger btn-sm" @click="desactivarNota(nota.id)">
                          <i class="fa fa-trash"></i>
                        </button>
                        </template>
                        <template v-else>
                         <button type="button" class="btn btn-success btn-sm" @click="activarNota(nota.id)">
                          <i class="fa fa-check"></i>
                        </button>
                        </template>
                    </td>
                    <td v-text="nota.nombre_competencia "></td>
                    <td v-text="nota.nombre_estudiante + ' ' + nota.apellido_estudiante "></td>
                    <td v-text="nota.nombre_curso "></td>
                   
                    <td v-text="nota.nombre_periodo"></td>                 
                    <td v-text="nota.calificacion"></td>                 
                    
                    
                    <td>
                        <div v-if="nota.condicion">
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
                <label class="col-md-3 form-control-label" for="text-input">Competencia</label>
                <div class="col-md-9">
                    <select v-model="competencia_id" class="form-control">
                        <option value="0" disabled>Selecciona el competencia</option>
                        <option v-for="competencia in arrayCompetencia " :key="competencia.id" :value="competencia.id" v-text="competencia.nombre"></option>
                        
                        
                    </select>                                    
                </div>
            </div> 
            <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Estudiante</label>
                <div class="col-md-9">
                    <select v-model="estudiante_id" class="form-control">
                        <option value="1" disabled>Selecciona el Estudiante</option>
                        <option v-for="estudiante in arrayEstudiante " :key="estudiante.id" :value="estudiante.id" v-text="estudiante.nombre + ' - '+ estudiante.apellido"></option>
                        
                        
                    </select>                                    
                </div>
            </div> 
            <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Curso</label>
                <div class="col-md-9">
                    <select v-model="curso_id" class="form-control">
                        <option value="2" disabled>Selecciona el curso</option>
                        <option v-for="curso in arrayCurso " :key="curso.id" :value="curso.id" v-text="curso.nombre"></option>
                        
                        
                    </select>                                    
                </div>
            </div> 
            <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Periodo</label>
                <div class="col-md-9">
                    <select v-model="periodo_id" class="form-control">
                        <option value="3" disabled>Selecciona el periodo</option>
                        <option v-for="periodo in arrayPeriodo " :key="periodo.id" :value="periodo.id" v-text="periodo.nombre"></option>
                        
                        
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
             
           <div class="form-group row">
               <label class="col-md-3 form-control-label" for="email-input">Calificacion</label>
               <div class="col-md-9">
                 <input type="text" v-model="calificacion" class="form-control" placeholder="Ingrese la Calificacion">
               </div>
             </div>
              
           
           
              <div v-show="errorNota" class="form-group row div-error">
                <div class="text-center text-error">
                    <div v-for="error in errorMostrarMsjNota" :key="error" v-text="error">
                        
                    </div>
                  
                </div>
            </div>
           </form>
         </div>
         <div class="modal-footer">
           <button  @click="cerrarModal()" type="button" class="btn btn-danger" >Cerrar</button>
           <button v-if="tipoAccion==1" type="button" @click="registrarNota()" class="btn btn-primary">Guardar</button>
           <button v-if="tipoAccion==2" type="button" class="btn btn-primary" @click="actualizarNota()">Actualizar</button>
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
                nota_id:'',
                competencia_id:0,
                nombre_competencia:'',
                estudiante_id:0,
                nombre_estudiante:'',
                apellido_estudiante:'',
                curso_id:0,
                nombre_curso:'',
                periodo_id:0,
                nombre_periodo:'',
                calificacion:'',
                    
                arrayNota:[],
                modal:0,
                tituloModal:'',
                tipoAccion:0,
                errorNota:0,
                errorMostrarMsjNota:[],
                pagination:{
                    'total':0,
                    'current_page':0,
                    'per_page':0,
                    'last_page':0,
                    'from':0,
                    'to':0,
                },
                offset:3,
                criterio:'nombre_estudiante',
                buscar:'',
                arrayCompetencia:[],
                arrayCurso:[],
                arrayEstudiante:[],
                arrayPeriodo:[],



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
            listarNota(page,buscar,criterio){
                let me= this;
                var url = '/nota?page='+page +'&buscar=' + buscar + '&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta=response.data;
                    // // // handle success
                    // // console.log(response);
                    me.arrayNota=respuesta.notas.data;
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
            selectCompetencia(){
                 let me= this;
                var url = '/competencia/selectcompetencia';
                axios.get(url).then(function (response) {
                    var respuesta=response.data;
                    // // // handle success
                    // // console.log(response);
                    me.arrayCompetencia=respuesta.competencias;
                        // me.pagination=respuesta.pagination;
                    
                    console.log(response);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            selectCurso(){
                 let me= this;
                var url = '/curso/selectcurso';
                axios.get(url).then(function (response) {
                    var respuesta=response.data;
                    // // // handle success
                    // // console.log(response);
                    me.arrayCurso=respuesta.cursos;
                        // me.pagination=respuesta.pagination;
                    
                    console.log(response);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            selectEstudiante(){
                 let me= this;
                var url = '/estudiante/selectestudiante';
                axios.get(url).then(function (response) {
                    var respuesta=response.data;
                    // // // handle success
                    // // console.log(response);
                    me.arrayEstudiante=respuesta.estudiantes;
                        // me.pagination=respuesta.pagination;
                    
                    console.log(response);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            selectPeriodo(){
                 let me= this;
                var url = '/periodo/selectperiodo';
                axios.get(url).then(function (response) {
                    var respuesta=response.data;
                    // // // handle success
                    // // console.log(response);
                    me.arrayPeriodo=respuesta.periodos;
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
                me.listarNota(page,buscar,criterio);
            },
            registrarNota(){
                 if (this.validarNota()){
                    return;
                }
                let me=this;
                axios.post('nota/registrar',{
                    'competencia_id':this.competencia_id,
                    // 'nombre_competencia':this.nombre_competencia,
                    'estudiante_id':this.estudiante_id,
                    // 'nomre_estudiante':this.nomnre_estudiante,
                    // 'apellido_estudiante':this.apellido_estudiante,
                    'curso_id':this.curso_id,
                    // 'nombre_curso':this.nombre_curso,
                    'periodo_id':this.periodo_id,
                    // 'nombre_periodo':this.nombre_periodo,
                    'calificacion':this.calificacion,
                    
                    
                    
                   
                    

                }
                ).then(function (response){
                    me.cerrarModal();
                    me.listarNota(1,'','nombre');
                }).catch(function(error){
                    console.log(error);
                });
            },
            actualizarNota(){
               if (this.validarNota()){
                    return;
                }
                
                let me = this;

                axios.put('/nota/actualizar',{
                    'id': this.nota_id,
                    'competencia_id':this.competencia_id,
                    // 'nombre_competencia':this.nombre_competencia,
                    'estudiante_id':this.estudiante_id,
                    // 'nomnre_estudiante':this.nomnre_estudiante,
                    // 'apellido_estudiante':this.apellido_estudiante,
                    'curso_id':this.curso_id,
                    // 'nombre_curso':this.nombre_curso,
                    'periodo_id':this.periodo_id,
                    // 'nombre_periodo':this.nombre_periodo,
                    'calificacion':this.calificacion,
                    
                    
                    
                    
                    
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarNota(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            desactivarNota(id){
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
                    axios.put('nota/desactivar',{
                       
                        'id':id
                    }
                    ).then(function (response){
                        
                        me.listarNota(1,'','nombre');
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
            activarNota(id){
                
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
                    axios.put('nota/activar',{
                       
                        'id':id
                    }
                    ).then(function (response){
                        
                        me.listarNota(1,'','nombre');
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
                    case "nota":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tipoAccion=1;
                                this.tituloModal='Registrar Nota';
                                this.competencia_id='0';
                              
                                this.estudiante_id='1';
                              
                               
                                this.curso_id='2';
                             
                                this.periodo_id='3';
                               
                                this.calificacion='';
                               
                                
                               
                               
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal=1;
                                this.tituloModal='Actualizar  Nota';
                                this.tipoAccion=2;
                                this.nota_id=data['id'];
                               
                                this.estudiante_id=data['estudiante_id'];
                               
                                this.curso_id=data['curso_id'];
                                
                                this.periodo_id=data['periodo_id'];
                               
                                this.calificacion=data['calificacion'];
                               
                                // this.grado=data['grado'];
                                // this.seccion_grado=data['seccion_grado'];
                                // this.turno_grado=data['turno_grado'];
                               
                                
                               
                                break;
                            }
                        }
                    }
                    this.selectEstudiante();
                    this.selectCompetencia();
                    this.selectPeriodo();
                    this.selectCurso();
                }
            },
            validarNota(){
                this.errorNota=0;
                this.errorMostrarMsjNota =[];

            //    if (this.grado=='0') this.errorMostrarMsjGrado.push("El grado no puede estar vacío.");
            //     if (this.maestro_id=='1') this.errorMostrarMsjGrado.push("La sección no puede estar vacío.");

            //     if (this.errorMostrarMsjGradoMaestro.length) this.errorGradoMaestro = 1;

            //     return this.errorGradoMaestro;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.competencia_id='';
              
                this.estudiante_id='';
              
                this.curso_id='';
              
                this.periodo_id='';
              
                this.calificacion='',
                
               
                this.errorNota=0;
                
            },
        },
        mounted() {
           this.listarNota(1,this.buscar,this.criterio);
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
