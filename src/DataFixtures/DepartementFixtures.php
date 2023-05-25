<?php

namespace App\DataFixtures;

use App\Entity\Departement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DepartementFixtures extends Fixture
{

    private $counter_d = 1;
    public function load(ObjectManager $manager): void
    {
        $this->createDepartement("Ain", 1, $manager);

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
