@extends('webuni.index')

@section('title', 'Список категорий курсов')

@section('content')
<section class="categories-section spad">
    <div class="container">
       <div class="section-title">
          <h2>Категории курсов</h2>
          <p>Выберите необходимую категорию.</p>
       </div>
       <div class="row">
          <!-- categorie -->
          @foreach($courses as $css)
          <div class="col-lg-4 col-md-6">
             <div class="categorie-item">
                <div class="ci-thumb set-bg" data-setbg="/img-courses/{{$css->id}}/{{$css->img}}"></div>
                <div class="ci-text">
                   <h5>{{$css->name}}</h5>
                   <hr>
                   <a style="width:100%" class="btn btn-success" href="{{ route('passport', ['id'=>$css->id]) }}">Купить курс</a>
                </div>
             </div>
          </div>
          @endforeach
       </div>
    </div>
 </section>
@endsection
