@extends('layouts.app')

@section('content')
<div class="" style="padding: 0px; min-height: 93vh;">
    <section class="page-header dark page-header-xs">
        <div class="container">
            <div class="session__header">
                <img class="session__img" src="/images/session-vnutr.png" alt="">
                <h2 class="session__title">{{$learning_module->name}} <h3><a class="btn btn-primary" href="{{ $back_link }}">Назад</a> </h3></h2>
            </div>
        </div>
    </section>
    <iframe src="{{ url('/storage/modules/'.$learning_module->id.'/'.$learning_module->path) }}" width="100%" height="900px">
        
    </iframe>
</div>

@endsection