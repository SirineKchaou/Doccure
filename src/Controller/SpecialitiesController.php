<?php

namespace App\Controller;

use App\Entity\Specialities;
use App\Form\SpecialitiesType;
use App\Repository\SpecialitiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/specialities')]
class SpecialitiesController extends AbstractController
{
    #[Route('/', name: 'app_specialities_index', methods: ['GET'])]
    public function index(SpecialitiesRepository $specialitiesRepository): Response
    {
        return $this->render('specialities/index.html.twig', [
            'specialities' => $specialitiesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_specialities_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SpecialitiesRepository $specialitiesRepository): Response
    {
        $speciality = new Specialities();
        $form = $this->createForm(SpecialitiesType::class, $speciality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $specialitiesRepository->save($speciality, true);

            return $this->redirectToRoute('app_specialities_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('specialities/new.html.twig', [
            'speciality' => $speciality,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_specialities_show', methods: ['GET'])]
    public function show(Specialities $speciality): Response
    {
        return $this->render('specialities/show.html.twig', [
            'speciality' => $speciality,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_specialities_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Specialities $speciality, SpecialitiesRepository $specialitiesRepository): Response
    {
        $form = $this->createForm(SpecialitiesType::class, $speciality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $specialitiesRepository->save($speciality, true);

            return $this->redirectToRoute('app_specialities_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('specialities/edit.html.twig', [
            'speciality' => $speciality,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_specialities_delete', methods: ['POST'])]
    public function delete(Request $request, Specialities $speciality, SpecialitiesRepository $specialitiesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$speciality->getId(), $request->request->get('_token'))) {
            $specialitiesRepository->remove($speciality, true);
        }

        return $this->redirectToRoute('app_specialities_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/delete/{id}', name: 'app_specialities_delete_this')]
    public function deletes(Specialities $speciality, SpecialitiesRepository $specialitiesRepository): Response
    {
            $specialitiesRepository->remove($speciality, true);
        return $this->redirectToRoute('app_specialities_index', [], Response::HTTP_SEE_OTHER);
    }
}
