
@extends('nav')
@section('content')
  <br />

  <div class="container">

  <br>
   <h3 >Registro de Categorias</h3>
   <br>
   <div class="row">
       <div class="col-md-12">
   <form action="{{route('paginationcategoria')}}" method="POST">
  @csrf
    @if (session('success'))
      <h6 class="alert alert-success">
         {{session('success')}}
      </h6> 
    @endif

    @error('nombre')
    <h6 class="alert alert-success">
         {{$message}}
      </h6> 
    @enderror
   
   <div class="form">
    <div class="form-group ">
      <label for="title">Nombre</label>
      <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre">
    </div>
    <!-- Aquí puedes escribir tu comentario 
    <div class="form-group col-md-6">
    <label for="inputcategoria">Categoria</label>
      <select id="inputcategoria" class="form-control">
        <option selected>Seleccione una categoria</option>
        <option>...</option>
      </select>
    </div>
  

-->

<div class="container">
  <div class="row">
    <div class="col text-center">
    <button text-align="center" type="submit" class="btn btn-primary">

    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
</svg>

    </button>
  
    </div>
  </div>
</div>


  </div>
</form>




  </div>
  </div>
  <br>

  <div class="container">
   <h3 align="center">LISTADO DE CATEGORIAS</h3><br />
   <div class="row">
  
    <div style= "text-align: center" class="col-md-12">
     <div class="form-group">
      <input type="text" name="serach" placeholder="Buscador Categorias por nombre" id="serach" class="form-control" />
     </div>
    </div>
   </div>
   <div class="table-responsive">
    <table  style="text-align:center;" class="table table-striped table-bordered">
     <thead>
      <tr>
       <th width="5%" class="sorting" data-sorting_type="asc" data-column_name="id" style="cursor: pointer">ID <span id="id_icon"></span></th>
       <th width="20%" class="sorting" data-sorting_type="asc" data-column_name="post_title" style="cursor: pointer">NOMBRE<span id="post_title_icon"></span></th>
       <th width="30%">CREADO</th>
       <th width="30%">ACTUALIZADO</th>
       <th width="5%">ACCIONES</th>
      </tr>
     </thead>
     <tbody>
      @include('categoriasbuscadorpaginado.pagination_data')
     </tbody>
    </table>
    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
    <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
   </div>
  </div>
 </body>
</html>

<script>
$(document).ready(function(){

 function clear_icon()
 {
  $('#id_icon').html('');
  $('#post_title_icon').html('');
 }

 function fetch_data(page, sort_type, sort_by, query)
 {
  $.ajax({
   url:"/paginationcategoria/fetch_data?page="+page+"&sortby="+sort_by+"&sorttype="+sort_type+"&query="+query,
   success:function(data)
   {
    $('tbody').html('');
    $('tbody').html(data);
   }
  })
 }

 $(document).on('keyup', '#serach', function(){
  var query = $('#serach').val();
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();
  var page = $('#hidden_page').val();
  fetch_data(page, sort_type, column_name, query);
 });

 $(document).on('click', '.sorting', function(){
  var column_name = $(this).data('column_name');
  var order_type = $(this).data('sorting_type');
  var reverse_order = '';
  if(order_type == 'asc')
  {
   $(this).data('sorting_type', 'desc');
   reverse_order = 'desc';
   clear_icon();
   $('#'+column_name+'_icon').html('<span class="glyphicon glyphicon-triangle-bottom"></span>');
  }
  if(order_type == 'desc')
  {
   $(this).data('sorting_type', 'asc');
   reverse_order = 'asc';
   clear_icon
   $('#'+column_name+'_icon').html('<span class="glyphicon glyphicon-triangle-top"></span>');
  }
  $('#hidden_column_name').val(column_name);
  $('#hidden_sort_type').val(reverse_order);
  var page = $('#hidden_page').val();
  var query = $('#serach').val();
  fetch_data(page, reverse_order, column_name, query);
 });

 $(document).on('click', '.pagination a', function(event){
  event.preventDefault();
  var page = $(this).attr('href').split('page=')[1];
  $('#hidden_page').val(page);
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();

  var query = $('#serach').val();

  $('li').removeClass('active');
        $(this).parent().addClass('active');
  fetch_data(page, sort_type, column_name, query);
 });

});
</script>

@endsection

