<?php

namespace App\Controller;

use App\Entity\Artical;
use App\Entity\Comment;
use App\Entity\User;
use App\Form\CommentType;
use App\Repository\ArticalRepository;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/comment")
 */
class CommentController extends AbstractController
{
    /**
     * @Route("/", name="app_comment_index", methods={"GET"})
     */
    public function index(CommentRepository $commentRepository): Response
    {
        return $this->render('comment/index.html.twig', [
            'comments' => $commentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_comment_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CommentRepository $commentRepository , ArticalRepository $articalRepository): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
$user=new User();

        $user = $this->getUser();
        $aritcal =new Artical();
        $em = $this->getDoctrine()->getManager();

        $aritcal = $articalRepository->find("1");


  //  dd($aritcal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          $comment->setUser($user);
          $comment->setArtical($aritcal);


        //$comment->setUser($user);
           $em = $this->getDoctrine()->getManager();
            $commentRepository->add($comment);
            //$em->merge($comment);
            $em->persist($comment);
            //dd($comment);

            $em->flush();
           // return $this->redirectToRoute('app_comment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('comment/new.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_comment_show", methods={"GET"})
     */
    public function show(Comment $comment): Response
    {
        return $this->render('comment/show.html.twig', [
            'comment' => $comment,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_comment_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Comment $comment, CommentRepository $commentRepository): Response
    {
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentRepository->add($comment);
            return $this->redirectToRoute('app_comment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('comment/edit.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_comment_delete", methods={"POST"})
     */
    public function delete(Request $request, Comment $comment, CommentRepository $commentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comment->getId(), $request->request->get('_token'))) {
            $commentRepository->remove($comment);
        }

        return $this->redirectToRoute('app_comment_index', [], Response::HTTP_SEE_OTHER);
    }
}
