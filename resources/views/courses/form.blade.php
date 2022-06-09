@extends('layouts.admin_layout')

@section('title', 'Добавить курс')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="alert alert-info" role="alert">
                {{$notice}}              {{session('success')}}

            </div>
            <form method="POST" action="{{route('courses.store')}}" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Описание</label>
                  <input name="description" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter description" value="">
                </div>
                <div class="form-group">
                  <label >Имя</label>
                  <input  name="name" type="text" class="form-control" placeholder="Имя" value="">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Расписание</label>
                  <select name="shedule_id" id="" class="form-select form-select-lg" style="width:100%">
                      @foreach($shedules as $sp)
                      <option value="{{$sp->id}}">{{$sp->name}}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Уровень</label>
                  <select name="lvl_id" id="" class="form-select form-select-lg" style="width:100%">
                      @foreach($lvl as $sp)
                      <option value="{{$sp->id}}">{{$sp->description}}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Группа</label>
                  <select name="group_id" id="" class="form-select form-select-lg" style="width:100%">
                      @foreach($groups as $sp)
                      <option value="{{$sp->id}}">{{$sp->name}}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Преподаватель</label>
                  <select name="teacher_id" id="" class="form-select form-select-lg" style="width:100%">

                      <option value="{{$teacher['id']}}">{{$teacher['name']}}</option>

                  </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputFile">Картинка</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="img">
                        <label class="custom-file-label" for="exampleInputFile">Выбрать файл</label>
                      </div>
                      {{-- <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div> --}}
                    </div>
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
