<?php

namespace App\Controller;


use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\AppointmentRepository;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request,ContactRepository $contactRepository): Response
    {
        $contact = new  Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contactRepository->save($contact,true);
            return $this->redirectToRoute('app_contact');

        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
    #[Route('/listc', name: 'list_contact')]
    public function listing (ContactRepository $ct){
        $contact = $ct->findAll();
        return $this->render('contact/listc.html.twig',[
            'contacts' => $contact
        ]);}
}
