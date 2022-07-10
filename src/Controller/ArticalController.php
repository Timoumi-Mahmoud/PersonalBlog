<?php

namespace App\Controller;

use App\Entity\Artical;
use App\Entity\Comment;
use App\Form\ArticalType;
use App\Repository\ArticalRepository;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/artical")
 */
class ArticalController extends AbstractController
{
    /**
     * @Route("/", name="app_artical_index", methods={"GET"})
     */
    public function index(ArticalRepository $articalRepository): Response
    {
        return $this->render('artical/index.html.twig', [
            'articals' => $articalRepository->findAll(),
        ]);
    }


    /**
     * @Route("/new", name="app_artical_new")
     */
    public function new(Request $request, ArticalRepository $repository): Response
    {
        $artical = new Artical();
        $form = $this->createForm(ArticalType::class, $artical);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //$file = $evenement->getImg();
            $file = $form->get('image')->getData();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $em = $this->getDoctrine()->getManager();
            $artical->setImage($fileName);
            $file->move(
                $this->getParameter('images_directory'),
                $fileName
            );
            $artical->setImage($fileName);
            $em->persist($artical);
            $em->flush();
            $repository->add($artical);
            $this->addFlash('success', 'Articals  ajouter avec succes!');
            return $this->redirectToRoute('app_home');
        }
        return $this->render('artical/new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}", name="app_artical_show", methods={"GET","POST"})
     */
    public function show($id, ArticalRepository $repositoryArit, Comment $comment, CommentRepository $rep): Response
    {
         $artical =new Artical();
        $artical = $repositoryArit->find($id);
        $comment=$rep->findBy(["artical"=>$id]);
//dd($comment);
        return $this->render('artical/show.html.twig',[
            'artical' => $artical,
           'comment'=>$comment,
        ]);
    }

    /**
     * @Route("/comment/{id}", name="app_comment_remove")
     */
    public function remove(Request $request, $id, CommentRepository $commentRepository): Response
    {
        $comment = new Comment();
        $em = $this->getDoctrine()->getManager();
        $comment = $commentRepository->find($id);
        $em->remove($comment);
        $em->flush();
        return $this->redirectToRoute('app_home');
    }





    /**
     * @Route("edit/{id}/edit", name="app_artical_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Artical $artical, ArticalRepository $articalRepository): Response
    {
        $form = $this->createForm(ArticalType::class, $artical);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $articalRepository->add($artical);
            return $this->redirectToRoute('app_artical_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('artical/edit.html.twig', [
            'artical' => $artical,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_artical_delete", methods={"POST"})
     */
    public function delete(Request $request, Artical $artical, ArticalRepository $articalRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$artical->getId(), $request->request->get('_token'))) {
            $articalRepository->remove($artical);
        }

        return $this->redirectToRoute('app_artical_index', [], Response::HTTP_SEE_OTHER);
    }



    /*

   public function newtwo(Request $request, ArticalRepository $repository ): Response
    {
        $artical = new Artical();
        $form = $this->createForm(ArticalType::class, $artical);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //$file = $evenement->getImg();
            $file = $form->get('image')->getData();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $em = $this->getDoctrine()->getManager();
            $evenement->setImg($fileName);
            $file->move(
                $this->getParameter('images_directory'),
                $fileName
            );
            $evenement->setImg($fileName);
            $em->persist($evenement);
            $em->flush();
            $repository->add($evenement);
            $this->addFlash('success', 'Articals  ajouter avec succes!');
            return $this->redirectToRoute('app_home');
        }
        return $this->render('artical/new.html.twig', array(
            'form' => $form->createView()
        ));
     //53 831 853
    }





   */

}
