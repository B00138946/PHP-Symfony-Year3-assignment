<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        $template = 'default/index.html.twig';
        $args = [];
        return $this->render($template, $args);
    }

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        $template = 'default/contact.html.twig';
        $args = [];
        return $this->render($template, $args);
    }

}
