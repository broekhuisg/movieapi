<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Media;
use App\Entity\Movie;
use App\Entity\TvShow;
use Faker\Factory;

class MediaFixtures extends Fixture
{
    /* @var \Faker\Factory */
    protected $faker;

    public function load(ObjectManager $manager)
    {
        for($i=0; $i<10; $i++) {
            $this->faker = Factory::create();
            $movie = new Movie();
            $movie->setTitle($this->faker->company);
            $movie->setPosterPath('posterpathstring');
            $movie->setDuration($this->faker->numberBetween(60, 180));
            $manager->persist($movie);
        }

        $manager->flush();
    }
}
