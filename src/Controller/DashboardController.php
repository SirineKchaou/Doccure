<?php

namespace App\Controller;

use App\Repository\AppointmentRepository;
use App\Repository\DoctorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(DoctorRepository $doctorRepository, AppointmentRepository $appointmentRepository): Response
    {

        $doctors = $doctorRepository->findAll();
        $nombreDocteurs = 0; 

        foreach ($doctors as $doctor) {
            $doctorId = $doctor->getId();
            if ($doctorId !== null) {
                $nombreDocteurs++;
            }
        }

        $appointments = $appointmentRepository->findAll();
        $nombreAppointments = 0;

        foreach ($appointments as $appointment) {
            $appointmentId = $appointment->getId();
            if ($appointmentId !== null) {
                $nombreAppointments++;
            }
        }


        return $this->render('dashboard/index.html.twig', [
            'doctors' => $doctorRepository->findAll(),
            'somme' => $nombreDocteurs,
            'totale' => $nombreAppointments,

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
