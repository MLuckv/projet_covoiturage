<?php

namespace App\DataFixtures;

use App\Entity\Conducteur;
use App\Entity\Ville;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ConducteurFixtures extends Fixture implements DependentFixtureInterface
{
    private $counter_d = 1;

    public function load(ObjectManager $manager): void
    {
        for($i = 1; $i <= 6; $i++){
            $vil = $this->getReference('vil-'. (rand(1,15)));
            $this->createDriver(
                $vil,
                $i+20,
                $manager
            );
        }

        $manager->flush();
    }
    public function createDriver(Ville $ville, int $age, ObjectManager $manager)
    {
        $driver = new Conducteur();
        $driver->setVilleUser($ville);
        $driver->setAge($age);

        $manager->persist($driver);

        $this->addReference('driv-'.$this->counter_d, $driver);
        $this->counter_d++;

        return $driver;
    }

    public function getDependencies():array
    {
        return[
            VilleFixtures::class,
        ];
    }
}
