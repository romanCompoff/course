@extends('webuni.index')

@section('title', 'Главная')

@section('block2')
<section id="block2">
    <div class="row">
        <div class="col-12 col-md-6"><img src="/webuni/img/works/1.jpg" alt="">
    <h3>1. Теория</h3>
    <span>
    Изучаем новую лексику, грамматику и случаи, гдед можно использовать эти знания.
    </span>

    </div>
        <div class="col-12 col-md-6"><img src="/webuni/img/works/2.jpg" alt="">
    <h3>2. Практика</h3>
    <span>Оттачиваем грамматику, произношение и чтение на разных примерах.</span>

    </div>
        <div class="col-12 col-md-6"><img src="/webuni/img/works/12.jpg" alt="">
    <h3>3. Задания на дом</h3>
    <span>
    В конце каждого занятия даем задания на дом.
    </span>

</div>
        <div class="col-12 col-md-6"><img src="/webuni/img/works/3.jpg" alt="">
    <h3>4. Повторение</h3>
    <span>
    Каждое занятие начинается с повторения пройденного материала.
    </span>
    </div>
    </div>
</section>
@endsection
@section('content')
<section class="categories-section spad">
   <div class="container">
      <div class="section-title">
         <h2>Our Course Categories</h2>
         <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.</p>
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
                  @role('user')
                  <hr>
                  {{-- <a style="width:100%" class="btn btn-success" href="{{ route('passport') }}">Купить курс</a> --}}
                  @endrole
               </div>
            </div>
         </div>
         @endforeach


      </div>
   </div>
</section>
@endsection
