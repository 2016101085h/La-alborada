<template>
    
  <main class="content-wrapper">
       
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Usuarios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Escritorio</a></li>
              <li class="breadcrumb-item active">Usuarios</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                  <i class="fa fa-align-justify"></i> Usuarios
                  <button type="button" @click="abrirModal('persona','registrar')" class="btn btn-secondary bg-secondary ml-2 border-transparent " >
                    <i class="fa fa-plus"></i>&nbsp;Nuevo
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
                      <input type="text" v-model="buscar" @keyup.enter="listarPersona(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                      <button type="submit" @click="listarPersona(1,buscar,criterio)" class="btn btn-warning text-white rounded-0"><i class="fa fa-search"></i> Buscar</button>
                    </div>
                  </div>
                </div>
                <table class="table table-bordered  table-sm  ">
                  <tr class="bg-info text-center ">
                    <th>Opciones</th>
                    <th>Nombre</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Sexo</th>
                    <th>DNI</th>
                    <th>Numero de Celular</th>
                    <th>Dirección</th>
                    <th>Nombre de Usuario</th>                                 
                    <th>Nombre de Rol</th>                                 
                    <th >Estado</th>

                  </tr>
                  <tr v-for="persona in arrayPersona" :key="persona.id">
                    <td >
                        <button type="button" @click="abrirModal('persona','actualizar',persona)" class="btn btn-warning btn-sm" 
                          >
                          <i class="fa fa-pen"></i>
                        </button> &nbsp;
                        <template v-if="persona.condicion">
                         <button type="button" class="btn btn-danger btn-sm" @click="desactivarPersona(persona.id)">
                          <i class="fa fa-trash"></i>
                        </button>
                        </template>
                        <template v-else>
                         <button type="button" class="btn btn-success btn-sm" @click="activarPersona(persona.id)">
                          <i class="fa fa-check"></i>
                        </button>
                        </template>
                    </td>
                    <td v-text="persona.nombre + ' ' + persona.apellido "></td>
                    <td v-text="persona.fech_nacimiento "></td>
                    <td v-text="persona.sexo "></td>
                    <td v-text="persona.dni "></td>
                    <td v-text="persona.num_celular "></td>
                    <td v-text="persona.direccion "></td>
                    <td v-text="persona.usuario "></td>
                    <td v-text="persona.rol "></td>
        
                                
                    
                    
                    <td>
                        <div v-if="persona.condicion">
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
               <label class="col-md-3 form-control-label" for="email-input">Nombre </label>
               <div class="col-md-9">
                 <input type="text" v-model="nombre" class="form-control" placeholder="Ingrese el Nombre">
               </div>
             </div> 
            <div class="form-group row">
               <label class="col-md-3 form-control-label" for="email-input">Apellidos</label>
               <div class="col-md-9">
                 <input type="text" v-model="apellido" class="form-control" placeholder="Ingrese el Apellido">
               </div>
             </div> 
            <div class="form-group row">
               <label class="col-md-3 form-control-label" for="email-input">Fecha de Nacimiento</label>
               <div class="col-md-9">
                 <input type="date" v-model="fech_nacimiento" class="form-control" placeholder="Ingrese la fecha de su Nacimiento">
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
                 <input type="number" v-model="dni" class="form-control" placeholder="Ingrese el DNI">
               </div>
             </div> 
            <div class="form-group row">
               <label class="col-md-3 form-control-label" for="email-input">Celular</label>
               <div class="col-md-9">
                 <input type="number" v-model="num_celular" class="form-control" placeholder="Ingrese el numero de celular">
               </div>
             </div> 
            <div class="form-group row">
               <label class="col-md-3 form-control-label" for="email-input">Dirección</label>
               <div class="col-md-9">
                 <input type="text" v-model="direccion" class="form-control" placeholder="Ingrese la Dirección">
               </div>
             </div> 
            <div class="form-group row">
               <label class="col-md-3 form-control-label" for="email-input">Nombre del Usuario</label>
               <div class="col-md-9">
                 <input type="text" v-model="usuario" class="form-control" placeholder="Ingrese el Nombre del Usuario">
               </div>
             </div> 
            <div class="form-group row">
               <label class="col-md-3 form-control-label" for="email-input">Contraseña del Usuario</label>
               <div class="col-md-9">
                 <input type="password" v-model="password" class="form-control" placeholder="Ingrese la contraseña del Usuario">
               </div>
             </div> 
            <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Rol</label>
                <div class="col-md-9">
                    <select v-model="rol_id" class="form-control">
                        <option value="0" disabled>Selecciona el Rol</option>
                        <option v-for="rol in arrayRol " :key="rol.id" :value="rol.id" v-text="rol.nombre"></option>
                        
                        
                    </select>                                    
                </div>
            </div> 
           
             
        
              <div v-show="errorPersona" class="form-group row div-error">
                <div class="text-center text-error">
                    <div v-for="error in errorMostrarMsjPersona" :key="error" v-text="error">
                        
                    </div>
                  
                </div>
            </div>
           </form>
         </div>
         <div class="modal-footer">
           <button  @click="cerrarModal()" type="button" class="btn btn-danger" >Cerrar</button>
           <button v-if="tipoAccion==1" type="button" @click="registrarPersona()" class="btn btn-primary">Guardar</button>
           <button v-if="tipoAccion==2" type="button" class="btn btn-primary" @click="actualizarPersona()">Actualizar</button>
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
               persona_id: 0,
                id:0,
                nombre : '',
                apellido : '',
                sexo : '',
                dni : '',
                num_celular : '',
                fech_nacimiento : '',
                direccion : '',
                usuario : '',
                password : '',
                rol:'',
                rol_id : 0,
                arrayPersona : [],
                arrayRol : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorPersona : 0,
                errorMostrarMsjPersona : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'nombre',
                buscar : '',



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
            listarPersona(page,buscar,criterio){
                let me= this;
                var url = '/user?page='+page +'&buscar=' + buscar + '&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta=response.data;
                    // // // handle success
                    // // console.log(response);
                    me.arrayPersona=respuesta.personas.data;
                        me.pagination=respuesta.pagination;
                    
                    console.log(response);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            
            selectRol(){
                 let me= this;
                var url = '/rol/selectrol';
                axios.get(url).then(function (response) {
                    var respuesta=response.data;
                    // // // handle success
                    // // console.log(response);
                    me.arrayRol=respuesta.rols;
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
                me.listarPersona(page,buscar,criterio);
            },
            registrarPersona(){
                 if (this.validarPersona()){
                    return;
                }
                let me=this;
                axios.post('user/registrar',{
                    'rol_id':this.rol_id,
                    'nombre':this.nombre,
                    'apellido':this.apellido,
                    'direccion':this.direccion,
                    'fech_nacimiento':this.fech_nacimiento,
                    'dni':this.dni,
                    'sexo':this.sexo,
                    'num_celular':this.num_celular,
                    'usuario':this.usuario,
                    'password':this.password,
                   
            
                }
                ).then(function (response){
                    me.cerrarModal();
                    me.listarPersona(1,'','nombre');
                }).catch(function(error){
                    console.log(error);
                });
            },
            actualizarPersona(){
               if (this.validarPersona()){
                    return;
                }
                
                let me = this;

                axios.put('/user/actualizar',{
                    'id': this.persona_id,
                    'rol_id':this.rol_id,
                    'nombre':this.nombre,
                    'apellido':this.apellido,
                    'direccion':this.direccion,
                    'fech_nacimiento':this.fech_nacimiento,
                    'dni':this.dni,
                    'sexo':this.sexo,
                    'num_celular':this.num_celular,
                    'usuario':this.usuario,
                    'password':this.password,
                    
                    
                    
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarPersona(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            desactivarPersona(id){
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
                    axios.put('user/desactivar',{
                       
                        'id':id
                    }
                    ).then(function (response){
                        
                        me.listarPersona(1,'','nombre');
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
            activarPersona(id){
                
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
                    axios.put('user/activar',{
                       
                        'id':id
                    }
                    ).then(function (response){
                        
                        me.listarPersona(1,'','nombre');
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
                    case "persona":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tipoAccion=1;
                                this.tituloModal='Registrar persona';
                                this.rol_id='0';
                                this.nombre='';
                                this.apellido='';
                                this.sexo='sexo';
                                this.dni='';
                                this.direccion='';
                                this.fech_nacimiento='';
                                this.num_celular='';
                                this.usuario='';
                                this.password='';
                               
                                
                                
                               
                               
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal=1;
                                this.tituloModal='Actualstrar persona';
                                this.tipoAccion=2;
                                this.persona_id=data['id'];
                                
                                this.nombre=data['nombre'];
                                this.apellido=data['apellido'];
                                this.sexo=data['sexo'];
                                this.direccion=data['direccion'];
                                this.dni=data['dni'];
                                this.fech_nacimiento=data['fech_nacimiento'];
                                this.num_celular=data['num_celular'];
                                this.usuario=data['usuario'];
                                this.password=data['password'];
                                this.rol_id=data['rol_id'];
                               
                                
                               
                                // this.grado=data['grado'];
                                // this.seccion_grado=data['seccion_grado'];
                                // this.turno_grado=data['turno_grado'];
                               
                                
                               
                                break;
                            }
                        }
                    }
                    
                    this.selectRol();
                    
                }
            },
            validarPersona(){
                this.errorPersona=0;
                this.errorMostrarMsjPersona =[];

            //    if (this.grado=='0') this.errorMostrarMsjGrado.push("El grado no puede estar vacío.");
            //     if (this.maestro_id=='1') this.errorMostrarMsjGrado.push("La sección no puede estar vacío.");

            //     if (this.errorMostrarMsjGradoMaestro.length) this.errorGradoMaestro = 1;

            //     return this.errorGradoMaestro;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.rol_id=0;
                this.nombre='';
                this.apellido='';
                this.fech_nacimiento='';
                this.dni='';
                this.sexo='';
                this.direccion='';
                this.num_celular='';
                this.usuario='';
                
                this.password='';
            
                
               
                this.errorPersona=0;
                
            },
        },
        mounted() {
           this.listarPersona(1,this.buscar,this.criterio);
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
