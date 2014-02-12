<?php

class AnnouncementCollectionSeeder extends Seeder {

    protected $collection = 'announcements';
    public $faker;

    public function __construct()
    {
        $this->faker = Faker\Factory::create();
    }

/*** Public Methods
*********************************************/


    /**
     * method that will be fired when ArticleCollectionSeeder is called
     */

    public function run()
    {
        // $this->call('UserCollectionSeeder');

    $this->clearDatabase();
    $json = $this->getSpreadsheetJson('announcements.json');
    $this->createAnnouncements($json);

    }

    public function clearDatabase()
    {
      DB::collection($this->collection)
          ->delete();
    }

    protected function getSpreadsheetJson($filename)
    {
      $data = file_get_contents(__DIR__ . '/collections/' . $filename);
      $data = json_decode($data, true);

      return $data;
    }

    protected function createAnnouncements($items)
    {
        $ids = array();
        foreach ($items as $item) {
            $id = DB::collection($this->collection)
                      ->insertGetId($this->formatAnnouncements($item));
        }
    }
    private function formatAnnouncements($item)
    {
      if(isset($item['imageFileName'])) {
        $media_id = DB::collection('media')->insertGetId(array(
          'path' => '/img/Photos/Announcements/' . $item['imageFileName'],
          'type' => 'image'
        ));

        $media = array($media_id);
      } else {
        $media = array();
      }

      $data = array(
          'content'     => array(
              'title'   => $item['title'],
              'content' => $item['body']
          ),
          'slug'        => Str::slug($item['title']),
          'published'   => 'on',
          'media'       => $media,
          'when'        => array(
            'start' => new MongoDate(strtotime($item['date']))
          )
      );

      return $data;

    }


/*** Private Methods
*********************************************/


    private function generateArticle()
    {
        $title = $this->faker->catchPhrase;
        $categ = Config::get('general.categories');
        $rand_categ = array_rand($categ);

        $stories = Story::all()->toArray();
        $rand = array_rand($stories, 4);

        $cities = City::all()->toArray();
        $rand_city = array_rand($cities);

        $media = Media::all()->toArray();

        $city_id = $cities[$rand_city]['_id'];
        $province_id = $cities[$rand_city]['province_id'];
        $province = Province::find($cities[$rand_city]['province_id'])->toArray();
        $region_id = $province['region_id'];

        $data = array(

            'content'       => array(
                'title'     => $title,
                'content'   => $this->faker->text(200)
            ),
            'slug'      => Str::slug($title),
            'tags'          => array($stories[$rand[0]]['content']['title'],$stories[$rand[1]]['content']['title'],$stories[$rand[2]]['content']['title'],$stories[$rand[3]]['content']['title']),
            'comments' => array(
                array('body'      => $this->faker->sentence(5),
                      'author'    => $this->faker->name
                    ),
                array('body'      => $this->faker->sentence(5),
                      'author'    => $this->faker->name
                    ),
                array('body'      => $this->faker->sentence(5),
                      'author'    => $this->faker->name
                    )
            ),
            'loc' => array($city_id, $province_id, $region_id),
            'region_id' => $region_id,
            'province_id' => $province_id,
            'city_id'   => $city_id,
            'published' => 'on',
            'category' => $categ[$rand_categ],
            'type'  => 'Article',
            'when'  => array(
                'start' =>new MongoDate(strtotime($this->faker->dateTimeBetween($startDate = 'now', $endDate = '+1 years')->format('Y/m/d H:i:s'))),
                'end'   => new MongoDate(strtotime($this->faker->dateTimeBetween($startDate = 'now', $endDate = '+1 years')->format('Y/m/d H:i:s')))
                ),
            'media' => array( $media[array_rand($media)]['_id'], $media[array_rand($media)]['_id'] )
        );

        return $data;
    }
}