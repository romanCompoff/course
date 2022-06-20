@extends('webuni.index')

@section('title', 'Домашнее задание')

@section('content')
<section class="categories-section spad">
    <div class="container">
        <div class="section-title">
            <h2>Домашнее задание к материалу "{{$material->name}}"</h2>
            <p>Следующий материал появится после прохождения текущего</p>
        </div>
        <div class="row">
            {{!!$material->homeWork!!}}

            <div class="col-12 justify-center text-center p-5">
                <form action="{{route('study.rating')}}" method="POST">
                    @csrf
                    <input type="hidden" value="5" name="rating">
                    <input type="hidden" value="{{$material->course_id}}" name="course_id">
                    <button type="submit" class="btn btn-success">Сохранить</button>
                </form>
            </div>


        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="/js/minitest.js"></script>
@endsection
