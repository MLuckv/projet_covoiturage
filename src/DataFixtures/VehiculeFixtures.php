<?php

namespace App\DataFixtures;

use App\Entity\Vehicule;
use APP\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class VehiculeFixtures extends Fixture
{
    private $counter_veh = 1;
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i <= 5; $i++) {
            $user = $this->getReference('user-' . $i);
            $this->createVehicule($user, 
                $this->generateImmatriculation(),
                $faker->randomElement(['Renault', 'Peugeot', 'Citroën']),
                $faker->randomElement(['Clio', '208', 'C3']),
                $faker->colorName(),
                $manager);
        }

        $manager->flush();
    }

    public function createVehicule(User $user, string $immat, string $mar, string $mod, string $col, ObjectManager $manager)
    {
        $vehicule = new Vehicule;
        $vehicule->setImmatriculation($immat);
        $vehicule->setMarque($mar);
        $vehicule->setModele($mod);
        $vehicule->setCouleur($col);
        $vehicule->setUser($user);

        $this->addReference('veh-'.$this->counter_veh, $vehicule);
        $this->counter_veh++;

        $manager->persist($vehicule);

        return $vehicule;
    }

    private function generateImmatriculation(): string
    {
        $faker = Faker\Factory::create('fr_FR');
        $letters = range('A', 'Z');
        $numbers = range(0, 9);

        $immatriculation = '';
        for ($i = 0; $i < 2; $i++) {
            $immatriculation .= $faker->randomElement($letters);
        }
        $immatriculation .= '-';
        for ($i = 0; $i < 3; $i++) {
            $immatriculation .= $faker->randomElement($numbers);
        }
        $immatriculation .= '-';
        for ($i = 0; $i < 2; $i++) {
            $immatriculation .= $faker->randomElement($letters);
        }

        return $immatriculation;
    }

}