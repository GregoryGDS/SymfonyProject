<?php

namespace App\Controller;

use App\Form\ProfileType;
use App\Form\UserType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('home/index.html.twig');
    }

}
