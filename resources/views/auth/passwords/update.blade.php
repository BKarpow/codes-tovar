@extends('layouts.app')

@section('title') Обновить пароль @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Измените свой пароль</div>

                <div class="card-body">
                    Для изменения Вам нужно указать старый пароль.

                    <form method="POST" action="{{ route('user.updatePassword.action') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">
                                Текущий пароль</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_new" class="col-md-4 col-form-label text-md-right">
                                Новый пароль пароль</label>

                            <div class="col-md-6">
                                <input id="password_new" type="password" 
                                class="form-control @error('password_new') is-invalid @enderror" 
                                name="password_new" required>

                                @error('password_new')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_new_c" class="col-md-4 col-form-label text-md-right">
                                Повторите новый пароль пароль</label>

                            <div class="col-md-6">
                                <input id="password_new_c" type="password" 
                                class="form-control @error('password_new_confirmation') is-invalid @enderror" 
                                name="password_new_confirmation" required >

                                @error('password_new_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Изменить пароль
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
