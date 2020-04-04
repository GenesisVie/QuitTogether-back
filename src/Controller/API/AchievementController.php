<?php

namespace App\Controller\API;

use App\Entity\Achievement;
use App\Entity\AchievementUser;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * UserController
 * @Rest\Route("/api/achievement", name="api_")
 */
class AchievementController extends AbstractFOSRestController
{
    /**
     * List all achievements
     * @Rest\Get("/all")
     * @IsGranted("ROLE_ADMIN")
     */
    public function getAllAchievement()
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $achievement = $this->getDoctrine()->getRepository(Achievement::class)->findAll();
        $jsonObject = $serializer->serialize($achievement, 'json', [
            'circular_reference_handler' => function($object) {
                return $object;
            }
        ]);
        return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
    }

    /**
     * Get achievements by UserID
     * @Rest\Get("/user")
     */
    public function getAchievementById()
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $user = $this->getUser();
        $achievementUser = $this->getDoctrine()->getRepository(AchievementUser::class)->findAchievementUserByUserId($user->getId());
        $achievement = $this->getDoctrine()->getRepository(Achievement::class)->findAchievementByAchievementUser($achievementUser);
        if ($achievement === null || $user === null || $achievementUser === null) {
            return new Response('{}', 500, ['Content-Type' => 'application/json']);
        }
        $jsonObject = $serializer->serialize($achievement, 'json', [
            'circular_reference_handler' => function($object) {
                return $object;
            }
        ]);
        return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
    }
}
