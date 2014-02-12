<?php namespace Mataps\Validators\Article;

use Mataps\Validators\AbstractBaseValidator;

class ArticleValidator extends AbstractBaseValidator
{
	protected $rules = array(
		'title'     => 'required',
		'content'   => 'required',
		'tags'      => 'required',
		'region'    => 'required',
		'province'  => 'required',
		'city'      => 'required',
		'category'  => 'required',
		'published' => 'required',
		'featured'  => 'required',
		'media'     => 'required',
		'featured_image' => 'required'
	);
}