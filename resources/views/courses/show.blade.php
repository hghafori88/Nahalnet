@extends('layouts.app')
@section('content')
    <div class="container">
        <h3 class="mt-5">{{$course->name}}</h3>
        duration:{{ $course->duration}}<br>
        level:{{ $course->level}}<br>
        description:{{$course->description}}<br>
        price:{{ $course->price}}<br>

        categories:
        @foreach($course->categories as $category)
            <em>
                {{$category->name. ','}}
            </em>
        @endforeach

    </div>
@endsection