<?php namespace Mataps\Validators\Media;

use Mataps\Validators\AbstractBaseValidator;

class MediaValidator extends AbstractBaseValidator
{
	protected $rules = array(
		'file'	=> 'required',
		'tags'	=> 'required'
	);
}