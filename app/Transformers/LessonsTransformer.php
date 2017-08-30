<?php

namespace App\Transformers;

use App\Lesson;
use League\Fractal\TransformerAbstract;

class LessonsTransformer extends TransformerAbstract
{
	
	public function transform(Lesson $lesson) 
	{
		return [
			'title' => $lesson->title,
			'body' => $lesson->body,
			'active' => (boolean) $lesson->some_bool
		];
	}
}