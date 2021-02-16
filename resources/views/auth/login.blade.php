@extends('layouts.app')

@section('content')
<section>
    <div class="container">
        <div class="col-12 col-md-6 col-md-offset-3">
            <!-- login form -->
            <form method="POST" action="{{ route('login') }}"  class="sky-form boxed">
                @csrf
                <header><i class="fa fa-users"></i> ВХОД В ИОС</header>
                <fieldset class="m-0">	
                
                    <label class="label mt-20"><strong>E-mail</strong></label>
                    <label class="input">
                        <i class="ico-append fa fa-envelope"></i>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required >
                        <span class="tooltip tooltip-top-right">Адрес e-mail, указанный при регистрации</span>
                    </label>
                    @if ($errors->has('email'))
                    <div class="alert alert-mini alert-danger mb-30">
                        <strong>Ошибка!</strong> {{ $errors->first('email') }}
                    </div>
                    @endif
                    <label class="label mt-20"><strong>Пароль</strong></label>
                    <label class="input">
                        <i class="ico-append fa fa-lock"></i>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        <b class="tooltip tooltip-top-right">Введите Ваш пароль</b>
                    </label>
                    @if ($errors->has('password'))
                        <div class="alert alert-mini alert-danger mb-30">
                            <strong>Ошибка!</strong> {{ $errors->first('password') }}
                        </div>
                    @endif
                    <label class="checkbox mt-20">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <i></i> Запомнить
                        </label>

                </fieldset>

                <footer class="celarfix">
                    <button type="submit" class="btn btn-primary rad-0 float-right"><i class="fa fa-check"></i> ВОЙТИ</button>
                    <div class="login-forgot-password float-left">
                        <a href="{{ route('password.request') }}">Забыли пароль?</a>
                    </div>
                </footer>
            </form>
            <!-- /login form -->
        </div>
    </div>
</section>
@endsection
