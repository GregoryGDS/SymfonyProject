<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EditorController extends AbstractController
{
    /**
     * @Route("/editor", name="editor")
     */
    public function index()
    {
        return $this->render('editor/index.html.twig', [
            'controller_name' => 'EditorController',
        ]);
    }
}
