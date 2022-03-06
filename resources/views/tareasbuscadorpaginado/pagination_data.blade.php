

                                               @foreach($data as $row)
      <tr>
       <td>{{ $row->id_tareas}}</td>
       <td>{{ $row->title }}</td>
       <td>{{ $row->created_at}}</td>
       <td>{{ $row->updated_at}}</td>
       <td>{{ $row->nombre}}</td>
       <td>  
<div>

        <div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-nombre="{{$row->title}}"  data-titulo="{{$row->id_tareas}}" data-id_categoria="{{$row->id_categoria}}" data-nombre_categoria="{{$row->nombre}}" >

        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg>


        </button>
        </div>
        <div>
      
        <form id="formulario" action="{{route('delete')}}" name="tuformulario" method="POST">
      @csrf
      <div class="form-group" style="display:none" >
            <label for="recipient-name" class="col-form-label">ID:</label>
            <input type="text" name="id" class="form-control" value={{$row->id_tareas}}>
          </div>
          <button text-align="center" onclick="pregunta()" class="btn btn-danger">

    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
</svg>


    </button> </form></div>
  
    </div>
  
  </td>
   
      </tr>
      @endforeach
      <tr  style="text-align:center;">
       <td colspan="6"  >
       <div class="d-flex justify-content-center">
      {!! $data->links('vendor.pagination.bootstrap-4') !!}
        </div>
        
       </td>
      </tr>

      

      
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">TAREA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form id="formulario" action="{{route('update')}}" method="POST">
      @csrf
      
      <div class="form-group" style="display:none" >
            <label for="recipient-name" class="col-form-label">ID:</label>
            <input type="text" name="id" readonly class="form-control" id="id">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Nombre:</label>
            <input type="text" name="title" class="form-control" id="title">
          </div>
        

          <div class="form-group ">
    <label for="id_categoria">Categoria</label>
      <select  id="id_categoria" name="id_categoria" class="form-control">
      <option >Seleccione una categoria</option>
        @foreach ($categorias as $categoriasrecibidas )
        <option value={{$categoriasrecibidas->id}} >{{$categoriasrecibidas->nombre}}</option>
        @endforeach
      </select>
    </div>

      </div>
      <div  class="d-flex justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
        <br>
        <button type="submit" class="btn btn-primary">EDITAR</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script >
function pregunta(){
    if (confirm('¿Estas seguro de eliminar este registro?')){
       document.tuformulario.submit()
    }
}
</script>

<script>

$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var titulo = button.data('titulo')
  var nombre = button.data('nombre')  
  var categoria = button.data('nombre_categoria')
  var id_cat=button.data('id_categoria')
  // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('#id').val(titulo)
  modal.find('#title').val(nombre)
  modal.find('#id_categoria').val(id_cat); 
 

})
</script>