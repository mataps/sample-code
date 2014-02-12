<?php namespace Mataps\Validators\Region;

use Mataps\Validators\AbstractBaseValidator;

class RegionValidator extends AbstractBaseValidator
{
	protected $rules = array(
		'name'	=> 'required',
		'screen_name'	=> 'required',
		'media'	=> 'required',
		'lat'		=> 'required',
		'long'	=> 'required',
		'content' => 'required'
	);
}