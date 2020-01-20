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
         $user = new User();

        for ($i = 0; $i < 10; $i++) {
            $user->setFirstname('Skrrr-' . $i);
            $user->setLastname('Baang-' . $i);
            $user->setUpdatedAt(\DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
            $user->setCreatedAt(\DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
            $user->setStoppedAt(\DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
            $user->setBirthday(\DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
            $user->setEmail('Skkr' . $i . 'bang@gmail.skusku');
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user, '123'
            ));
            $user->setRoles(['ROLE_ADMIN']);
            $manager->persist($user);
        }
        $manager->flush();
    }
}
