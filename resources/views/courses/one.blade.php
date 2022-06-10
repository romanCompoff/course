@extends('webuni.index')

@section('title', 'Главная')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">

{!! $cathegory->test !!}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="/js/test.js"></script>
@endsection
