<?php

use Dpsa\Repositories\City\CityRepositoryInterface;

class AdminCityController extends BaseController {

	public function __construct(CityRepositoryInterface $model)
	{
		$this->model = $model;
	}

	public function getIndex()
	{
		return 'index page';
	}

	public function getCityOptionList()
	{
		$id = Input::get('id');
    $cities = $this->model->getCitiesByProvince($id);
    $return = "<option value='null'>Select City</option>";
    foreach ($cities as $city) {
      $return .= "<option value='" . $city->_id . "'>" . $city->name . "</option>";
    }
    return $return;
	}
}
