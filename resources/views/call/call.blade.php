@extends('layouts.app')

@section('title')
Chamada {{$call->id}}
@endsection

@section('content')
<div align="center"> 
    <h6  style="text-transform: uppercase" class="text-orange">Seja bem vindo a chamada com {{$call->user->name}}</h6>
    <span style="width:100px;" class="badge <?php echo $call->getCallColor()?>">{{$call->getCallStatus()}}</span>
</div>
@endsection  

@section('scripts')

@endsection 
