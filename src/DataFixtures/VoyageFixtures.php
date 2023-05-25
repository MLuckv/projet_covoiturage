<?php

namespace App\DataFixtures;

use App\Entity\Ville;
use App\Entity\Vehicule;
use App\Entity\Voyage;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class VoyageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i <= 5; $i++) {
            $vil1 = $this->getReference('vil-'. $i);
            if($i == 5){//si non erreur car vil-6 n'existe pas 
                $vil2 = $this->getReference('vil-'. ($i-1));
            }
            else{
                $vil2 = $this->getReference('vil-'. ($i+1));
            }
            $vehicule = $this->getReference('veh-'. rand(1,5));
            $user = $this->getReference('user-' . rand(1,5));
            $this->createVoyage(
                $vil1,
                $vil2,
                $vehicule,
                $user,
                $faker->numberBetween(1, 5),
                $faker->dateTimeBetween('+1 day', '+1 week'),
                $faker->dateTimeBetween('+1 week', '+2 weeks'),
                $faker->text(100),
                $manager
            );
        }


        $manager->flush();
    }

    public function createVoyage(Ville $ville1, Ville $ville2, Vehicule $vehicule, 
        User $user, int $nb, DateTime $dep, DateTime $arr, string $desc, ObjectManager $manager)
    {
        $voyage = new Voyage();
        $voyage->setVilleDepart($ville1);
        $voyage->setVilleArrive($ville2);
        $voyage->setVehicule($vehicule);
        $voyage->setUser($user);
        $voyage->setNbPlace($nb);
        $voyage->setHeureDepart($dep);
        $voyage->setHeureArrive($arr);
        $voyage->setDescription($desc);

        $manager->persist($voyage);

        return $voyage;
    }
}
