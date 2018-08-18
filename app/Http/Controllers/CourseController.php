<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Course;
use Auth;
use App\Models\Category;

class CourseController extends Controller
{
    protected $course;
    public function __construct(Course $course)
    {
        $this->middleware('auth');
        $this->course=$course;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course=$this->course->all();
        return view('courses.index',compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('courses.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $video_path=$request->file('video')->store('videos');
        $course=Auth::user()->Courses()->create(
           [
               'name' => $request['name'],
               'duration' => $request['duration'],
               'description' => $request['description'],
               'level' => $request['level'],
               'video_path' => $video_path,
               'price' => $request['price'],
               'video_path' => $video_path
           ]);
        $course->categories()->attach($request->get('category_id'));



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $id)
    {
        $course=$this->course->findOrFaild($id);
        $this->authorize('update',$course);
        return view('courses.show',compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $id)
    {
        //
    }
}
