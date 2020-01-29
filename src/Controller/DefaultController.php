<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


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
