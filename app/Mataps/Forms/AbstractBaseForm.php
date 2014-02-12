<?php namespace Mataps\Forms;

class AbstractBaseForm implements BaseFormInterface
{
	protected $repo;

	protected $validator;

	protected $errors;

	public function save($data)
	{
		if($this->validator->canCreate($data))
		{
			return $this->repo->create($data);
		}
		$this->errors = $this->validator->errors;
		return false;
	}

	public function deleteById($id)
	{
		$model = $this->repo->find($id);
		return ($model) ? $model->delete() : false;
	}

	public function errors()
	{
		return $this->errors;
	}

	protected function trimInputs($validKeys, $data)
	{
		$newData = array();
		foreach ($validKeys as $key) {
			if(array_key_exists($key, $data)) {
				$newData[$key] = $data[$key];
			}
		}

		return $newData;
	}
}