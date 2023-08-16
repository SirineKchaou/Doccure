<?php

namespace App\Controller;

use App\Repository\DoctorRepository;
use App\Repository\SpecialitiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile',methods: ['GET'])]
    public function index(DoctorRepository $doctorRepository, SpecialitiesRepository $specialitiesRepository): Response
    {
        return $this->render('profile/index.html.twig', [
            'doctors' => $doctorRepository->findAll(),
            'specialities' => $specialitiesRepository->findAll(),
        ]);
    }

}
