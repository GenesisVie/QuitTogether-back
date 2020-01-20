<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FaitsController extends AbstractController
{
    /**
     * @Route("/faits", name="faits")
     */
    public function index()
    {
        return $this->render('faits/index.html.twig', [
            'controller_name' => 'FaitsController',
        ]);
    }
}
