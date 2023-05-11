<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Factory\UserFactory;
use App\Factory\ProductDetailsFactory;
use App\Factory\ProductFactory;

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
            'username' => 'Disi44',
            'password' => 'disidisi',
            'role' => 'ROLE_ADMIN'
        ]);


        ProductFactory::createOne(['name' => 'Puma Hoodie']);
        ProductFactory::createOne(['name' => 'Nike Tech Fleece']);
        ProductFactory::createOne(['name' => 'Nike Jordans']);

        ProductDetailsFactory::createOne([
            'Brand' => 'Puma',
            'Price' => '50',
            'Clothing_name' => ProductFactory::find(['name' => 'Puma Hoodie']),
        ]);

        ProductDetailsFactory::createOne([
            'Brand' => 'Nike',
            'Price' => '90',
            'Clothing_name' => ProductFactory::find(['name' => 'Nike Tech Fleece']),
        ]);


    }
}
