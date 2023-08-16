<?php

namespace App\Controller;

use App\Entity\Appointment;
use App\Form\AppointmentType;
use App\Repository\AppointmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppointmentController extends AbstractController
{
    #[Route('/appointment', name: 'app_appointment')]
    public function index(Request $request,AppointmentRepository $appointmentRepository): Response
    {
        $appointment = new  Appointment();
        $form = $this->createForm(AppointmentType::class, $appointment);
        $form->handleRequest($request);
        $appointment->setDate(new \DateTime('Tomorrow'));
        if ($form->isSubmitted() && $form->isValid()) {
            $appointmentRepository->save($appointment,true);
            return $this->redirectToRoute('app_appointment');

            }
        return $this->render('appointment/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
        #[Route('/list', name: 'list_appointment')]
           public function listing (AppointmentRepository $app){
            $appointment = $app->findAll();
        return $this->render('appointment/list.html.twig',[
            'appointments' => $appointment
        ]);}

}
