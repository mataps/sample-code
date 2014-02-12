<?php

use Mataps\Repositories\AbstractBaseRepository;

class AbstractBaseRepositoryTest extends TestCase
{
	
	public function tearDown()
	{
		Mockery::close();
	}
	
	public function testAll()
	{
		$validator = Mockery::mock('Mataps\Validators\ValidatorInterface');
		$repo = Mockery::mock('ExampleRepo[orderBy,get]');
		$repo->shouldReceive('orderBy->get')->andReturn('foo');

		$this->assertEquals('foo', $repo->getAll());
	}

	public function testById()
	{
		$validator = Mockery::mock('Mataps\Validators\ValidatorInterface');
		$repo = Mockery::mock('ExampleRepo[find]');
		$repo->shouldReceive('find')->andReturn('foo');

		$this->assertEquals('foo', $repo->byId(1));
	}

	public function testCreateThrowsExceptionIfNoValidator()
	{
		$validator = Mockery::mock('Mataps\Validators\ValidatorInterface');
		$repo = Mockery::mock('ExampleRepo[create]');
		$repo->shouldReceive('create');

		$this->setExpectedException('Exception');
		$repo->save(array());
	}
}

class ExampleRepo extends AbstractBaseRepository
{
}