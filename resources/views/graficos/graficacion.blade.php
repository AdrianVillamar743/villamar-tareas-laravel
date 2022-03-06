@extends('nav')
@section('content')
<html>
  <body>
  
  <div class="container">
    
    <div class="d-flex justify-content-center">
    <div style= "text-align: center" class="col-md-6">
    <span>Buscador de categorias que muestra el número de tareas asignadas</span>
    <br>
    <br>
    
        <input type="text" name="envio" onkeypress="validar(event)"  placeholder="Escriba el nombre de la categoria que busca" id="envio" class="form-control" />
        </div>
        </div>
  </div>
  <br>
  <div class="container">
    
    <div class="d-flex justify-content-center">
    <div style= "text-align: center" class="col-md-9">
  
        <div class="d-flex justify-content-center">
        <div style= "text-align: center" class="col-md-9">
        <table class="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">NOMBRE</th>
          <th scope="col">Numero tareas</th>
        </tr>
      </thead>
      <tbody>
  @include('graficos.graficosdato')
  </tbody>
  </table>
    
    </div>   
    </div>   

    
  
   
    </div>
      </div>

   </div>
  </body>
</html>


 
<script>

 function fetch_data(envio)
 {
  $.ajax({
   url:"/reporte/fetch_data?envio="+envio,
   success:function(data)
   {
    $('tbody').html('');
    $('tbody').html(data);
   }
  })
 }
 
 function validar(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13) {
    var envio= $('#envio').val();
    fetch_data(envio)
  };
}





</script>
@endsection