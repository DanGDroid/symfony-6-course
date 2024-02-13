<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\MicroPost;
use App\Entity\User;
use App\Entity\UserProfile;
use App\Repository\MicroPostRepository;
use App\Repository\UserProfileRepository;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class HelloController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    private array $messages = [
        ['message' => 'Hello World', 'created' => '2024-01-02'],
        ['message' => 'Bonjour le monde', 'created' => '2024-01-03'],
        ['message' => 'Hallo Welt', 'created' => '2023-11-04'],
        ['message' => 'אהלן וסהלן', 'created' => '2023-12-04'],
        ['message' => 'Ciao mondo', 'created' => '2023-12-05'],
        ['message' => 'Hola mundo', 'created' => '2023-12-06'],
        ['message' => 'Привет, мир', 'created' => '2023-01-07'],
        ['message' => '你好，世界', 'created' => '2023-01-08'],
        ['message' => 'こんにちは世界', 'created' => '2023-11-09'],
        ['message' => '안녕하세요 세상', 'created' => '2024-01-10'],
        ['message' => 'สวัสดีชาวโลก', 'created' => '2024-01-11'],
        ['message' => 'Chào thế giới', 'created' => '2024-01-12'],
    ];

    #[Route('/', name: 'app_index')]
    public function index(UserProfileRepository $profiles, MicroPostRepository $posts): Response
    {
        // $user = new User();
        // $user->setEmail('email1@email.com');
        // $user->setPassword('password');

        // $profile = new UserProfile();
        // $profile->setUser($user);
        
        // $this->entityManager->persist($profile);
        // $this->entityManager->flush();

        // $profile = $profiles->find(1);
        // $this->entityManager->remove($profile);
        // $this->entityManager->flush();


        // $post = new MicroPost();
        // $post->setTitle('Hello');
        // $post->setText('Hello');
        // $post->setCreatedAt(new DateTime());

        // $post = $posts->find(1);
        // $comment = $post->getComments()[0];
        // $post->removeComment($comment);

        // $comment = new Comment();
        // $comment->setText('Hello');
        // // $comment->setPost($post);
        // $post->addComment($comment);

        //   $this->entityManager->persist($comment);
        // $this->entityManager->flush();

        // $this->entityManager->persist($post);
        // $this->entityManager->flush();

        // dd($post);
        return $this->render('hello/index.html.twig', [
            'messages' => $this->messages,
            'limit' => 12,
        ]
        );
    }

    #[Route('/messages/{id<\d+>}', name: 'app_show_one')]
    public function showOne(int $id): Response
    {
        return $this->render('hello/show_one.html.twig', ['message' => $this->messages[$id]]);
    }
}