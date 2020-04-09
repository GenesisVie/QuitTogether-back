<?php

namespace App\Controller\API;

use App\Entity\User;
use App\Form\FriendType;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * FriendController
 * @Rest\Route("/api/friend", name="api_friend")
 */
class FriendController extends AbstractFOSRestController
{
    /**
     * Add friend
     * @Rest\Post("/add")
     */
    public function addFriend(Request $request)
    {
        /** @var User $user */
        $user = $this->getUser();
        $form = $this->createform(FriendType::class);
        $data = json_decode($request->getcontent(), true);
        $form->submit($data);
        if ($form->issubmitted() && $form->isvalid()) {
            $em = $this->getDoctrine()->getManager();
            /** @var User $user */
            $newFriend = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $data['email']]);
            if ($newFriend !== null ) {
                $em->persist($user);
                $em->persist($user);
                $em->flush();
                return $this->handleview($this->view(['status' => 'friend added'], response::HTTP_CREATED));
            }else{
                return $this->handleView($this->view(['status' => 'not found'], response::HTTP_NOT_MODIFIED));
            }
        }
        return $this->handleview($this->view($form->geterrors()));
    }

    /**
     * Get all friends
     * @Rest\Get("/all")
     */
    public function getMyFriends()
    {
        /** @var User $user */
        $user = $this->getUser();
        $friends = [];
        $friendsDB = $user->getFriend();
        $i = 0;
        /** @var User $value */
        foreach ($friendsDB->getValues() as $value) {
            $friends[] = [
                'firstname' => $value->getFirstname(),
                'lastname' => $value->getLastname(),
                'averagePerDay' => $value->getAveragePerDay(),
                'image' => $value->getImage(),
            ];
        }

        if ($friends === null) {
            return new Response('{}', 500, ['Content-Type' => 'application/json']);
        }

        return $this->handleView($this->view($friends));
    }

    /**
     * Get my friendStat
     * @Rest\Get("/all/user-stat")
     */
    public function getMyFriendsStats()
    {
        /** @var User $user */
        $user = $this->getUser();
        $friends = [];
        $friendsDB = $user->getFriend();
        $i = 0;
        $friendStats = [];
        if ($friendsDB !== null) {
            /** @var User $value */
            foreach ($friendsDB->getValues() as $value) {
                if ($value->getUserStats() !== null) {
                    $friendStat = $value->getUserStats()->getValues()[array_key_last($value->getUserStats()->getValues())];
                    $friendStats[] = [
                        'id' => $friendStat->getId(),
                        'firstname' => $value->getFirstname(),
                        'lastname' => $value->getLastname(),
                        'title' => $friendStat->getTitle(),
                        'date' => $friendStat->getDate(),
                        'moneyEco' => $friendStat->getMoneyEconomised(),
                        'cigarettes' => $friendStat->getCigarettesSaved(),
                        'lifetime' => $friendStat->getLifetimeSaved(),
                    ];
                }
            }
        }

        if ($friendStats === null) {
            return new Response('{}', 500, ['Content-Type' => 'application/json']);
        }

        return $this->handleView($this->view($friendStats));
    }
}
