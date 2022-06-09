@extends('layouts.admin_layout')

@section('title', 'Список курсов')

@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
     <div class="container-fluid">
<div class="row">
   <div class="col-12">
 
<ul>
@foreach($courses as $cs)


   <li>{{$cs->name}}</li>

@endforeach
</ul>
</div>
</div>
</div>
</div>
</div>
@endsection