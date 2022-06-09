@extends('webuni.index')

@section('title', 'Главная')

@section('content')
<section class="categories-section spad">
   <div class="container">
      <div class="section-title">
         <h2>Our Course Categories</h2>
         <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.</p>
      </div>
      <div class="row">
         <!-- categorie -->
         @foreach($course as $css)
         <div class="col-lg-4 col-md-6">
            <div class="categorie-item">
               <div class="ci-thumb set-bg" data-setbg="/img-courses/{{$css->id}}/{{$css->img}}"></div>
               <div class="ci-text">
                  <h5>{{$css->name}}</h5>
                  <p>{{$css->description}}}</p>
                  <span>1111120 Courses</span>
                  @role('user')
                  <a class="btn btn-success" href="">Купить курс</a>
                  @endrole
               </div>
            </div>
         </div>
         @endforeach


      </div>
   </div>
</section>
@endsection