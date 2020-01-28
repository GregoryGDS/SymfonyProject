<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Sensio\Bundle\FrameworkExtraBundle\Conﬁguration\IsGranted;

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
