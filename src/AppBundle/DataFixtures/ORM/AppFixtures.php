<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\PhoneBook;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures implements ORMFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $newEntry = new PhoneBook();
        $newEntry->setName('PavelBuchyn');
        $newEntry->setPhone('+380958674199');

        $manager->persist($newEntry);

        $newEntry = new PhoneBook();
        $newEntry->setName('JohnDoe');
        $newEntry->setPhone('+380670000000');

        $manager->persist($newEntry);

        $newEntry = new PhoneBook();
        $newEntry->setName('StevenSeagal');
        $newEntry->setPhone('+100670000000');

        $manager->persist($newEntry);

        $manager->flush();
    }
}