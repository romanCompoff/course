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
            <h3>Форма оплаты ля покупки курса до {{$time}}</h3>
            <br>
            <form action="{{route('study.makeStudent')}}" method="POST">
                @csrf
                <input name="course_id" type="hidden" value="{{$course_id}}">
                <input name="time" type="hidden" value="{{$time}}">

                <button type="submit" class="btn btn-primary">Оплатить</button>
            </form>
        </div>
    </div>
</section>
@endsection
