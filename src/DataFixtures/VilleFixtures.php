<?php

namespace App\DataFixtures;

use App\Entity\Ville;
use App\Entity\Departement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class VilleFixtures extends Fixture implements DependentFixtureInterface
{
    private $counter_v = 1;
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for($i = 1; $i <= 15; $i++){

            //réccupère la ref de departement
            $dep = $this->getReference('dep-'. rand(1,6));

            $this->createVille(
                $faker->city(),
                $dep,
                $manager
            );
        }

        $manager->flush();
    }
    public function createVille(string $nom, Departement $departement, ObjectManager $manager)
    {
        $ville = new Ville();
        $ville->setNomVille($nom);
        $ville->setDepartement($departement);
        $manager->persist($ville);

        $this->addReference('vil-'.$this->counter_v, $ville);
        $this->counter_v++;

        return $ville;
    }

    public function getDependencies():array
    {
        return[
            DepartementFixtures::class,
        ];
    }
}
