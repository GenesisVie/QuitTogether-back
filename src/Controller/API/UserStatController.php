<?php

namespace App\Controller\API;

use App\Entity\Statistic;
use App\Entity\User;
use App\Entity\UserStat;
use App\Form\StatisticType;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

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
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        /** @var User $user */
        $user = $this->getUser();
        $userStats = [];
        foreach ($user->getUserStats() as $userStat) {
            $userStats[] = [
                'id' => $userStat->getId(),
                'date' => $userStat->getDate(),
                'moneyEco' => $userStat->getMoneyEconomised(),
                'cigarettes' => $userStat->getCigarettesSaved(),
                'lifetime' => $userStat->getLifetimeSaved(),
            ];
        }

        if ($userStats === null) {
            return new Response('{}', 500, ['Content-Type' => 'application/json']);
        }

        return $this->handleView($this->view($userStats));
    }

    /**
     * @Rest\Post("/new-stat-user")
     * @param Request $request
     * @return Response
     */
    public function newStat(Request $request)
    {
        /** @var User $user */
        $user = $this->getUser();
        $userStat = new UserStat();
        $form = $this->createForm(StatisticType::class, $userStat);
        $data = json_decode($request->getcontent(), true);
        $form->submit($data);
        if ($form->issubmitted() && $form->isvalid() && $user !== null) {
            $em = $this->getDoctrine()->getManager();
            $userStat->setUser($user);
            $em->persist($user);
            $em->persist($userStat);
            $em->flush();

            return $this->handleview($this->view(['status' => 'stat created'], response::HTTP_ACCEPTED));
        }
        return $this->handleview($this->view($form->geterrors()));
    }
}
