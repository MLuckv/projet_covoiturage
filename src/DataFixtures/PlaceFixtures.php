<?php

namespace App\DataFixtures;

use App\Entity\Place;
use App\Entity\User;
use App\Entity\Voyage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class PlaceFixtures extends Fixture implements DependentFixtureInterface
{
    private $counter_p = 1; 
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for($i = 1; $i <= 5; $i++){

            //réccupère la ref de departement
            $user = $this->getReference('user-'. $i);
            $voy = $this->getReference('voy-'.$i);

            $this->createPlace(
                $user,
                $i,
                $voy,
                $manager
            );
        }

        $manager->flush();
    }

    public function createPlace(User $user, int $num_place, Voyage $voy, ObjectManager $manager)
    {
        $place = new Place;
        $place->setUser($user);
        $place->setNumPlace($num_place);
        $place->setVoy($voy);
        $manager->persist($place);

        $this->addReference('pl-'.$this->counter_p, $place);
        $this->counter_p++;

        return $place;
    }

    public function getDependencies():array
    {
        return[
            VoyageFixtures::class
        ];
    }

}
