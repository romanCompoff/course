@extends('webuni.index')

@section('title', 'Купить курс')

@section('content')
<section class="categories-section spad">
    <div class="container">
        <div class="section-title">
            <h2>Покупака</h2>
            <p>Выберите время, на которое хотите приобрести курс и нажмите "Оплатить".</p>
        </div>
        <div class="row">
           {{$course->name}}
           {{$course->description}}
           {{$course->img}}
  
<form action="{{route('study.pay')}}" method="POST">
   @csrf
   <input type="hidden" name="course" value="{{$course->id}}">
   <select name="time" id="">
      <option value="1">1 Месяц</option>
      <option value="3">2 Месяца</option>
      <option value="3">3 Месяца</option>
      <option value="3">6 Месяцев</option>
      <option value="3">12 Месяцев</option>
   </select>
   <button class="btn btn-warning" type="submit">Оплатить</button>
</form>
        </div>
    </div>
</section>
@endsection
