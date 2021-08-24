<?php

namespace App\DataFixtures;

use App\Entity\Person;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PersonFixtures extends Fixture
{
    protected $faker;

    public function load(ObjectManager $manager)
    {
        for($i=0; $i<=10; $i++) {
            $this->faker = Factory::create();

            $person = new Person();
            $person->setFirstName($this->faker->firstName);
            $person->setLastName($this->faker->lastName);
            $manager->persist($person);
        }

        $manager->flush();
    }
}
