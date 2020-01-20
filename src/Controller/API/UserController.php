<?php

namespace App\Controller\API;

use App\Entity\User;
use App\Form\UserType;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * UserController
 * @Rest\Route("/api/users", name="api_")
 */
class UserController extends AbstractFOSRestController
{
    /**
     * List all Users
     * @Rest\Get("/all")
     */
    public function getAllUser()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->json($users);
    }


    /**
     * @Rest\Post("/post")
     * @param Request $request
     * @return Response
     */
    public function postUser(Request $request)
    {
        $user = new user();
        $form = $this->createform(usertype::class, $user);
        $data = json_decode($request->getcontent(), true);
        $form->submit($data);
        if ($form->issubmitted() && $form->isvalid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->handleview($this->view(['status' => 'ok'], response::HTTP_CREATED));
        }
        return $this->handleview($this->view($form->geterrors()));
    }

//    /**
//     * create user
//     * @Rest\Post("/user")
//     * @param Request $request
//     * @return Response
//     */
//    public function postUser(Request $request)
//    {
//        $user = new user();
//        $form = $this->createform(usertype::class, $user);
//        $data = json_decode($request->getcontent(), true);
//        $form->submit($data);
//        if ($form->issubmitted() && $form->isvalid()) {
//            $em = $this->getdoctrine()->getmanager();
//            $em->persist($user);
//            $em->flush();
//            return $this->handleview($this->view(['status' => 'ok'], response::http_created));
//        }
//        return $this->handleview($this->view($form->geterrors()));
//    }
}
