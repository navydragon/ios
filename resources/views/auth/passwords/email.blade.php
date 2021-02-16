@extends('layouts.app')

@section('content')
<section>
    <div class="container">
        <div class="col-12 col-md-6 col-md-offset-3">
            <!-- login form -->
            <form method="POST" action="{{ route('password.email') }}"  class="sky-form boxed">
                @csrf
                <header><i class="fa fa-users"></i> ВОССТАНОВЛЕНИЕ ПАРОЛЯ</header>
                <fieldset class="m-0">	
                    <p class="m-10">Введите Ваш e-mail и нажмите на кнопку "Отправить ссылку на сброс пароля"</p>
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

                </fieldset>

                <footer class="celarfix">
                    <button type="submit" class="btn btn-primary rad-0 float-right"><i class="fa fa-check"></i> Отправить ссылку на сброс пароля</button>
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
