<?php

namespace App\Controller\API;

use App\Entity\User;
use App\Entity\UserStat;
use App\Form\UserStatType;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * UserController
 * @Rest\Route("/api/user-stat", name="api_")
 */
class UserStatController extends AbstractFOSRestController
{
    /**
     * List all Users
     * @Rest\Get("/me")
     */
    public function getMyDetails()
    {
        $user = $this->getUser();
        return $this->json($user);
    }

    /**
     * @Rest\Post("/new-stat")
     * @param Request $request
     * @return Response
     */
    public function newStat(Request $request)
    {
        /** @var User $user */
        $user = $this->getUser();
        $userStat = new UserStat();
        $form = $this->createForm(UserStatType::class, $userStat);
        $data = json_decode($request->getcontent(), true);
        $form->submit($data);
        if ($form->issubmitted() && $form->isvalid() && $user !== null) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($userStat);
            $user->addUserStat($userStat);
            $em->persist($user);
            $em->flush();
            return $this->handleview($this->view(['status' => 'stat created'], response::HTTP_ACCEPTED));
        }
        return $this->handleview($this->view($form->geterrors()));
    }
}
