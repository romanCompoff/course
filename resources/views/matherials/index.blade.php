@extends('layouts.admin_layout')

@section('title', 'Список материалов')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <ul>
                    @foreach ($materials as $item)
                        <li class="row">
                            <div class="col-4">
                                {{$item->id}} .
                            {{$item->name}} .
                            </div>
                            <div class="col-4">
                                <a href="{{route('matherials.edit', [$item->id])}}">Редактировать</a>
                            </div>
                            <div class="col-4">
                                <form action="{{route('matherials.destroy', [$item->id])}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    {{-- <input type="hidden" name="matherial" value = {{$item->id}}> --}}
                                    <button class="btn" onclick="alert('Вы уверены?')">Удалить</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>


            </div>
        </div>
    </div>
</div>
@endsection
