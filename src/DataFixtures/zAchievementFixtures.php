<?php

namespace App\DataFixtures;

use App\Entity\Achievement;
use App\Entity\AchievementUser;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class zAchievementFixtures extends Fixture
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
            $achievement = new Achievement();
            $achievement->setTitle('Achiev-' . $i);
            $achievement->setLevel($i);
            $achievement->setPoints( $i + 10);
            $achievement->setUnsmokedCigarette(10);
            $achievement->setText('SKUUU' . $i);
            $achievementUser = new AchievementUser();
            $achievementUser->setUser($user);
            $achievementUser->setAchievement($achievement);
            $manager->persist($achievement);
            $manager->persist($achievementUser);
            $i++;
        }
        $manager->flush();
    }
}
