<?php

namespace App\Controller;

use DateTime;
use App\Entity\Comment;
use App\Entity\MicroPost;
use App\Form\CommentType;
use App\Form\MicroPostType;
use App\Repository\CommentRepository;
use App\Repository\MicroPostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MicroPostController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/micro-post', name: 'app_micro_post')]
    public function index(MicroPostRepository $posts): Response
    {    
        return $this->render('micro_post/index.html.twig', [
            'posts' => $posts->findAllWithComments(),
        ]);
    }

    #[Route('/micro-post/{post}', name: 'app_micro_post_show')]
    public function showOne(MicroPost $post): Response
    {
        return $this->render('micro_post/show.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route('/micro-post/add', name: 'app_micro_post_add', priority: 2)]
    public function add(Request $request): Response
    {
        $form = $this->createForm(MicroPostType::class, new MicroPost());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $post->setCreatedAt(new DateTime());
            $this->entityManager->persist($post);
            $this->entityManager->flush();
            $this->addFlash('success', 'Your Micro-Post has been created :)(:');
            return $this->redirectToRoute('app_micro_post');
        }
        return $this->render('micro_post/add.html.twig',[
            'form' => $form
        ]);
    }
    #[Route('/micro-post/{id}/edit', name: 'app_micro_post_edit', priority: 2)]
    public function edit(MicroPost $post, Request $request): Response
    {
        $form = $this->createForm(MicroPostType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $this->entityManager->flush();
            $this->addFlash('success', 'Your Micro-Post has been updated :)(:');
            return $this->redirectToRoute('app_micro_post');
        }
        return $this->render('micro_post/edit.html.twig',[
            'form' => $form,
            'post' => $post,
        ]);
    }
    #[Route('/micro-post/{id}/comment', name: 'app_micro_post_comment')]
    public function addComment(MicroPost $post, Request $request, CommentRepository $comments): Response
    {
        $form = $this->createForm(CommentType::class, new Comment());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $comment->setPost($post);
            $this->entityManager->persist($comment);
            $this->entityManager->flush();
            $this->addFlash('success', 'Your Micro-Post has been updated :)(:');
            return $this->redirectToRoute('app_micro_post_show', ['post' => $post->getId()]);
        }
        return $this->render('micro_post/comment.html.twig',[
            'form' => $form,
            'post' => $post,
        ]);
    }
}
