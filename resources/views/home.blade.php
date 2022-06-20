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
                                  <div class="ci-thumb set-bg" data-setbg="/img-courses/{{$css->id}}/{{$css->img}}">
                                Рейтинг{{$css->rating}}
                                </div>
                                  <div class="ci-text">
                                     <h5>{{$css->name}}</h5>
                                     <hr>
                                     <a style="width:100%" class="btn btn-success" href="{{ route('study.course', ['id'=>$css->id]) }}">Перейти</a>
                                  </div>
                               </div>
                            </div>
                            @endforeach

                    </div>
                    <div class="row">
                        <h2>Мои домашние задания</h2>
                            @foreach($homeWorks as $css)

                            @foreach($css as $c)
                            <div class="col-lg-4 col-md-6 oneCourse" >
                               <div class="categorie-item">
                                  <div class="ci-thumb set-bg" data-setbg="/img-courses/{{$c->course_id}}/{{$c->id}}/{{$c->picture}}"></div>
                                  <div class="ci-text">
                                     <h5>{{$c->name}}</h5>
                                     <hr>
                                     <a style="width:100%" class="btn btn-success" href="{{ route('study.homework', [
                                         'course_id'=>$c->course_id,
                                         'id'=>$c->id
                                         ]) }}">Перейти</a>
                                  </div>
                               </div>
                            </div>
                            @endforeach
                            @endforeach

                    </div>
                    <div class="row">
                        <h2>Рейтинг студентов</h2>
                        <div class="col-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                      <th>First Name</th>
                                      <th>Rating</th>
                                    </tr>
                                <tbody>
                                    @foreach ($mainRating as $item)
                                    <tr><td>{{$item->name}}</td><td>{{+$item->rating}}</td></tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
