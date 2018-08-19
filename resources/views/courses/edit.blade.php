@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card mt-5" style="width: 50%; "  >

            <div class="card-body" >
                <h5 class="card-title">{{__('messages.create course')}}</h5>

                <form method="post" action="{{route('course.update',['id' =>$course->id])}}" enctype="multipart/form-data" >
                    {{csrf_field()}}
                    @method('patch')
                    <div class="form-group">
                        <label for="name">{{__('messages.course name')}}</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{$course->name}}" aria-describedby="name" placeholder="Enter name">

                    </div>
                    <div class="form-group">
                        <label for="duration">{{__('messages.duration')}}</label>
                        <input type="number" class="form-control" id="duration" name="duration" aria-describedby="duration" value="{{$course->duration}}" placeholder="duration">

                    </div>
                    <div class="form-group">
                        <label for="description">{{__('messages.description')}}</label>
                        <input type="text" class="form-control" name="description" id="description" aria-describedby="description" value="{{$course->description}}" placeholder="description">

                    </div>
                    <div class="form-group">
                        <label for="price">{{__('messages.level')}}</label>
                        <select name="level" id="level" class="form-control" value="{{$course->level}}" >
                            <option>{{__('message.intermediate')}}</option>
                            <option>{{__('message.medium')}}</option>
                            <option>{{__('message.professional')}}</option>
                        </select>

                    </div>


                    <div class="form-group" >
                        <label for="price">{{__('messages.price')}}</label>
                        <input type="number" name="price" class="form-control" id="price"  value="{{$course->price}}" aria-describedby="price" placeholder="price">

                    </div>
                    <div class="form-group">
                        <label for="category">{{__('messages.category')}}</label>
                        <select name="category_id[]" id="tag_list" class="form-control" multiple="multiple" >
                            @foreach($categories as $category)
                                <option value="{{$category->id}}"
                                        {{$course->categories->contains( 'id' , $category->id) ? 'selected' : ''}}>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{__('messages.select file')}}</label>
                        <input type="file" class="form-control" name="file">
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger" >
                            <ul >
                                @foreach ($errors->all() as $error)
                                    <li style="color: red" >{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif

                    <button type="submit" class="btn btn-success">save</button>
                </form>

            </div>
        </div>
    </div>

@endsection