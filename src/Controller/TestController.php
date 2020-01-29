<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class TestController extends AbstractController
{
    /**

     * @Route("/test", name="test")
     */
    public function index()
    {
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy([]);
//        dump()
    }
}
