@extends('layouts.admin_layout')

@section('title', 'Указать учителя')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-info" role="alert">
                    {{$notice}}
                </div>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Список пользователей</h3>


                </div>
                <!-- /.card-header -->

                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Зарегистрирован</th>
                        <th>Учитель</th>
                        <th>Действие</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php

                        @endphp
                        @foreach($users as $user)
                      <tr>
                        <td>{{$user['id']}}</td>
                        <td>{{$user['name']}}</td>
                        <td>{{$user['created_at']}}</td>
                        <td>{{$user['isTeacher']}}</td>
                        <td>
                            @if(!$user['isTeacher'])
                            <a href="{{route('teacher.create', ['id' => $user['id']])}}" class="btn btn-warning">Сделать учителем</a>
                            @else
                            <a href="{{route('teacher.edit', ['id' => $user['tId']])}}" class="btn btn-warning">Редактировать учителя</a>
                            @endif
                        </td>
                      </tr>
                        @endforeach

                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
      </div>
      </div>
      </div>

@endsection
