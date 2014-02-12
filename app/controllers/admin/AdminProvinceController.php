<?php

use Dpsa\Repositories\Province\ProvinceRepositoryInterface;

class AdminProvinceController extends BaseController {

	public function __construct(ProvinceRepositoryInterface $model)
	{
		$this->model = $model;
	}

	public function getIndex()
	{
		return 'index page';
	}

	public function getProvinceOptionList()
	{
		$id = Input::get('id');
    $provinces = $this->model->getProvincesByRegion($id);
    $return = "<option value='null'>Select Province</option>";
    foreach ($provinces as $province) {
      $return .= "<option value='" . $province->_id . "'>" . $province->name . "</option>";
    }
    return $return;
	}

}