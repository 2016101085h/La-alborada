<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reportes de Notas</title>
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 0.875rem;
            font-weight: normal;
            line-height: 1.5;
            color: #151b1e;           
        }
        .table {
            display: table;
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border-collapse: collapse;
        }
        .table-bordered {
            border: 1px solid #c2cfd6;
        }
        thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }
        .table th, .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #c2cfd6;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #c2cfd6;
        }
        .table-bordered thead th, .table-bordered thead td {
            border-bottom-width: 2px;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #c2cfd6;
        }
        th, td {
            display: table-cell;
            vertical-align: inherit;
        }
        th {
            font-weight: bold;
            text-align: -internal-center;
            text-align: left;
        }
        tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
        .izquierda{
            float:left;
        }
        .derecha{
            float:right;
        }
        

        #logo{
        float: left;
        margin-top: 1%;
        margin-left: 2%;
        margin-right: 2%;
       
        }

        #imagen{
        width: 100px;
        }

        #datos{
        float: left;
        margin-top: 0%;
        margin-left: 2%;
        margin-right: 2%;
        /*text-align: justify;*/
        }

        #encabezado{
        text-align: center;
        margin-left: 10%;
        margin-right: 35%;
        font-size: 15px;
        }
        #thanks{
      font-size: 2em;
      margin-bottom: 50px;
      }

      #notices{
      padding-left: 6px;
      border-left: 6px solid #0087C3;
      }

      #notices .notice {
      font-size: 1.2em;
      }
     

      footer {
      color: #777777;
      width: 100%;
      height: 30px;
      position: absolute;
      bottom: 0;
      border-top: 1px solid #AAAAAA;
      padding: 8px 0;
      text-align: center;
      }
        
        
    </style>
</head>
<body>
    <header>
        <div id="logo">
            <img src="img/logo.jpeg" alt="incanatoIT" id="imagen">
        </div>
         <div id="datos">
            <p id="encabezado">
                <b style="color:#0087C3">INSTITUCIÓN EDUCATIVA LA ALBORADA 30225</b><br>Jr. Menendez 1368, - Chiclayo, Perú<br>Telefono:(+51)931742904
            </p>
        </div> 
      
    </header>
    <div >
        <h3>Lista de Notas<span class="derecha">{{now()}}</span>  </h3><br>
        {{-- {{$notas[0]->nombre . ', ' . $notas[0]->apellido}} --}}
    <p style="font-size:20px">Curso : {{$notas[0]->curso}}</p>
    </div>
  <section style="margin:20px 0 20px 0">
        <div>
           
           <table class="table table-striped  table-sm">
            <thead class="bg-info text-white" style="background-color:#17a2b8; color:white;text-transform:uppercase" >
                <tr>
                    <th>#</th>
                    <th>Competencia</th>
                    <th>Apellidos y Nombres</th>
                   
                    <th>Periodo</th>
                    <th>Calificacion</th>
                    
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($notas as $a)
                <tr>
                    <td>{{$a->id}} </td>
                    <td >{{$a->competencia}} </td>
                    <td >{{$a->apellido.', ' .$a->nombre}} </td>
                  
                    <td >{{$a->periodo}} </td>
                    <td >{{$a->calificacion}} </td>
                    
                   
                </tr>   
              @endforeach
            </tbody>
        </table>
    </div>
  </section>
    <div class="izquierda">
        <p><strong>Total de Registros : </strong>{{$cont}} </p>
    </div>
    <br>

    
      <div id="notices">
        <div></div>
        <div class="notice"></div>
      </div>
    <footer>
           
        </footer>
      
</body>
</html>