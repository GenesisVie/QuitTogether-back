<?php

namespace App\DataFixtures;

use App\Entity\Achievement;
use App\Entity\AchievementUser;
use App\Entity\Friend;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class zFriendFixtures extends Fixture
{
    private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

    public function load(ObjectManager $manager)
    {
        $users = $manager->getRepository(User::class)->findAll();
        $i = 0;
        /** @var User $user */
        foreach ($users as $user) {
            $friend = new Friend();
            $friend->setUser($user);
            $friend->setDisplaying(true);
            $friends= $manager->getRepository(User::class)->findAll();
            foreach ($friends as $item) {
                $friend->setFriend($item);
                $manager->persist($friend);
            }
            $manager->persist($friend);
            $i++;
        }
        $manager->flush();
    }
}
