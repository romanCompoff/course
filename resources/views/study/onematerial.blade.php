@extends('webuni.index')

@section('title', 'Курс')

@section('content')
<section class="categories-section spad">
    <div class="container">
        <div class="section-title">
            <h2>Материал</h2>
            <p>{{$materials->description}}</p>
        </div>
        <div class="row">
            <!-- categorie -->
            {{-- @foreach($materials as $css)
            <div class="col-lg-4 col-md-6">
                <div class="categorie-item">
                    <div class="ci-thumb set-bg" data-setbg="/img-courses/{{$css->course_id}}/{{$css->picture}}"></div>
                    <div class="ci-text">
                        <h5>{{$css->name}}</h5>
                        <hr>
                        <a style="width:100%" class="btn btn-success"
                            href="{{ route('courseInCathegory', ['id'=>$css->id]) }}">Смотреть курсы</a>
                    </div>
                </div>
            </div>
            @endforeach --}}
            <a href="{{route('study.passed', ['course_id'=>$student->course_id, 'id'=>$materials->id])}}" class="btn btn-success">Материал пройден</a>
        </div>
    </div>
</section>
@endsection


