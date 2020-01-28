<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use App\Entity\VideoGame;
use App\Form\VideoGameType;
use App\Repository\VideoGameRepository;

use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;



use Sensio\Bundle\FrameworkExtraBundle\Conﬁguration\IsGranted;

class VideoGameController extends AbstractController
{
    private $videoGameRepository;

    public function __construct(VideoGameRepository $videoGameRepository){
        $this->videoGameRepository = $videoGameRepository;
    }

    /**
     * @Route("/list-videogame", name="list-videogame")
     */
    public function index()
    {
       $videogameList = $this->videoGameRepository->findAll();
        // Send to the View template 'video_game/index.html.twig' an array of content
        return $this->render('video_game/videoGameList.html.twig', [
        'videogameList' => $videogameList,
        ]);
    }

    /**
     * @Route("/create-videogame", name="create-videogame")
     */
    public function createVideoGame(
        Request $request,
        EntityManagerInterface $entityManager
        )
    {
        $videoGame = new VideoGame();

        $form = $this->createForm(VideoGameType::class, $videoGame);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // persist enregistre (~prepare pour php)
            $entityManager->persist($videoGame);

            // flush enregistre/insère (~execute pour php)
            $entityManager->flush();

            return $this->redirectToRoute('list-videogame');

        }
        return $this->render('video_game/form-createVideoGame.html.twig', [
            'createVideoGameForm' => $form->createView(),
        ]);
    }

}
