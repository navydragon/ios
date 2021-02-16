@extends('layouts.app')

@section('content')

<section>
    <div class="container">
        <div class="col-12 col-md-6 col-md-offset-3">
            <!-- login form -->
            <form method="POST" action="{{ route('password.request') }}"  class="sky-form boxed">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <header><i class="fa fa-users"></i> НОВЫЙ ПАРОЛЬ</header>
                <fieldset class="m-0">	
                    <p class="m-10">Установите новый пароль</p>
                    <label class="label mt-20"><strong>E-mail</strong></label>
                    <label class="input">
                        <i class="ico-append fa fa-envelope"></i>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email }}" required >
                        <span class="tooltip tooltip-top-right">Адрес e-mail, указанный при регистрации</span>
                    </label>
                    @if ($errors->has('email'))
                    <div class="alert alert-mini alert-danger mb-30">
                        <strong>Ошибка!</strong> {{ $errors->first('email') }}
                    </div>
                    @endif
                    <label class="label mt-20"><strong>Пароль (не менее 8 символов)</strong></label>
                    <label class="input">
                        <input id="password"  name="password" value="{{ old('password') }}" type="password" class="form-control{{ $errors->has('password') ? ' err' : '' }}" required autofocus >
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
                </fieldset>

                <footer class="celarfix">
                    <button type="submit" class="btn btn-primary rad-0 float-right"><i class="fa fa-check"></i> ОБНОВИТЬ ПАРОЛЬ</button>
                </footer>
                @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                @endif
            </form>
            <!-- /login form -->
        </div>
    </div>
</section>


@endsection
