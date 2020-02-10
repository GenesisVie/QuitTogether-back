<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StatisticController extends AbstractController
{
    /**
     * @Route("/statistic", name="statistic")
     */
    public function index()
    {
        return $this->render('statistiques/index.html.twig', [
            'controller_name' => 'StatisticController',
        ]);
    }
}
