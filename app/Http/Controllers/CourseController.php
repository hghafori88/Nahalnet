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
        $courses=$this->course->all();
        return view('courses.index',compact('courses'));
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
        $request->validate([
            'name' => 'string|required|max:256',
            'duration' => 'numeric|required',
            'file' => 'file|mimes:mp4,avi,mov|required|max:30000',
            'price' => 'numeric'
        ]);
        $video_path=$request->file('file')->store('videos');
        $course=Auth::user()->Courses()->create(
           [
               'name' => $request['name'],
               'duration' => $request['duration'],
               'description' => $request['description'],
               'level' => $request['level'],
               'video_path' => $video_path,
               'price' => $request['price'],

           ]);
        $course->categories()->attach($request->get('category_id'));
        return back()->with('message','ثبت با موفقیت انجام شد');



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $course=$this->course->find($id);
        $this->authorize('update',$course);
        return view('courses.show',compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $course=$this->course->find($id);
        $this->authorize('update',$course);
        $categories=Category::all();
        return view('courses.edit',compact('course'),compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'string|required|max:256',
            'duration' => 'numeric|required',
            'file' => 'file|mimes:mp4,avi,mov|required|max:30000',
            'price' => 'numeric'
        ]);
        $video_path=$request->file('file')->store('videos');
        $course=$this->course->find($id);
        $course->update([
            'name' => $request['name'],
            'duration' => $request['duration'],
            'description' => $request['description'],
            'level' => $request['level'],
            'video_path' => $video_path,
            'price' => $request['price'],

        ]);
        $course->categories()->sync($request->get('category_id'));
        return redirect('/course');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $course=Course::find($id);
        $course->delete();
        return back();
    }
}
