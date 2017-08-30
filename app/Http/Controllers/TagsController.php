<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Lesson;
use App\Tag;
use App\Transformers\TagsTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TagsController extends ApiController
{
    public function index($lessonId = null)
    {
    	try {
    		
    		$tags = $this->getTags($lessonId);

    	} catch(ModelNotFoundException $e) {

    		 return $this->errorNotFound();
    	}
    	

        return $this->respondWithCollection($tags, new TagsTransformer);
    }

    public function show()
    {


    }

	protected function getTags($lessonId) {
		
		$tags = $lessonId ? Lesson::findOrFail($lessonId)->tags : Tag::all();

		return $tags;
	}    
}
