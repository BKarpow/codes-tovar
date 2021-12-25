@extends('layouts.app')

@section('title') Обновить код для {{$code->name}} @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Создать новый код</div>

                <div class="card-body">
                    <h2>{{$code->name}} - Редактировать</h2>
                    <form action="{{ route('code.update', ['code'=>$code]) }}" method="POST">
                        @csrf 
                        <div class="form-group pt-1">
                            <label for="name">Имя товара</label>
                            <input 
                                type="text"
                                require
                                name="name"
                                value="{{$code->name}}"
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
                                value="{{$code->code}}"
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
                                value="{{$code->code_n}}"
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
                                value="{{$code->price}}"
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
                            name="comment">{{$code->comment}}</textarea>
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
                            <button class="btn btn-primary btn-lg">
                                Сохранить код.
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
