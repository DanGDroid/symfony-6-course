<?php

namespace App\DataFixtures;

use App\Entity\MicroPost;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $microPost1 = new MicroPost();
        $microPost1->setTitle('Welcome to the Jungle');
        $microPost1->setText('This is the jungle inner text');
        $microPost1->setCreatedAt(new DateTime());
        $manager->persist($microPost1);

        $microPost2 = new MicroPost();
        $microPost2->setTitle('Welcome to the Holyland');
        $microPost2->setText('This is the Holyland inner text');
        $microPost2->setCreatedAt(new DateTime());
        $manager->persist($microPost2);

        $microPost3 = new MicroPost();
        $microPost3->setTitle('Welcome to the Paradize');
        $microPost3->setText('This is the Paradize inner text');
        $microPost3->setCreatedAt(new DateTime());
        $manager->persist($microPost3);

        

        $manager->flush();
    }
}
