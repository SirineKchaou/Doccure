<?php

namespace App\Controller;

use App\Repository\DoctorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(DoctorRepository $doctorRepository): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'doctors' => $doctorRepository->findAll(),
        ]);
    }
   /* #[Route('/redirection', name: 'app_redirection')]
    public function security(Security $security)
    {
        $user = $security->getUser();
        if(in_array('ROLE_USER', $user->getRoles())){
            return $this->redirectToRoute('app_home');
        }else{
            return $this->redirectToRoute('app_dashboard');
        }
    }*/
}
