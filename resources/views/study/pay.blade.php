@extends('webuni.index')

@section('title', 'Оплатит курс')

@section('content')
<section class="categories-section spad">
    <div class="container">
        <div class="section-title">
            <h2>Оплата </h2>
            <p>Введите реквизиты карты и оплатите выбранный курс</p>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <h3>Форма оплаты для покупки курса до {{$time}}</h3>
                <br>
                <h4>{{$money}} рублей</h4>
                <form class="text-left">
                    <div class="form-group">
                      <label for="formGroupExampleInput">Имя</label>
                      <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Введите ваше имя">
                    </div>
                    <div class="form-group">
                      <label for="formGroupExampleInput2">Номер карты</label>
                      <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Введите номер карты">
                    </div>
                  </form>
                <form action="{{route('study.makeStudent')}}" method="POST">
                    @csrf
                    <input name="course_id" type="hidden" value="{{$course_id}}">
                    <input name="time" type="hidden" value="{{$time}}">

                    <button type="submit" class="btn btn-primary mt-5 ">Оплатить</button>
                </form>
            </div>

        </div>
    </div>
</section>
@endsection
