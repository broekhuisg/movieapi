<?php

namespace App\DataFixtures;

use App\Entity\TvShow;
use App\Entity\TvShowSeason;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class TvShowFixtures extends Fixture
{
    protected $faker;

    public function load(ObjectManager $manager)
    {
        for($i=0; $i<10; $i++) {
            $this->faker = Factory::create();

            $show = new TvShow();
            $show->setTitle($this->faker->company);
            $show->setPosterPath('posterPathTvshow');

            $numberofSeasons = $this->faker->numberBetween(2,6);

            for($s=0; $s<$numberofSeasons; $s++) {
                $season = new TvShowSeason();
                $season->setSeasonNumber($s+1);
                $season->setTvShow($show);
                $manager->persist($season);
            }

            $manager->persist($show);
        }

        $manager->flush();
    }
}
