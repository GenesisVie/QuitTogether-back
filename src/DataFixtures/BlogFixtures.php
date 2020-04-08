<?php

namespace App\DataFixtures;

use App\Entity\Blog;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class BlogFixtures extends Fixture
{
    private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $blog = new Blog();
            $blog->setTitle('BLOG-' . $i);
            $blog->setDescription('BLOG Desc-'.$i);
            $blog->setUpdatedAt( new \DateTime('now'));
            $blog->setImage('friend.png');
            $manager->persist($blog);
        }

        $manager->flush();
    }
}
