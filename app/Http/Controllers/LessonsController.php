<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Lesson;
use App\Transformers\LessonsTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use League\Fractal\Manager;

class LessonsController extends ApiController
{
    public function __construct(Manager $fractal) {
        parent::__construct($fractal);
        $this->middleware('auth.basic')->only('store');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = Input::get('limit') ?: 3; 
        $lessons = Lesson::paginate($limit);

        return $this->respondWithPagination($lessons, new LessonsTransformer);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Input::get('title') || !Input::get('body')) {

            return $this->errorWrongArgs('Parameters failed validation for a lesson');
        }

        Lesson::create(Input::all());
        
        return $this->setStatusCode(201)->respondWithArray([
            'message' => 'Lesson successfully created',
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::find($id);
        if(!$lesson) {
            return $this->errorNotFound();
       }

       return $this->respondWithItem($lesson, new LessonsTransformer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        //
    }
}
