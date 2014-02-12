<?php

use Mockery as m;

class AdminArticleControllerTest extends TestCase
{

	public function setUp()
	{
		parent::setUp();
		$db = $this->app['db'];
		$db->collection('articles')->delete();
	}

	public function tearDown()
	{
		Mockery::close();
	}

	public function testAdminIndexWithPaginator()
	{
		$pagination = new StdClass;
		$pagination->items = array();
		$pagination->totalItems = 10;
		$pagination->limit = 10;

		$paginator = m::mock('Illuminate\Pagination\Paginator');
		$paginator->shouldReceive('make')->andReturn(array());
		Paginator::swap($paginator);
		
		$this->action('GET', 'AdminArticlesController@getIndex');
		
		$this->assertResponseOk();
		$this->assertViewHas('articles', array());
	}

	public function testStoreFails()
	{
		$inputs = array('title' => '');

		$this->action('POST', 'AdminArticlesController@postAdd', $inputs);
		$this->assertSessionHasErrors();
	}

	public function testStoreSuccess()
	{
		$inputs = array(
			'title'     => 'unit-test',
			'content'   => 'unit-test',
			'tags'      => 'unit-test',
			'region'    => 'unit-test',
			'province'  => 'unit-test',
			'city'      => 'unit-test',
			'category'  => 'unit-test',
			'published' => 'unit-test',
			'featured'  => 'unit-test',
			'media'     => 'unit-test',
			'featured_image' => 'unit-test'
		);
		
		$this->action('POST', 'AdminArticlesController@postAdd', $inputs);
		$this->assertRedirectedTo('admin/articles');
	}
}