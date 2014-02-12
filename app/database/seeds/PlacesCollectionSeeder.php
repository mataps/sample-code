<?php

class PlacesCollectionSeeder extends Seeder {

	protected $media = array();

	public function __construct()
	{
		$this->media = $media = Media::all()->toArray();
	}

	/*** Public Methods
	*********************************************/

	/**
	* function that will fire when PlaceCollectionSeeder 
	*/
	public function run()
	{
			$this->clearDatabase();

			$this->generatePlaces();
	}

	protected function generatePlaces()
	{
		$regions 		= $this->getSpreadsheetJson( 'regions.json' );
		$region_ids = $this->generateRegions($regions);

		$provinces 	= $this->getSpreadsheetJson( 'provinces.json' );
		$province_ids = $this->generateProvinces($region_ids, $provinces);
	}

	protected function getSpreadsheetJson($filename)
	{
		$regions = file_get_contents(__DIR__ . '/collections/' . $filename);
    $regions = json_decode($regions, true);

		return $regions;
	}

	public function generateRegions($regions)
	{
		$ids = array();
		foreach ($regions as $region)
		{
			$id = DB::collection('regions')
							->insertGetId( $this->formatRegion($region) );

			$ids[$region['region']] = $id;
		}

		return $ids;
	}

	public function generateProvinces($region_ids, $provinces)
	{
		$ids = array();
		foreach ($provinces as $province)
		{
			$region_id = isset($region_ids[$province['region']])
										? $region_ids[$province['region']]
										: null;

			$id = DB::collection('provinces')
										->insertGetId( $this->formatProvince($region_id, $province) );

			$ids[$province['name']] = $id;
		}

		return $ids;
	}

	protected function clearDatabase()
	{
		DB::collection('regions')
			->delete();
		DB::collection('provinces')
			->delete();
		DB::collection('cities')
			->delete();
	}

	/*** Private Methods
	*********************************************/

	/**
	 * This will generate the data for Region
	 *
	 * @param string $region
	 * @return array $data
	 */

	private function formatRegion($data)
	{
		$faker = Faker\Factory::create();

		$data = array(
			'name'          => $data['region'],
			'slug'					=> Str::slug($data['region']),
			'screen_name'		=> $data['screenName'],
			'description'   => '',
			'published'     => 'on', 
			'media' 				=> array( $this->media[array_rand($this->media)]['_id'], $this->media[array_rand($this->media)]['_id'] )
		);

		return $data;
	}

	private function formatProvince($region_id, $province)
	{
			$faker = Faker\Factory::create();
			$data = array(
					'name'          => $province['name'],
					'slogan'				=> $province['slogan'],
					'slug'					=> Str::slug($province['name']),
					'description'   => '<p>' . $province['description'] . '</p>',
					'region_id'     => $region_id,
					'published'     => 'on',
					'media' 				=> array( $this->media[array_rand($this->media)]['_id'], $this->media[array_rand($this->media)]['_id'] )
			);

			return $data;
	}

	/**
	 * This will generate the data for City
	 *
	 * @param string $province_id
	 * @param string $city_name
	 * @return array $data
	 */

	private function generateCity($region_id, $province_id, $city_name)
	{
			$faker = Faker\Factory::create();
			$data = array(
					'name' 				=> $city_name,
					'slug'				=> Str::slug($city_name),
					'description' => $faker->text(200),
					'province_id' => $province_id,
					'region_id'   => $region_id,
					'published'     => 'on',
					'media' 				=> array( $this->media[array_rand($this->media)]['_id'], $this->media[array_rand($this->media)]['_id'] )
			);

			return $data;
	}

	/*** Protected Methods
	*********************************************/

}