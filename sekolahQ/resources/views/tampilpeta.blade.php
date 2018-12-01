@foreach ($result as $data)
        <td>{{ $data->latitude}}</td>
        <td>{{ $data->longitude}}</td>
@endforeach
