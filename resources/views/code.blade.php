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
                    <div>
                        <span class="text">
                            Всього кодів: {{ $allCount }}.
                        </span>
                        <!-- /.text -->
                    </div>
                    @if ($codes->count() > 0)
                    <div class="my-1">
                        <fast></fast>
                    </div>
                    <!-- /.my-1 -->

                    

                    
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
