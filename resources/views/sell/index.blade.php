@extends('layouts.app')

@section('title')
Chamadas
@endsection

@section('content')
<div class="row">
<table class="col-10 table">
  <thead>
    <tr align="center">
      <th scope="col">Identificador</th>
      <th scope="col">Endereço</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
     @if($property)
     @foreach ($property as $p) 
        <tr>
          <td align="center" width="33%" scope="row">{{$p->id}}</td>
          <td align="center" width="33%" scope="row">{{$p->address}}</td>
          <td align="center" width="34%"><span style="width:100px;" class="badge <?php echo $p->getColor()?>">{{$p->getStatus()}}</span></td>
        </td>
        </tr>
    @endforeach
    @endif
    </tbody>
</table>
</div>
<div align="center">
    <button class="btn btn-primary btn-icon btn-round">
        <a href="/sell/create"><i class="now-ui-icons ui-1_simple-add"></i></a>
    </button>
</div>
@endsection  

@section('scripts')

@endsection 
