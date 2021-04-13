<?php

namespace App\DataFixtures;

use App\Entity\TvShow;
use App\Entity\TvShowEpisode;
use App\Entity\TvShowSeason;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\MediaFixtures;
use Faker\Factory;

class TvShowSeasonFixtures extends Fixture
{
    /* @var \Faker\Factory */
    protected $faker;

    public function load(ObjectManager $manager)
    {
        $shows = $manager->getRepository(TvShow::class)->findAll();

        if(count($shows) > 0) {
            foreach($shows as $key => $show) {
                $season = new TvShowSeason();
                $season->setSeasonNumber(1);
                $season->setTvShow($show);
                $manager->persist($season);

                for($i=1; $i<12; $i++) {
                    $this->faker = Factory::create();

                    $episode = new TvShowEpisode();
                    $episode->setEpisodeNumber($i);
                    $episode->setTitle($this->faker->company);
                    $episode->setDuration($this->faker->numberBetween(15, 45));
                    $episode->setPosterPath('posterpathEpsiode');
                    $episode->setSeason($season);
                    $manager->persist($episode);
                }

//                $season = new TvShowSeason();
//                $season->setSeasonNumber(2);
//                $season->setTvShow($show);
//
//                for($i=1; $i<14; $i++) {
//                    $this->faker = Factory::create();
//
//                    $episode = new TvShowEpisode();
//                    $episode->setEpisodeNumber($i);
//                    $episode->setTitle($this->faker->company);
//                    $episode->setDuration($this->faker->numberBetween(15, 45));
//                    $episode->setPosterPath('posterpathEpsiode');
//                    $episode->setSeason($season);
//                }
//
//                $season = new TvShowSeason();
//                $season->setSeasonNumber(3);
//                $season->setTvShow($show);
//
//                for($i=1; $i<13; $i++) {
//                    $this->faker = Factory::create();
//
//                    $episode = new TvShowEpisode();
//                    $episode->setEpisodeNumber($i);
//                    $episode->setTitle($this->faker->company);
//                    $episode->setDuration($this->faker->numberBetween(15, 45));
//                    $episode->setPosterPath('posterpathEpsiode');
//                    $episode->setSeason($season);
//                }
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            MediaFixtures::class,
        ];
    }
}
