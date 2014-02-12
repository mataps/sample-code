<?php namespace Mataps\Validators;

use Illuminate\Validation\Factory as Validator;

class AbstractBaseValidator implements ValidatorInterface
{
	protected $validator;

	protected $messages = array();

	protected $rules = array();

	protected $creationRules = array();

	public function __construct(Validator $validator)
	{
		$this->validator = $validator;
	}

	public function canCreate($data)
	{
		$rules = ! empty($this->creationRules) ? $this->creationRules : $this->rules;
		
		$validator = $this->validator->make($data, $rules, $this->messages);

		if($validator->passes()) {
			return true;
		}

		$this->errors = $validator->errors();
		return false;
	}

	public function errors()
	{
		return $this->errors;
	}
}