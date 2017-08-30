<?php

namespace App\Transformers;

use App\Tag;
use League\Fractal\TransformerAbstract;

class TagsTransformer extends TransformerAbstract
{
	
	public function transform(Tag $tag) 
	{
		return [
			'name' => $tag->name
		];
	}
}