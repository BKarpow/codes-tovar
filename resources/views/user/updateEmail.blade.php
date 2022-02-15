@extends('layouts.app')

@section('title') Обновить email пользователя @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Обновить email ({{ $user->email }})</div>

                <div class="card-body">
                    <h2>Форма</h2>
                    <form action="{{ route('user.updateEmailAction') }}" method="POST">
                        @csrf 
                        <div class="form-group pt-1">
                            <label for="email">Ваш Email</label>
                            <input 
                                type="email"
                                require
                                name="email" 
                                id="email" 
                                placeholder="Email пользователя"
                                class="form-control"
                                value="{{ $user->email }}"
                            >
                            @error('email') 
                                <div class="alert alert-warning">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </div>
                                <!-- /.alert alert-warning -->
                            @enderror
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group mt-1">
                            <button class="btn btn-success btn-lg">
                                Обновить email
                            </button>
                        </div>
                        <!-- /.form-group -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
