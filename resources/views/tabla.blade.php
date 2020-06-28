            @if($flag==1)

            <table class="table table-striped table table-hover table-sm" id="datatable1">
              <thead class="thead-dark">
                <tr>
                 <th>Razon Social</th>
                 <th>Cod Producto</th>
                 <th>Producto</th>
                 <th>Bultos</th>
                 <th>Fecha de corte</th>
                 
                </tr>
              </thead>
              <tbody>
              @foreach($bultos as $det)
              <tr>
                <td>{{$det->Razon_Social}}</td>
                <td>{{$det->Producto}}</td>
                <td>{{$det->Descripcion}}</td>
                <td>{{$det->Bultos}}</td>     
                <td>{{$det->fecha_corte}}</td>     
                </tr>
                @endforeach
                

              </tbody>
            </table>
            @else
              El Codigo de cliente no corresponde al cliente seleccionado.
            @endif