@extends('layouts.admin_layout')

@section('title', 'Редкатировать учителя')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="alert alert-info" role="alert">
                {{$notice}}
            </div>
            <form method="PUT" action="{{route('teacher.update', $user[0]->id)}}">
                @csrf
                <input type="hidden" value="{{$user[0]->id}}" name='tId'>
                <input type="hidden" value="{{$user[0]->users_id}}" name='uId'>
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$user[0]->email}}">
                </div>
                <div class="form-group">
                  <label >Имя</label>
                  <input  name="name" type="text" class="form-control" placeholder="Имя" value="{{$user[0]->name}}">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Специализация</label>
                  <select name="specialisation_id" id="" class="form-select form-select-lg" style="width:100%">
                      @foreach($spec as $sp)
                      <option value="{{$sp->id}}">{{$sp->name}}</option>
                      @endforeach
                  </select>
                </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Сохранить данные</button>
              </div>
            </form>
          </div>
    </div>
</div>
      </div>
    </div>
</div>
@endsection
