<?php

namespace App\Controller;
//use = chemin des fichiers
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

//repository lien avec manager et bdd (ici table user)
//"sous manager" qui ne transmet que la table user de la bdd que lui envoie manager
use App\Repository\UserRepository;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{

    private $userRepository;

    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/user-list", name="user-list")
     */
    public function index()
    {
       $userList = $this->userRepository->findAll();
        // Send to the View template 'user/index.html.twig' an array of content
        return $this->render('user/userList.html.twig', [
        'userList' => $userList,

        ]);
    }

    /**
     * @Route("/create-user", name="create-user")
     */
    public function createUser(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // objet User rempli avec les infos du formulaire
            
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            $createdDate = date('Y-m-d H:i:s');
            $user->setCreatedDate(new \DateTime($createdDate));

            // dire à Doctrine que cet objet est nouveau
            // persist enregistre (~prepare pour php)
            $entityManager->persist($user);
            // enregistrer les nouveaux objets et object modifié en base de donnée
            // flush enregistre/insère (~execute pour php)
            $entityManager->flush();

            return $this->redirectToRoute('user-list');

        }
        return $this->render('user/form-createUser.twig', [
            'createUserForm' => $form->createView(),
        ]);
    }

}
