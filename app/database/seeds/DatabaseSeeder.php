<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('MediaCollectionSeeder');
		$this->call('PlacesCollectionSeeder');
		$this->call('StoryCollectionSeeder');
		$this->call('ArticleCollectionSeeder');
		$this->call('NewsCollectionSeeder');
		$this->call('EventCollectionSeeder');
		$this->call('AnnouncementCollectionSeeder');
	}
}