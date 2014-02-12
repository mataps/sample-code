<?php namespace Mataps\Validators;

interface ValidatorInterface {
	function canCreate($data);
	function errors();
}