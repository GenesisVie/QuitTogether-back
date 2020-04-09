<?php

namespace App\Controller;

use App\Entity\UserStat;
use App\Form\UserStatType;
use App\Repository\UserStatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user/stat")
 */
class UserStatController extends AbstractController
{
    /**
     * @Route("/", name="user_stat_index", methods={"GET"})
     */
    public function index(UserStatRepository $userStatRepository): Response
    {
        return $this->render('user_stat/index.html.twig', [
            'user_stats' => $userStatRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_stat_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $userStat = new UserStat();
        $form = $this->createForm(UserStatType::class, $userStat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userStat);
            $entityManager->flush();

            return $this->redirectToRoute('user_stat_index');
        }

        return $this->render('user_stat/new.html.twig', [
            'user_stat' => $userStat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_stat_show", methods={"GET"})
     */
    public function show(UserStat $userStat): Response
    {
        return $this->render('user_stat/show.html.twig', [
            'user_stat' => $userStat,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_stat_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UserStat $userStat): Response
    {
        $form = $this->createForm(UserStatType::class, $userStat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_stat_index');
        }

        return $this->render('user_stat/edit.html.twig', [
            'user_stat' => $userStat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_stat_delete", methods={"DELETE"})
     */
    public function delete(Request $request, UserStat $userStat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userStat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userStat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_stat_index');
    }
}
