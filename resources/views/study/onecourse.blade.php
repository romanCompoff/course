@extends('webuni.index')

@section('title', 'Курс')

@section('content')
<section class="categories-section spad">
    <div class="container">
        <div class="section-title">
            <h2>Материалы курса</h2>
            <p>Следующий материал появится после прохождения текущего</p>
        </div>
        <div class="row">
            <!-- categorie -->
            @foreach($materials as $css)
            <div class="col-lg-4 col-md-6">
                <div class="categorie-item">
                    <div class="ci-thumb set-bg" data-setbg="/img-courses/{{$css->course_id}}/{{$css->id}}/{{$css->picture}}"></div>
                    <div class="ci-text">
                        <h5>{{$css->name}}</h5>
                        <hr>
                        <a style="width:100%" class="btn btn-success"
                            href="{{ route('study.material', ['id'=>$css->id, 'course_id'=>$css->course_id]) }}">Смотреть материал</a>
                    </div>
                </div>
            </div>
            @if (+$student->passedMaterials < $css->id)
                @break
            @endif
            @endforeach
        </div>
    </div>
</section>
@endsection
