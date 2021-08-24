<?php

namespace App\DataFixtures;

use App\Entity\TvShowEpisode;
use App\Entity\TvShowSeason;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Movie;
use Faker\Factory;

class MediaFixtures extends Fixture implements DependentFixtureInterface
{
    /* @var \Faker\Factory */
    protected $faker;

    public function load(ObjectManager $manager)
    {
        for($i=0; $i<10; $i++) {
            $this->faker = Factory::create();
            $movie = new Movie();
            $movie->setTitle($this->faker->company);
            $movie->setPosterPath($this->faker->imageUrl('185', '275', 'cats'));
            $movie->setHeroPath($this->faker->imageUrl('1920', '1080', 'animals'));
            $movie->setDuration($this->faker->numberBetween(60, 180));
            $movie->setFeatured(false);
            $movie->setInTheaterStart(new \DateTime("yesterday"));
            $movie->setInTheaterEnd(new \DateTime("tomorrow"));

            $manager->persist($movie);
        }

        $seasons = $manager->getRepository(TvShowSeason::class)->findAll();
        foreach($seasons as $season) {
            $this->faker = Factory::create();
            $numberOfEpisodes = $this->faker->numberBetween(8,14);

            for($e=0; $e<$numberOfEpisodes; $e++) {
                $episode = new TvShowEpisode();
                $episode->setTitle($this->faker->company);
                $episode->setDuration($this->faker->numberBetween(15,40));
                $episode->setSeason($season);
                $episode->setPosterPath($this->faker->imageUrl('185', '275', 'cats'));
                $episode->setHeroPath($this->faker->imageUrl('1920', '1080', 'animals'));
                $episode->setEpisodeNumber($e+1);
                $episode->setFeatured(false);


                $manager->persist($episode);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            TvShowFixtures::class,
        ];
    }
}
