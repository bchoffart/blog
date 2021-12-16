<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreatePostController extends AbstractController
{
    #[Route('/create/post', name: 'create_post')]
    public function index(): Response
    {
        return $this->render('pages/create_post.html.twig', [
            'controller_name' => 'CreatePostController',
        ]);
    }
}
