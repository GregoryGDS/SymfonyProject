<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VideoGameController extends AbstractController
{
    /**
     * @Route("/video/game", name="video_game")
     */
    public function index()
    {
        return $this->render('video_game/index.html.twig', [
            'controller_name' => 'VideoGameController',
        ]);
    }
}
