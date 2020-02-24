<?php

namespace App\Controller\API;

use App\Entity\Blog;
use App\Entity\Cigarette;
use App\Entity\User;
use App\Form\CigaretteType;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * UserController
 * @Rest\Route("/api/cigarette", name="api_")
 */
class CigaretteController extends AbstractFOSRestController
{
    /**
     * List all of my cigarettes
     * @Rest\Get("/me/all")
     */
    public function getAllMyCigarettes()
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        /** @var User $user */
        $user = $this->getUser();
        $cigarettes = $this->getDoctrine()->getRepository(Cigarette::class)->findBy(['user' => $user]);
        $jsonObject = $serializer->serialize($cigarettes, 'json', [
            'circular_reference_handler' => function($object) {
                return $object;
            }
        ]);
        return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
    }

    /**
     * Post my cigarette
     * @Rest\Post("/me/new")
     * @param Request $request
     * @return Response
     */
    public function postMyCigarette(Request $request)
    {
        $cigarette = new Cigarette();
        $form = $this->createform(CigaretteType::class, $cigarette);
        $data = json_decode($request->getcontent(), true);
        $form->submit($data);
        if ($form->issubmitted() && $form->isvalid()) {
            $em = $this->getDoctrine()->getManager();
            /** @var User $user */
            $user = $this->getUser();
            $cigarette->setUser($user);
            $em->persist($cigarette);
            $em->flush();
            return $this->handleview($this->view(['status' => 'cigarette created and linked'], response::HTTP_CREATED));
        }
        return $this->handleview($this->view($form->geterrors()));
    }
}
