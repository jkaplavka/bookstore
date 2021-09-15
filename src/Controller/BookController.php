<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{

    #[Route(path: '/', name: 'app_home')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('book/index.html.twig', [
            'categories' => $categoryRepository->findBy([], ['name' => 'ASC']),
        ]);
    }

    #[Route(path: '/book/{id}', name: 'app_book')]
    public function book(string $id, CategoryRepository $categoryRepository): Response
    {
        return $this->render('book/index.html.twig', [
            'categories' => $categoryRepository->findBy([], ['name' => 'ASC']),
            'currentBookId' => $id,
        ]);
    }

    #[Route(path: '/category/{id}', name: 'app_category')]
    public function category(string $id, CategoryRepository $categoryRepository): Response
    {
        return $this->render('book/index.html.twig', [
            'categories' => $categoryRepository->findBy([], ['name' => 'ASC']),
            'currentCategoryId' => $id,
        ]);
    }

}
