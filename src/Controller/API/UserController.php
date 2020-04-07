<?php

namespace App\Controller\API;

use App\Entity\User;
use App\Form\ChangePasswordType;
use App\Form\UserType;
use App\Form\UserUpdateType;
use Doctrine\Persistence\ObjectManager;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * UserController
 * @Rest\Route("/", name="api_")
 */
class UserController extends AbstractFOSRestController
{
    /**
     * List all Users
     * @Rest\Get("api/user/all")
     * @IsGranted("ROLE_ADMIN")
     */
    public function getAllUser()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->json($users);
    }

    /**
     * List all Users
     * @Rest\Get("api/user//id/{id}")
     * @IsGranted("ROLE_ADMIN")
     */
    public function getUserById($id)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['id' => $id]);

        $jsonObject = $serializer->serialize($user, 'json', [
            'circular_reference_handler' => function($object) {
                return $object;
            }
        ]);
        return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
    }

    /**
     * List all Users
     * @Rest\Get("api/user/me")
     */
    public function getMyDetails()
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        /** @var User $user */
        $user = $this->getUser();
        $userData = [
            'stoppedAt' => $user->getStoppedAt(),
            'packageCost' => $user->getPackageCost(),
            'firstname'=>$user->getFirstname(),
            'lastname'=>$user->getLastname(),
            'image'=>$user->getImage(),
        ];
        $jsonObject = $serializer->serialize($userData, 'json', [
            'circular_reference_handler' => function($object) {
                return $object;
            }
        ]);
        return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Rest\Post("user/change-password")
     * @param Request $request
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     * @return Response
     */
    public function changePassword(Request $request, UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $user = $this->getUser();
        $form = $this->createform(ChangePasswordType::class);
        $data = json_decode($request->getcontent(), true);
        $form->submit($data);
        if ($form->issubmitted() && $form->isvalid() && $user !== null) {
            $em = $this->getDoctrine()->getManager();
            $user->setPassword($userPasswordEncoder->encodePassword(
                $user, $data['password']
            ));
            $em->persist($user);
            $em->flush();
            return $this->handleview($this->view(['status' => 'password changed'], response::HTTP_ACCEPTED));
        }
        return $this->handleview($this->view($form->geterrors()));
    }

    /**
     * @Rest\Post("user/register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     * @return Response
     */
    public function postUser(Request $request, UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $user = new User();
        $form = $this->createform(UserType::class, $user);
        $data = json_decode($request->getcontent(), true);
        $form->submit($data);
        if ($form->issubmitted() && $form->isvalid()) {
            $em = $this->getDoctrine()->getManager();
            $user->setPassword($userPasswordEncoder->encodePassword(
                $user, $data['password']
            ));
            $em->persist($user);
            $em->flush();
            return $this->handleview($this->view(['status' => 'User created'], response::HTTP_CREATED));
        }
        return $this->handleview($this->view($form->geterrors()));
    }


    /**
     * @Rest\Post("api/user/update")
     * @param Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createform(UserUpdateType::class, $user);
        $data = json_decode($request->getcontent(), true);
        $form->submit($data);
        if ($form->issubmitted() && $form->isvalid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->handleview($this->view(['status' => 'User updated'], response::HTTP_CREATED));
        }
        return $this->handleview($this->view($form->geterrors()));
    }
}
