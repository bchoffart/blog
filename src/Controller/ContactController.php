<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Contact;
use App\Form\ContactFormType;
use App\Repository\ContactRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{

    /**
     * @var ContactRepository
     */
    private $contactRepository;

    public function __construct(ContactRepository $contactRepository) {
        $this->contactRepository = $contactRepository;
    }

    #[Route('/contact', name: 'contact')]
    public function contact(Request $request): Response
    {
        $name = $request->query->get('name');
        $contact = new Contact();

        $form = $this->createForm(ContactFormType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($form->getData());
            $entityManager->flush();
        }

        return $this->render('pages/contact.html.twig', [
            'name' => $name,
            'contacts' => $this->contactRepository->findAll(),
            'form' => $form->createView()
        ]);
    }

    #[Route('/contact/{id}', name: 'contactId')]
    public function contactId(Request $request, int $id): Response
    {
        return $this->render('pages/contact.html.twig', [
            'contact' => $this->contactRepository->find($id)
        ]);
    }

    #[Route('/contact/{city}', name: 'contactCity')]
    public function cities(Request $request, string $city): Response
    {
        $name = $request->query->get('name');

        return $this->render('pages/contact.html.twig', [
            'controller_name' => 'Contact',
            'city' => $city,
            'name' => $name
        ]);
    }
}
