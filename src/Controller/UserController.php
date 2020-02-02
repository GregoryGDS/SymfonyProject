<?php

namespace App\Controller;
//use = chemin des fichiers
use App\Entity\User;
//repository lien avec manager et bdd (ici table user)
//"sous manager" qui ne transmet que la table user de la bdd que lui envoie manager
use App\Repository\UserRepository;
use App\Form\UserType;
use App\Event\UserRegisteredEvent;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Doctrine\ORM\EntityManagerInterface;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class UserController extends AbstractController
{

    private $userRepository;
    private $EventDispatcher;

    public function __construct(
        UserRepository $userRepository, 
        EventDispatcherInterface $EventDispatcher)
    {
        $this->userRepository = $userRepository;
        $this->EventDispatcher = $EventDispatcher;
    }

    /**
     * @Route("/list-user", name="list-user")
     * @IsGranted("ROLE_ADMIN")
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

            $name = $user->getFirstName().' '.$user->getLastName();
            // dire à Doctrine que cet objet est nouveau
            // persist enregistre (~prepare pour php)
            $entityManager->persist($user);
            // enregistrer les nouveaux objets et object modifié en base de donnée
            // flush enregistre/insère (~execute pour php)
            $entityManager->flush();

            $this->addFlash("success", "L'utilisateur $name a été créé");
          
            $this->EventDispatcher->dispatch(new UserRegisteredEvent($user)); 

            return $this->redirectToRoute('index');       
        }
        return $this->render('user/form-createUser.html.twig', [
            'createUserForm' => $form->createView(),
        ]);
    }


    /**
     * @Route("/profile", name="profile")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function profile(
        Request $request)
    {
        return $this->render('user/userProfile.html.twig', [       
            'user' => $this->getUser(),  
        ]);          

    }


    /**
     * @Route("/updateUser", name="updateUser")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function updateUser(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Votre profil a été mis à jour.');

            return $this->redirectToRoute('profile');
        }

        return $this->render('user/updateUser.html.twig', [       
            'updateUserForm' => $form->createView(),  
        ]);  
    }

    /**
     * @Route("/deleteUser/{idUser}", name="deleteUser")
     * @IsGranted("ROLE_ADMIN") 
     */
    public function deleteUser(
        int $idUser,
        EntityManagerInterface $entityManager
        )
    {
        $user = $this->userRepository->findOneBy(array('id'=>$idUser));
        $name = $user->getFirstName().' '.$user->getLastName();
         
        $entityManager->remove($user);
        $entityManager->flush();

        $this->addFlash("success", "L'utilisateur $name a été supprimé");

        return $this->redirectToRoute('list-user');

    }


}
