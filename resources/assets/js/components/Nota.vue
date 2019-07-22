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
                  <button type="button" @click="abrirModal('selects')" class="btn btn-secondary bg-secondary ml-2 border-transparent " >
                    <i class="fa fa-plus"></i>&nbsp;Agregar Notas
                  </button>
                  <button type="button" @click="listarPdf()" class="btn btn-secondary bg-primary ml-2 border-transparent " >
                    <i class="fas fa-file"></i>&nbsp;Reporte
                  </button>
                  <!-- <input type="text" id="aula2"> -->
                </div>
                
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-sm ">
                  <tr class="bg-info text-center ">
                    <th>N° Orden</th>
                    <th>Apellidos y Nombres</th>
                    <th v-for="competencia in arrayCompetencias" :key="competencia.id" v-text="competencia.nombre">
                    </th>                                   
                  </tr>

                  <tr v-for="estudiante in arrayEstudiantes" :key="estudiante.id">
                    <td v-text="estudiante.id"  style="background-color:#E7CDB7"></td>
                    <td v-text="estudiante.apellido + ', ' + estudiante.nombre" style="background-color:#D5EFC0"></td>
                    <td v-for="(nota, index) in estudiante.nota" :key="nota.id" style="position:relative; text-align:center; background-color:#CBC6BB">
                        <!-- <input type="number" v-model.number="estudiante.nota[index]"v-bind:class= "[estudiante.nota[index]<=10 ? 'text-danger' : 'text-primary']" style="width:50px; border-radius:5px; border:1px solid black; text-align:center"> -->
                        <span v-show="estudiante.nota[index] = ''"></span>
                        <select v-model="estudiante.nota[index]" v-bind:class= "[estudiante.nota[index]=='C' ? 'text-danger' : 'text-primary']">
                          <!-- <option value="" disabled></option> -->
                          <option value="AD">AD</option>
                          <option value="A">A</option>
                          <option value="B">B</option>
                          <option value="C">C</option>
                        </select>
                    </td>               
                  </tr>                                                   
                </table>
                <div v-show="errorNota" class="form-group row div-error">
                    <div class="text-center text-error">
                        <div v-text="errorMostrarMsjNota">
                            
                        </div>
                      
                    </div>
                </div>
                <button class="btn btn-primary mt-3" @click="registrarNota()">Guardar Cambios</button>
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
                    <select v-model="aula_id" class="form-control" id="aula">
                        <option value="0" disabled>Selecciona el Aula</option>
                        <option v-for="aula in arrayAulas" :key="aula.id" :value="aula.id" v-text="aula.grado +' - '+ aula.seccion"></option>
                        
                        
                    </select>                                    
                </div>
            </div> 
            <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Curso</label>
                <div class="col-md-9">
                    <select v-model="curso_id" class="form-control">
                        <option value="0" disabled>Selecciona el curso</option>
                        <option v-for="curso in arrayCursos " :key="curso.id" :value="curso.id" v-text="curso.nombre"></option>       
                    </select>                                    
                </div>
            </div> 
            <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Periodo</label>
                <div class="col-md-9">
                    <select v-model="periodo_id" class="form-control">
                        <option value="0" disabled>Selecciona el periodo</option>
                        <option v-for="periodo in arrayPeriodos" :key="periodo.id" :value="periodo.id" v-text="periodo.nombre"></option>
                    </select>                                    
                </div>
            </div>
           </form>
         </div>
         <div class="modal-footer">
           <button  @click="cerrarModal()" type="button" class="btn btn-danger" >Cerrar</button>
           <button v-if="tipoAccion==1" type="button" @click="abrirEstudiantes()" class="btn btn-primary">Ingresar</button>
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
          return {
            orden: 1,
            nota_id: 0,
            periodo_id: 0,
            aula_id: 0,
            curso_id: 0,
            estudiante_id: [],
            competencia_id: 0,
            arrayAulas: [],
            arrayEstudiantes: [],
            arrayCursos: [],
            arrayCompetencias: [],
            arrayPeriodos: [],
            arrayNotas: [],
            calificacion: [],
            modal: 0,
            tipoAccion: 0,
            tituloModal: '',
            errorNota: 0,
            errorMostrarMsjNota: ""

          }
        },
        methods:{
          selectAlumnos(){
            let me= this;
            var url = '/nota';

            axios.get(url).then(function (response){
              var respuesta = response.data;

              me.arrayAulas = respuesta.aulas;
              me.arrayCursos = respuesta.cursos;
              me.arrayPeriodos = respuesta.periodos;
              me.arrayNotas = respuesta.notas;
              console.log(response);
            })
            .catch(function (error) {
                    console.log(error);
            });
          },
          listarPdf(){
            window.open('http://localhost:8000/nota/listarPdf')
          },
          abrirEstudiantes(aulaId = this.aula_id, cursoId = this.curso_id){
                // aulaId = this.aula_id;
                // cursoId = this.curso_id;
            let me= this;

            var url = '/nota/estudiantes?aula_id=' + aulaId + '&curso_id=' + cursoId;

            axios.get(url).then(function (response){
              var respuesta = response.data;

              me.arrayCompetencias = respuesta.competencias;
              me.arrayEstudiantes = respuesta.estudiantes;
              // console.log(response);
                    for(let i=0;i<me.arrayEstudiantes.length;i++){
                     me.arrayEstudiantes[i]['nota']={};

                        for(let j=0;j<me.arrayCompetencias.length;j++){
                            me.arrayEstudiantes[i]['nota']['nota'+j]=0;
                        }
                        
                    }
                    me.cerrarModal();

            })
            .catch(function (error) {
              console.log(error);
            });
          },
          registrarNota(){
              if (this.validarNota()){
                  return;
              }

                  let me = this;
                  axios.post('/nota/registrar',{
                  'data':me.arrayEstudiantes,
                  'curso_id':me.curso_id,
                  'aula_id':me.aula_id,
                  'periodo_id':me.periodo_id,
                  'competencias':me.arrayCompetencias
                  })
                  .then(function (response) {
 

                  }).catch(function (error) {
                  console.log(error);
                  }); 
          },
          validarNota(){
            this.errorNota = 0;
            this.errorMostrarMsjNota;
            for(let i=0;i<this.arrayEstudiantes.length;i++){


                        for(let j=0;j<this.arrayCompetencias.length;j++){
                            if (this.arrayEstudiantes[i]['nota']['nota'+j] == '') this.errorMostrarMsjNota = 'Ninguna nota puede estar vacía si desea registrar notas';
                        }
                        
                    }

            if (this.errorMostrarMsjNota.length) this.errorNota = 1;

                return this.errorNota;
          },
          abrirModal(accion,data= []){

                    switch(accion){
                          case 'selects':
                          {
                              this.modal=1;
                              this.tipoAccion=1;
                              this.tituloModal='Ingresar Notas';
                              this.orden = 0;

                              break;
                          }
                          case 'actualizar':
                          {
                              this.modal=1;
                              this.tituloModal='Actualstrar Notas';
                              this.tipoAccion=2;

                              break;
                          }
                      }
                                
              
            },
            cerrarModal(){
                this.modal=0;                
            }
        },
          
        mounted(){
          this.selectAlumnos();
          this.abrirEstudiantes(this.aula_id, this.curso_id);
        }
    }
// $( "#aula" )
//   .change(function () {
//     var str = "";
//     $( "#aula option:selected" ).each(function() {
//       str += $( this ).text() + " ";
//     });
//     $( "#aula2" ).value( str );
//   })
//   .change();
</script>

<style>
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
