<?php

namespace App\Controller;

use App\Entity\Doctor;
use App\Form\DoctorType;
use App\Repository\DoctorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/doctor')]
class DoctorController extends AbstractController
{
    #[Route('/', name: 'app_doctor_index', methods: ['GET'])]
    public function index(DoctorRepository $doctorRepository): Response
    {
        return $this->render('doctor/index.html.twig', [
            'doctors' => $doctorRepository->findAll(),
        ]);
    }


    #[Route('/new', name: 'app_doctor_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DoctorRepository $doctorRepository, SluggerInterface $slugger): Response
    {
        $doctor = new Doctor();
        $form = $this->createForm(DoctorType::class, $doctor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $doctorRepository->save($doctor, true);
            $photo = $form->get('photo')->getData();
            if($photo){
                $originalFilename = pathinfo($photo->getClientOriginalName(),PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'-'.$photo->guessExtension();
                try {
                    $photo->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                }catch (FileException $e){

                }
                $doctor->setPhoto($newFilename);
                $doctorRepository->add($doctor, true);
            }


            return $this->redirectToRoute('app_doctor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('doctor/new.html.twig', [
            'doctor' => $doctor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_doctor_show', methods: ['GET'])]
    public function show(Doctor $doctor): Response
    {
        return $this->render('doctor/show.html.twig', [
            'doctor' => $doctor,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_doctor_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Doctor $doctor, DoctorRepository $doctorRepository): Response
    {
        $form = $this->createForm(DoctorType::class, $doctor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $doctorRepository->save($doctor, true);

            return $this->redirectToRoute('app_doctor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('doctor/edit.html.twig', [
            'doctor' => $doctor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_doctor_delete', methods: ['POST'])]
    public function delete(Request $request, Doctor $doctor, DoctorRepository $doctorRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$doctor->getId(), $request->request->get('_token'))) {
            $doctorRepository->remove($doctor, true);
        }

        return $this->redirectToRoute('app_doctor_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/delete/{id}', name: 'app_doctor_delete_this')]
    public function deleted(Doctor $doctor, DoctorRepository $doctorRepository): Response
    {
            $doctorRepository->remove($doctor, true);
        return $this->redirectToRoute('app_doctor_index', [], Response::HTTP_SEE_OTHER);
    }

}
