<?php

namespace App\Controller;

use App\Entity\Place;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class DefaultController extends AbstractController
{
    /**

     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
        ]);
    }
}
