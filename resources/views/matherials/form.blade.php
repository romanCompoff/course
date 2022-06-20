@extends('layouts.admin_layout')

@section('title', 'Добавить Материал')

@section('content')
<div >
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <form method="POST" action="{{route('matherials.store')}}" enctype="multipart/form-data">
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
                  <label >Домашнее задание</label>
                  <input  name="homeWork" type="text" class="form-control" placeholder="Домашнее задание" value="">
                </div>
                <div class="form-group">
                  <label for="">Преподаватель</label>
                  <select name="teacher_id" id="" class="form-select form-select-lg" style="width:100%">

                      <option value="{{$id}}">{{$name}}</option>

                  </select>
                </div>
                <div class="form-group">
                  <label for="">Курс</label>
                  <select name="course_id" id="" class="form-select form-select-lg" style="width:100%">
                    @foreach ($courses as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputFile">Картинка</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="picture">
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
