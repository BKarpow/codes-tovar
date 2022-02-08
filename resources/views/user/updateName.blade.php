@extends('layouts.app')

@section('title') Обновить имя пользователя @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Обновить Ваше имя ({{ $user->name }})</div>

                <div class="card-body">
                    <h2>Форма</h2>
                    <form action="{{ route('user.updateName.action') }}" method="POST">
                        @csrf 
                        <div class="form-group pt-1">
                            <label for="name">Ваше имя</label>
                            <input 
                                type="text"
                                require
                                name="name" 
                                id="name" 
                                placeholder="Имя пользователя"
                                class="form-control"
                                value="{{ $user->name }}"
                            >
                            @error('name') 
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
                                Обновить имя
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
