<?php

namespace App\DataFixtures;

use App\Entity\Departement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class DepartementFixtures extends Fixture
{

    private $counter_d = 1;
    public function load(ObjectManager $manager): void
    {

        $faker = Faker\Factory::create('fr_FR');
        
        $this->createDepartement("Ain", 1, $manager);
        for($i = 1; $i <= 5; $i++)
        {
            $this->createDepartement(
                $faker->city(),
                $i+1,
                $manager
            );
        }
        $manager->flush();
    }

    public function createDepartement(string $name, int $code, ObjectManager $manager)
    {
        $dep = new Departement();
        $dep->setNomDepartement(strtolower($name));
        $dep->setCodeDepartement($code);
        $manager->persist($dep);

        $this->addReference('dep-'.$this->counter_d, $dep);
        $this->counter_d++;

        return $dep;
    }
}
