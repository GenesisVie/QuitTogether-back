<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setFirstname('Jean ' . $i);
            $user->setLastname('Test ');
            $user->setUpdatedAt(new \DateTime('now'));
            $user->setCreatedAt(new \DateTime('now'));
            $user->setStoppedAt(new \DateTime('now'));
            $user->setBirthday(new \DateTime('now'));
            $user->setEmail('test' . $i . '@gmail.com');
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user, 'test'
            ));
            $user->setAveragePerDay(5);
            $user->setPackageCost(10);
            $user->setRoles(['ROLE_ADMIN']);
            $user->setImage('user.png');
            $manager->persist($user);
        }

        $manager->flush();
    }
}
