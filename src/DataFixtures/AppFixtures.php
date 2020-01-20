<?php
declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            //CREATE 10 TAGS
            $user = new User();
            $user->setFirstname('Skrrr-'.$i);
            $user->setLastname('Baang-'.$i);
            $user->setUpdatedAt( \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
            $user->setCreatedAt( \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
            $user->setStoppedAt( \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
            $user->setBirthday( \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
            $user->setEmail('Skkr'.$i.'bang@gmail.skusku');
           $user->setPassword('123');
            $manager->persist($user);
        }
        $manager->flush();
    }
}
