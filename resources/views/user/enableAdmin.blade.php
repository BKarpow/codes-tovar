@extends('layouts.app')

@section('title') Установить права администратора для пользователя @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Установить права администратора для пользователя</div>

                <div class="card-body">
                    <h2>Форма</h2>
                    <table class="table table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Enable Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td> {{ $user->name }} </td>  
                                    <td> {{ $user->email }} </td>
                                    <td>
                                        @if (auth()->user()->isAdmin($user->role))
                                        <h4>Администратор</h4>
                                        <a class="btn btn-warning" href="{{route('user.disableAdminAction')}}?userId={{$user->id}}">
                                            Удалить права
                                        </a>
                                        @else 
                                            <h3> Обычный пользователь </h3>
                                            <a class="btn btn-success" href="{{route('user.enableAdminAction')}}?userId={{$user->id}}">
                                                Сделать администратором
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-2">
                        {{ $users->links() }}
                    </div>
                    <!-- /.mt-2 -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
