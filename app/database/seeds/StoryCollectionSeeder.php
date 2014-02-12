<?php

class StoryCollectionSeeder extends Seeder {

  public $faker;
  protected $collection = 'stories';

  function __construct()
  {
      $this->faker =  Faker\Factory::create();
      $this->media = $media = Media::all()->toArray();
  }

  /*** Public Methods
  *********************************************/

  /**
  * method that will be fired when StoryCollectionSeeder is called
  */
  public function run()
  {
    $this->clearDatabase();
    $this->generateStories();
  }

  public function clearDatabase()
  {
    DB::collection($this->collection)
        ->delete();
  }

  public function generateStories()
  {
    $stories = $this->getSpreadsheetJson('stories.json');
    $this->createStories($stories);
  }

  protected function getSpreadsheetJson($filename)
  {
    $regions = file_get_contents(__DIR__ . '/collections/' . $filename);
    $regions = json_decode($regions, true);

    return $regions;
  }

  public function createStories($stories)
  {
    $ids = array();
    foreach ($stories as $story)
    {
      $id = DB::collection($this->collection)
              ->insertGetId( $this->formatStory($story) );
    }

    return $ids;
  }

  public function formatStory($story)
  {
    if(file_exists(public_path() . '/img/Photos/' . $story['imageFilename'] . '.jpg')){
      $media_id = DB::collection('media')
          ->insertGetId(array(
              'path' => '/img/Photos/' . $story['imageFilename'] . '.jpg',
              'type' => 'image',
              'tags' => array($story['title'])
            ));      
    }
    else{
      $media_id = Media::getIdByTag($story['category']);
    }

    $region_id    = $this->getRegionId( $story['region'] );
    $province_id  = isset($story['province']) ? $this->getProvinceId( $region_id, $story['province'] ) : null;
    $city_id      = isset($story['municipality']) ? $this->getCityId( $region_id, $province_id, $story['municipality'] ) : null;

    $data = array(
        'content'       => array(
            'title'     => $story['title'],
            'subtitle'  => (isset($story['subTitle'])) ? $story['subTitle'] : null,
            'content'   => '<p>' . $story['bodydescription'] . '</p>'
        ),
        'slug'        => Str::slug($story['title']),
        'loc'         => array($city_id, $province_id, $region_id),
        'region_id'   => $region_id,
        'province_id' => $province_id,
        'city_id'     => $city_id,
        'published'   => 'on',
        'category'    => $story['category'],
        'media'       => array($media_id),
        'total_read'  => 0
    );

    return $data;
  }

  public function getRegionId($region)
  {
    $data = array(
      'name'          => $region,
      'slug'          => Str::slug($region),
      'screen_name'   => 'Region Name',
      'description'   => '<p>'.implode("</p><p>", $this->faker->paragraphs(3)).'</p>',
      'published'     => 'on', 
      'media'         => array( $this->media[array_rand($this->media)]['_id'], $this->media[array_rand($this->media)]['_id'] )
    );

    $region = DB::collection('regions')
                ->where('name', $region)
                ->first();

    if( ! $region)
    {
      $region = DB::collection('regions')
        ->insertGetId($data);

      return $region;
    }
    else
    {
      return (string)$region['_id'];
    }
  }

  public function getProvinceId($region_id, $province)
  {
    $data = array(
      'name'          => $province,
      'slug'          => Str::slug($province),
      'description'   => '<p>'.implode("</p><p>", $this->faker->paragraphs(3)).'</p>',
      'region_id'     => $region_id,
      'published'     => 'on', 
      'media'         => array( $this->media[array_rand($this->media)]['_id'], $this->media[array_rand($this->media)]['_id'] )
    );

    $province = DB::collection('provinces')
                ->where('name', $province)
                ->first();

    if( ! $province)
    {
      $province = DB::collection('provinces')
        ->insertGetId($data);

      return $province;
    }
    else
    {
      return (string)$province['_id'];
    }
  }

  public function getCityId($region_id, $province_id, $city)
  {
    $data = array(
      'name'          => $city,
      'slug'          => Str::slug($city),
      'description'   => '<p>'.implode("</p><p>", $this->faker->paragraphs(3)).'</p>',
      'province_id'   => $province_id,
      'region_id'     => $region_id,
      'published'     => 'on', 
      'media'         => array( $this->media[array_rand($this->media)]['_id'], $this->media[array_rand($this->media)]['_id'] )
    );

    $city = DB::collection('cities')
                ->where('name', $city)
                ->first();

    if( ! $city)
    {
      $city = DB::collection('cities')
        ->insertGetId($data);

      return $city;
    }
    else
    {
      return (string)$city['_id'];
    }
  }
}