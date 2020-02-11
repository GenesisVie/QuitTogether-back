<?php

namespace App\Controller;

use App\Entity\Motivation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MotivationController extends AbstractController
{
    /**
     * @Route("/admin/motivation", name="motivation")
     */
    public function list()
    {
        $motivations = $this->getDoctrine()->getManager()->getRepository(Motivation::class)->findAll();
        return $this->render('motivation/index.html.twig', [
            'class_name' => 'Motivation',
            'motivations'=>$motivations,
        ]);
    }
}
