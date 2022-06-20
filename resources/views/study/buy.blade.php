@extends('webuni.index')

@section('title', 'Купить курс')

@section('content')
<section class="categories-section spad">
    <div class="container">
        <div class="section-title">
            <h2>Покупка</h2>
            <p>Выберите время, на которое хотите приобрести курс и нажмите "Оплатить".</p>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <h3>{{$course->name}}</h3>
                <h6>{{$course->description}}</h6>
                <img src="/img-courses/{{$course->id}}/{{$course->img}}" alt="">
                <hr>

<form action="{{route('study.pay')}}" method="POST" class="form">
    @csrf
    <input type="hidden" name="course"  value="{{$course->id}}">
    <select name="time" id="" class="form-control">
       <option value="1">1 Месяц</option>
       <option value="2">2 Месяца</option>
       <option value="3">3 Месяца</option>
       <option value="6">6 Месяцев</option>
       <option value="12">12 Месяцев</option>
    </select>
    <br>
    <hr>
    <button class="btn btn-warning mt-5 " type="submit">Оплатить</button>
 </form>
            </div>




        </div>
    </div>
</section>
@endsection
