<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HelloController extends AbstractController
{
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

    #[Route('/{limit<\d+>?12}', name: 'app_index')]
    public function index(int $limit): Response
    {
        return $this->render('hello/index.html.twig', [
            'messages' => $this->messages,
            'limit' => $limit,
        ]
        );
    }

    #[Route('/messages/{id<\d+>}', name: 'app_show_one')]
    public function showOne(int $id): Response
    {
        return $this->render('hello/show_one.html.twig', ['message' => $this->messages[$id]]);
    }
}