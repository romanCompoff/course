@extends('layouts.admin_layout')

@section('title', 'Добавить курс')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <ul>
                    @foreach ($materials as $item)
                        <li>
                            {{$item->id}} .
                            {{$item->name}} .

                            <a href="{{route('matherials.edit', [$item->id])}}">Редактировать</a>
                        </li>
                    @endforeach
                </ul>


            </div>
        </div>
    </div>
</div>
@endsection
