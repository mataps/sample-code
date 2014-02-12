<?php

class EventCollectionSeeder extends Seeder {

    protected $collection = 'events';
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
        $this->clearDatabase();
        $json = $this->getSpreadsheetJson('events.json');
        $this->createEvents($json);
    }

    public function clearDatabase()
    {
      DB::collection($this->collection)
          ->delete();
    }

    public function createEvents($items)
    {
      $ids = array();
      foreach ($items as $item)
      {
        $id = DB::collection($this->collection)
                ->insertGetId( $this->formatEvents($item) );
      }

      return $ids;
    }

    protected function getSpreadsheetJson($filename)
    {
      $data = file_get_contents(__DIR__ . '/collections/' . $filename);
      $data = json_decode($data, true);

      return $data;
    }

/*** Private Methods
*********************************************/


    private function formatEvents($item)
    {
      if(isset($item['imageFilename'])) {
        $media_id = DB::collection('media')->insertGetId(array(
          'path' => '/img/Photos/Events/' . $item['imageFilename'].'.jpg',
          'type' => 'image'
        ));

        $media = array($media_id);
      } else {
        $media = array();
      }
      $title = $item['title'];
      $date_start = $item['month'] == 'December' ? new DateTime('12/'.$item['date'].'/2013') : new DateTime('1/'.$item['date'].'/2014');
      $date_end   = $item['month'] == 'December' ? new DateTime('12/'.$item['date'].'/2035') : new DateTime('1/'.$item['date'].'/2035');

      $data = array(
          'content'     => array(
              'title'   => $title,
              'content' => $item['bodydescription']
          ),
          'slug'        => Str::slug($title),
          'published'   => 'on',
          'media'       => $media,
          'when'        => array(
            'start' => new MongoDate($date_start->getTimestamp()),
            'end'   => new MongoDate($date_end->getTimestamp())
          )
      );

      return $data;
    }
}