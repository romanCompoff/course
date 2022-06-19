@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Информация') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- {{ __('You are logged in!') }} --}}
                    <div class="row">
<h2>Мои курсы</h2>
                            @foreach($usersCourses as $css)
                            <div class="col-lg-4 col-md-6 oneCourse" data-level="{{$css->lvl_id}}">
                               <div class="categorie-item">
                                  <div class="ci-thumb set-bg" data-setbg="/img-courses/{{$css->id}}/{{$css->img}}"></div>
                                  <div class="ci-text">
                                     <h5>{{$css->name}}</h5>
                                     <hr>
                                     <a style="width:100%" class="btn btn-success" href="{{ route('study.course', ['id'=>$css->id]) }}">Перейти</a>
                                  </div>
                               </div>
                            </div>
                            @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
