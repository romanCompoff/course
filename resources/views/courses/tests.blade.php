@extends('webuni.index')

@section('title', 'Тестирование')

@section('content')
<section class="categories-section spad">
   <div class="container">
      <div class="section-title">
         <h2>Выберите категорию</h2>
         <p>Вы можете пройти тест и мы подберем вам наиболее подходящие курсы по результатам теста</p>
      </div>
      <div class="row">
         <!-- categorie -->
         @foreach($cathegoryes as $css)
         <div class="col-lg-4 col-md-6">
            <div class="categorie-item">
               <div class="ci-thumb set-bg" data-setbg="/img-courses/{{$css->img}}"></div>
               <div class="ci-text">
                  <h5>{{$css->name}}</h5>
                  <hr>
                  <a style="width:100%" class="btn btn-success" href="{{ route('one-course', ['id'=>$css->id]) }}">Смотреть курсы</a>
               </div>
            </div>
         </div>
         @endforeach
      </div>
   </div>
</section>
@endsection
