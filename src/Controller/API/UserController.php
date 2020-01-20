<?php

namespace App\Controller\API;

use App\Entity\User;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\FOSRestBundle;

/**
 * UserController
 * @Rest\Route("/api", name="api_")
 */
class UserController extends FOSRestController
{
    /**
     * List all Users
     * @Rest\Get("/users")
     */
    public function getAllUser()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->json($users);
    }
}
