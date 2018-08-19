@extends('layouts.app')

@section('content')
    <div class="container col-6">

        <table class="table">
            <tr>
                <th>
                    book name
                </th>
                <th>
                    creator
                </th>
                <th>

                </th>
                <th>

                </th>
            </tr>

            @foreach($courses as $course)
                <tr>
                    <td><a href="{{"/course/".$course->id}}">{{$course->name}}</a></td>
                    <td>creator: {{$course->user->name}}</td>
                    @can('update',$course)
                        <td><a href="{{route('course.edit',['id'=>$course->id])}}" class="btn btn-primary">update</a></td>
                        <td><form action="{{route('course.destroy',['id'=>$course->id])}}" method="post">{{ csrf_field() }}{{ method_field('DELETE') }}<button type="submit" class="btn btn-danger">delete</button></form></td>
                    @else
                        <td></td>
                        <td></td>
                    @endcan
                </tr>
            @endforeach
        </table>
        <a href="{{route('course.create')}}" class="btn-success btn-block">create</a>
    </div>
@endsection