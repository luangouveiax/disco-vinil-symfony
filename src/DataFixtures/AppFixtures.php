<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\DiscoVinil;
use App\Factory\DiscoVinilFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        DiscoVinilFactory::createMany(25);
    }
}
