@extends('layouts.app')

@section('title') Коды товаров @endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card px-0 mx-0">
                <div class="card-header">Коды товаров</div>

                <div class="card-body px-1 mx-0">
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
                    <table class="mt-4 col-md-4 table table-dark table-responsive">
                        <thead>
                            <tr>
                                <th>Товар</th>
                                <th>Код</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($codes as $code)
                                <tr>
                                    <td>
                                        <a href="{{ route('code.edit', ['code'=>$code]) }} " 
                                            class="btn btn-success btn-sm">
                                        <span class="code-text-n">
                                            {{ $code->name }}
                                        </span>
                                        </a>
                                        <!-- /.code-text-n -->
                                        
                                          </td>
                                    <td> 
                                        <span class="code-text d-block">
                                            {{ $code->code }}
                                        </span>
                                        <!-- /.code-text --> 
                                        <span class="code-text d-block">
                                            {{ $code->code_n }}
                                        </span>
                                        <!-- /.code-text -->
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-1 row justify-content-center">
                        <div class="col-6 text-center py-2">
                            {{ $codes->links() }}
                        </div>
                        <!-- /.col-md-12 text-center py-2 -->
                    </div>
                    <!-- /.mt-1 row -->
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
