@extends('layouts.admin_layout')

@section('title', 'Редактировать Курс')

@section('content')
<div >
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
<div class="row">
    <div class="col-12">
        <div class="card card-primary">

            <img style = "width:50px"  src="/img-courses/{{$course->id}}/{{$course->img}}" alt="123">
            <form method="POST" action="{{route('courses.update',  [$course->id])}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Описание</label>
                  <input name="description" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter description" value="{{$course->description}}">
                </div>

                <div class="form-group">
                  <label >Имя</label>
                  <input  name="name" type="text" class="form-control" placeholder="Имя" value="{{$course->name}}">
                </div>
                <input type="hidden" name="id" value="{{$course->id}}">
                <input type="hidden" name="img" value="{{$course->img}}">

                <div class="form-group">
                    <label for="exampleInputFile">Картинка</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="picture" value="{{$course->img}}">
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
