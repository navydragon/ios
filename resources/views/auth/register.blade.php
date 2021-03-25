@extends('layouts.app')

@section('content')
<section>
<div class="container">
<div class="col-12 col-md-6 col-md-offset-3">
        <form method="POST" action="{{ route('register') }}" class="sky-form boxed">
            @csrf
            <header><i class="fa fa-users"></i> РЕГИСТРАЦИЯ В ИОС</header>
            <fieldset class="m-0">	
    
        <label class="label mt-20"><strong>Фамилия</strong></label>
        <label class="input">
            <input id="lastname"  name="lastname" value="{{ old('lastname') }}" type="text" class="form-control{{ $errors->has('lastname') ? ' err' : '' }}" required >
            <span class="tooltip tooltip-top-right">Фамилия</span>
        </label>

        <label class="label mt-20"><strong>Имя</strong></label>
        <label class="input">
            <input id="firstname"  name="firstname" value="{{ old('firstname') }}" type="text" class="form-control{{ $errors->has('firstname') ? ' err' : '' }}" required >
            <span class="tooltip tooltip-top-right">Имя</span>
        </label>

        <label class="label mt-20"><strong>Отчество</strong></label>
        <label class="input">
            <input id="middlename"  name="middlename" value="{{ old('middlename') }}" type="text" class="form-control{{ $errors->has('middlename') ? ' err' : '' }}" required >
            <span class="tooltip tooltip-top-right">Отчество</span>
        </label>

        <label class="label mt-20"><strong>E-mail</strong></label>
        <label class="input">
            <input id="email"  name="email" value="{{ old('email') }}" type="email" class="form-control{{ $errors->has('email') ? ' err' : '' }}" required >
            <span class="tooltip tooltip-top-right">E-mail</span>
        </label>
        @if ($errors->has('email'))
        <div class="alert alert-mini alert-danger mb-30">
            <strong>Ошибка!</strong> {{ $errors->first('email') }}
        </div>
        @endif

        <label class="label mt-20"><strong>Пароль (не менее 6 символов)</strong></label>
        <label class="input">
            <input id="password"  name="password" value="{{ old('password') }}" type="password" class="form-control{{ $errors->has('password') ? ' err' : '' }}" required >
            <span class="tooltip tooltip-top-right">Пароль</span>
        </label>
    
        <label class="label mt-20"><strong>Повторите пароль</strong></label>
        <label class="input">
            <input id="password_confirmation"  name="password_confirmation" value="{{ old('password_confirmation') }}" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' err' : '' }}" required >
            <span class="tooltip tooltip-top-right">Повторите пароль</span>
        </label>
        @if ($errors->has('password'))
        <div class="alert alert-mini alert-danger mb-30">
            <strong>Ошибка!</strong> {{ $errors->first('password') }}
        </div>
        @endif

        <label class="label mt-20"><strong>Контактный телефон</strong></label>
        <label class="input">
            <input id="phone"  name="phone" value="{{ old('phone') }}" type="text" class="form-control  {{ $errors->has('phone') ? ' err' : '' }}" required >
            <span class="tooltip tooltip-top-right">Контактный телефон</span>
        </label>

        <label class="label mt-20"><strong>Филиал ОАО «РЖД»</strong></label>
        <label class="input">
            <select id="filial_id"  name="filial_id" value="{{ old('filial_id') }}" type="text" class="form-control  {{ $errors->has('filial_id') ? ' err' : '' }}" required >
                <option value="">Не выбрано</option> 
                @foreach($filials as $filial)
                @if ( old('filial_id') == $filial->id)
                    <option value="{{$filial->id}}" selected>{{$filial->name}}</option>
                @else
                    <option value="{{$filial->id}}">{{$filial->name}}</option>
                @endif
                @endforeach
            </select>
            <span class="tooltip tooltip-top-right">Филиал ОАО «РЖД»</span>
        </label>

        <label class="label mt-20"><strong>Подразделение</strong></label>
        <label class="input">
            <input id="division"  name="division" value="{{ old('division') }}" type="text" class="form-control  {{ $errors->has('division') ? ' err' : '' }}" required >
            <span class="tooltip tooltip-top-right">Подразделение</span>
        </label>

        <label class="label mt-20"><strong>Должность</strong></label>
        <label class="input">
            <input id="job"  name="job" value="{{ old('job') }}" type="text" class="form-control  {{ $errors->has('job') ? ' err' : '' }}" required >
            <span class="tooltip tooltip-top-right">Должность</span>
        </label>

            <div class="form-group row mb-0  ml-20">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">
                        Зарегистрироваться
                    </button>
                    <a class="btn btn-link" href="{{ route('login') }}">
                        Уже зарегистрированы?
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
</section>

@endsection
