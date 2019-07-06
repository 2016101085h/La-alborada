@extends('principal')
@section('contenido')
    
<template v-if="menu==0">
  <portada></portada>
</template>
<template v-if="menu==1">
  <maestro></maestro>
</template>
<template v-if="menu==2">
   <h1 class="content-wrapper">Contenido del menu 2</h1>
</template>
<template v-if="menu==3">
   <curso></curso>
</template>
<template v-if="menu==4">
   <aula></aula>
</template>
<template v-if="menu==5">
   <maestroaula></maestroaula>
</template>
<template v-if="menu==6">
   
   <estudiante></estudiante>
</template>
<template v-if="menu==7">
   <periodo></periodo>
</template>
<template v-if="menu==8">
   <h1 class="content-wrapper">Contenido del menu 8</h1>
</template>
<template v-if="menu==9">
   <usuario></usuario>
</template>
<template v-if="menu==10">
  <rol></rol>
</template>
<template v-if="menu==11">
    <competencia></competencia>
</template>
<template v-if="menu==12">
      
</template>
<template v-if="menu==13">
   <h1 class="content-wrapper">Contenido del menu 13</h1>
</template>
<template v-if="menu==14">
  
</template>
<template v-if="menu==15">
   <h1 class="content-wrapper">Contenido del menu 15</h1>
</template>
<template v-if="menu==16">
   <h1 class="content-wrapper">Contenido del menu 16</h1>
</template>

@endsection