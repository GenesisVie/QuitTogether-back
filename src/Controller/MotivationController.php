<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MotivationController extends AbstractController
{
    /**
     * @Route("/admin/motivation", name="motivation")
     */
    public function index()
    {
        return $this->render('motivation/index.html.twig', [
            'controller_name' => 'MotivationController',
        ]);
    }
}
