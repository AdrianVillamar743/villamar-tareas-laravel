
     
      @foreach($data as $row)
          <tr>
           <td>{{ $row->id_categorias}}</td>
           <td>{{ $row->nombre }}</td>
           <td>{{ $row->numero_tareas }}</td>
      
    </tr>
    @endforeach

  
     
   