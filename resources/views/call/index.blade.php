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
      <th scope="col">Status</th>
      <th scope="col">Entrar</th>
    </tr>
  </thead>
  <tbody>
     @foreach ($calls as $call) 
        <tr>
          <td align="center" width="33%" scope="row">{{$call->id}}</td>
          <td align="center" width="34%"><span style="width:100px;" class="badge <?php echo $call->getCallColor()?>">{{$call->getCallStatus()}}</span></td>
          <td align="center" width="33%">
            <div>
                <form action="/call/call" method="POST">
                    @csrf
                    <input type="hidden" name="call_id" value="<?php echo $call->id?>">
                    @if ($call->status != 'W')
                    <button type="submit" class="btn-icon"><i class="now-ui-icons objects_key-25"></i></button>
                    @endif
                </form>
            </div>
        </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
@endsection  

@section('scripts')

@endsection 
