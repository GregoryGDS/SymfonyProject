<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Editor;

use App\Repository\EditorRepository;
use App\Form\EditorType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;



class EditorController extends AbstractController
{

    private $EditorRepository;

    public function __construct(EditorRepository $EditorRepository){
        $this->EditorRepository = $EditorRepository;
    }

    /**
     * @Route("/editor", name="editor")
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
}
