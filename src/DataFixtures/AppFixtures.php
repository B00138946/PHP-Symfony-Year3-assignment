<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Factory\UserFactory;
use App\Factory\PhoneFactory;
use App\Factory\MakeFactory;

use App\Factory\CampusFactory;
use App\Factory\StudentFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne([
            'username' => 'matt',
            'password' => 'smith',
            'role' => 'ROLE_ADMIN'
        ]);

        UserFactory::createOne([
            'username' => 'john',
            'password' => 'doe',
            'role' => 'ROLE_ADMIN'
        ]);


        MakeFactory::createOne(['name' => 'Apple']);
        MakeFactory::createOne(['name' => 'Samsung']);
        MakeFactory::createOne(['name' => 'Sony']);

        PhoneFactory::createOne([
            'model' => 'iPhone X',
            'memory' => '128',
            'manufacturer' => MakeFactory::find(['name' => 'Apple']),
        ]);

        PhoneFactory::createOne([
            'model' => 'Galaxy 21',
            'memory' => '256',
            'manufacturer' => MakeFactory::find(['name' => 'Samsung']),
        ]);

        $blanchCampus = CampusFactory::createOne(['location' => 'Blanchardstown']);
        $tallaghtCampus = CampusFactory::createOne(['location' => 'Tallaght']);
        $cityCampus = CampusFactory::createOne(['location' => 'City']);

        StudentFactory::createOne([
            'age' => 21,
            'name' => 'Matt Smith',
            'campus' => $blanchCampus
        ]);

        StudentFactory::createOne([
            'age' => 96,
            'name' => 'Granny Smith',
            'campus' => $blanchCampus
        ]);

        // illustrate a "find" for property value to link to another object ...
        StudentFactory::createOne([
            'age' => 19,
            'name' => 'Sinead Mullen',
            'campus' => CampusFactory::find(['location' => 'Tallaght']),
        ]);
    }
}
