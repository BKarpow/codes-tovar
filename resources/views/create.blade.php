@extends('layouts.app')

@section('title') Создать новый код @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Создать новый код</div>

                <div class="card-body">
                    <h2>Форма</h2>
                    <form action="{{ route('code.store') }}" method="POST">
                        @csrf 
                        <div class="form-group pt-1">
                            <label for="name">Имя товара</label>
                            <input 
                                type="text"
                                require
                                name="name" 
                                id="name" 
                                placeholder="Товар"
                                class="form-control"
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

                        <div class="form-group">
                            <label for="code">Код</label>
                            <input 
                                type="text"
                                require
                                name="code" 
                                id="code" 
                                pattern="^\d+$"
                                placeholder="Код товару"
                                class="form-control code-input"
                            >
                            @error('code') 
                                <div class="alert alert-warning">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </div>
                                <!-- /.alert alert-warning -->
                            @enderror
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label for="code_n">Код Н</label>
                            <input 
                                type="text"
                                name="code_n" 
                                id="code_n" 
                                require
                                pattern="^\d+$"
                                value="0"
                                placeholder="Код товару N"
                                class="form-control code-input"
                            >
                            @error('code_n') 
                                <div class="alert alert-warning">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </div>
                                <!-- /.alert alert-warning -->
                            @enderror
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label for="price">Цена</label>
                            <input 
                                type="text"
                                name="price" 
                                id="price" 
                                require
                                value="0.0"
                                placeholder="Цена"
                                class="form-control"
                            >
                            @error('price') 
                                <div class="alert alert-warning">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </div>
                                <!-- /.alert alert-warning -->
                            @enderror
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label for="price">Описания</label>
                            <textarea 
                            placeholder="Описания товара"
                            maxlength="249" 
                            class="form-control" 
                            name="comment">Просто товар</textarea>
                            @error('comment') 
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
                                Создать новый код.
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
