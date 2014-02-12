<?php namespace Mataps\Forms\Region;

use Mataps\Forms\AbstractBaseForm;
use Mataps\Repositories\Region\RegionRepositoryInterface;
use Mataps\Validators\ValidatorInterface;

class RegionForm extends AbstractBaseForm implements RegionFormInterface
{
	public function __construct(RegionRepositoryInterface $repo, ValidatorInterface $validator)
	{
		$this->repo = $repo;
		$this->validator = $validator;
	}
}