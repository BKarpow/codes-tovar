@extends('layouts.app')

@section('title') Коды товаров @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Коды товаров</div>

                <div class="card-body">
                    <div class="my-1">
                        <a href="{{route('code.create')}}" class="btn btn-primary">
                            + Добавить
                        </a>
                        <!-- /.btn btn-primary -->
                    </div>
                    <!-- /.my-1 -->
                    @if ($codes->count() > 0)
                    <div class="my-1">
                        <fast></fast>
                    </div>
                    <!-- /.my-1 -->
                    <table class="table table-dark table-responsive table-hover">
                        <thead>
                            <tr>
                                <th>Товар</th>
                                <th>Код</th>
                                <th>Код Н</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($codes as $code)
                                <tr>
                                    <td>
                                        <span class="code-text-n">
                                            {{ $code->name }}
                                        </span>
                                        <!-- /.code-text-n -->
                                        <div class="mt-1">
                                            <a href="{{ route('code.edit', ['code'=>$code]) }} " class="btn btn-warning btn-sm">
                                                Редактировать
                                            </a>
                                            <!-- /.btn btn-warning btn-sm -->
                                        </div>
                                        <!-- /.mt-1 -->
                                          </td>
                                    <td> 
                                        <span class="code-text">
                                            {{ $code->code }}
                                        </span>
                                        <!-- /.code-text --> 
                                </td>
                                    <td>
                                        <span class="code-text">
                                            {{ $code->code_n }}
                                        </span>
                                        <!-- /.code-text --> 
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else 
                        <div class="alert alert-secondary">
                            Поки немає кодів...
                        </div>
                        <!-- /.alert alert-secondary -->
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
