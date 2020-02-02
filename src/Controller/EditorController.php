<?php

namespace App\Controller;


use App\Entity\Editor;
use App\Form\EditorType;
use App\Repository\EditorRepository;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class EditorController extends AbstractController
{

    private $EditorRepository;

    public function __construct(EditorRepository $EditorRepository){
        $this->EditorRepository = $EditorRepository;
    }

    /**
     * @Route("/list-editor", name="list-editor")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function index()
    {
        $editorList = $this->EditorRepository->findAll();
        return $this->render('editor/editorList.html.twig', [
        'editorList' => $editorList,
        ]);
    }

    /**
     * @Route("/create-editor", name="create-editor")
     * @IsGranted("ROLE_ADMIN")
     */
    public function createEditor(
        Request $request,
        EntityManagerInterface $entityManager
        )
    {
        $Editor = new Editor();

        $form = $this->createForm(EditorType::class, $Editor);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            // persist enregistre (~prepare pour php)
            $entityManager->persist($Editor);

            // flush enregistre/insère (~execute pour php)
            $entityManager->flush();

            return $this->redirectToRoute('list-editor');

        }
        return $this->render('editor/form-createEditor.html.twig', [
            'createEditorForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/detail-editor/{idEditor}", name="detail-editor")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function detailEditor(int $idEditor){

        $oneEditor = $this->EditorRepository->findOneBy(array('id'=>$idEditor));
        return $this->render('editor/oneEditor.html.twig', [
            'oneEditor' => $oneEditor,
        ]);
    }

    /**
     * @Route("/updateEditor/{idEditor}", name="updateEditor")
     * @IsGranted("ROLE_ADMIN") 
     */
    public function updateEditor(
        Request $request,
        EntityManagerInterface $entityManager,
        int $idEditor
        )
    {
        $editor = $this->EditorRepository->findOneBy(array('id'=>$idEditor));
        $form = $this->createForm(EditorType::class, $editor);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($editor);
            $entityManager->flush();
            $this->addFlash('success', 'L\'éditeur a été mis à jour.');

            return $this->redirectToRoute('detail-editor',array('idEditor'=>$editor->getId()));
        }

        return $this->render('editor/updateEditor.html.twig', [       
            'updateEditorForm' => $form->createView(),  
        ]);  
    }


    /**
     * @Route("/deleteEditor/{idEditor}", name="deleteEditor")
     * @IsGranted("ROLE_ADMIN") 
     */
    public function deleteEditor(
        int $idEditor,
        EntityManagerInterface $entityManager
        )
    {
        $editor = $this->EditorRepository->findOneBy(array('id'=>$idEditor));
        $company = $editor->getCompanyName();

        foreach($editor->getVideoGames() as $jeu) {
            $editor->removeVideoGame($jeu);
        }

        $entityManager->remove($editor);
        $entityManager->flush();

        $this->addFlash("success", "L'éditeur $company a été supprimé");

        return $this->redirectToRoute('list-editor');

    }

}
