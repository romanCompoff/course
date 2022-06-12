@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Введите паспортные данные</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('add-student') }}">
                    @csrf
                    <input type="hidden" name="user_id" value={{$user_id}}>
                    <input type="hidden" name="course_id" value={{$course_id}}>
                  <div class="card-body">
                    <div class="form-group">
                      <label for="passp_number">Номер паспорта</label>
                      <input name="passp_number" type="text" class="form-control" id="passp_number" placeholder="Номер паспорта">
                    </div>
                    <div class="form-group">
                      <label for="passp_city">Город</label>
                      <input type="text" name="passp_city" class="form-control" id="passp_city" placeholder="Город">
                    </div>
                    <div class="form-group">
                      <label for="passp_adress">Адрес</label>
                      <input type="text" name="passp_adress" class="form-control" id="passp_adress" placeholder="Адрес">
                    </div>
                    <div class="form-group">
                      <label for="passp_adrss_mfc">Кем выдан</label>
                      <input type="text" name="passp_adrss_mfc" class="form-control" id="passp_adrss_mfc" placeholder="Кем выдан">
                    </div>
                    <div class="form-group">
                      <label for="passp_date">Дата выдачи</label>
                      <input type="date" name="passp_date" class="form-control" id="passp_date" placeholder="Когда выдан">
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
@endsection


