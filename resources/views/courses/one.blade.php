@extends('webuni.index')

@section('title', 'Просмотр курсов категории')

@section('content')
<div class="container">
    <div class="row py-4">
        <div class="col-12">
            <div class="categoryList">
               @role('student')
                {!! $cathegory->test !!}
                @endrole
            </div>

            <div class="coursesList d-none">
                <section class="categories-section spad">
                    <div class="">
                       <div class="section-title">
                          <h2>Наиболее подходящие курсы</h2>
                          <p>Мы подобрали курсы, которые подходят вам исходя из результатов тестирования.</p>
                       </div>
                       <div id="lvl-courses" class="row "></div>
                       <div class="section-title">
                          <h2>Остальные курсы категории</h2>
                          <p>Выбрать курсы без учета результатов теста.</p>
                       </div>
                       <div id="all-courses" class="row "></div>
                       <div class="row">
                          <!-- categorie -->
                          @foreach($courses as $css)
                          <div class="col-lg-4 col-md-6 oneCourse" data-level="{{$css->lvl_id}}">
                             <div class="categorie-item">
                                <div class="ci-thumb set-bg" data-setbg="/img-courses/{{$css->img}}"></div>
                                <div class="ci-text">
                                   <h5>{{$css->name}}</h5>
                                   <hr>
                                   <a style="width:100%" class="btn btn-success" href="{{ route('passport', ['id'=>$css->id]) }}">Купить курс</a>
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
            </div>


        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="/js/test.js"></script>
@endsection
