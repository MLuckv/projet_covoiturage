<?php

namespace App\DataFixtures;

use App\Entity\Conducteur;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class UsersFixtures extends Fixture implements DependentFixtureInterface
{
    private $counter_u = 1;
    
    public function load(ObjectManager $manager): void
    {
        
        $faker = Faker\Factory::create('fr_FR');
        for($i = 1; $i <= 5; $i++){
            $driver = $this->getReference('driv-'. $i);
            $this->createUser(
                $driver,
                $faker->email(),
                $faker->password(),
                $faker->lastName(),
                $faker->firstNameFemale(),
                $faker->phoneNumber(),
                $manager
            );
        }

        $this->createUser($this->getReference('driv-'. 6), "test@test.fr", "testtest", "test", "test", "0652578489", $manager);

        $manager->flush();
    }
    public function createUser(Conducteur $driver, string $email, string $password, string $lastname, string $firstname
        ,string $num_tel, ObjectManager $manager)
    {
        $user = new User;
        $user->setDriver($driver);
        $user->setEmail(strtolower($email));
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($password);
        $user->setLastname(strtolower($lastname));
        $user->setFirstname(utf8_encode(strtolower($firstname)));
        $user->setNumTel($num_tel);
        $manager->persist($user);

        $this->addReference('user-'.$this->counter_u, $user);
        $this->counter_u++;

        return $user;
    }

    public function getDependencies():array
    {
        return[
            ConducteurFixtures::class,
        ];
    }
}
