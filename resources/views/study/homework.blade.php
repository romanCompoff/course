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

            <a href="{{route('study.rating', ['res'=>5])}}" class="btn btn-success">Сохранить</a>
        </div>
    </div>
</div>
@endsection
