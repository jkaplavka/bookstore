<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Repository\Book\AuthorRepository;
use App\Repository\Book\FormatRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    #[Route(path: '/admin', name: 'admin_home')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    #[Route(path: '/admin/books', name: 'admin_books_list')]
    public function booksList(
        AuthorRepository $authorRepository,
        CategoryRepository $categoryRepository,
        FormatRepository $formatRepository
    ): Response
    {
        return $this->render('admin/index.html.twig', [
            'authors' => $authorRepository->findBy([], ['name' => 'ASC']),
            'categories' => $categoryRepository->findBy([], ['name' => 'ASC']),
            'formats' => $formatRepository->findBy([], ['name' => 'ASC']),
        ]);
    }

    #[Route(path: '/admin/books/add', name: 'admin_books_add')]
    public function booksAdd(
        AuthorRepository $authorRepository,
        CategoryRepository $categoryRepository,
        FormatRepository $formatRepository
    ): Response
    {
        return $this->render('admin/index.html.twig', [
            'authors' => $authorRepository->findBy([], ['name' => 'ASC']),
            'categories' => $categoryRepository->findBy([], ['name' => 'ASC']),
            'formats' => $formatRepository->findBy([], ['name' => 'ASC']),
        ]);
    }

    #[Route(path: '/admin/books/{id}', name: 'admin_books_edit')]
    public function booksEdit(
        string $id,
        AuthorRepository $authorRepository,
        CategoryRepository $categoryRepository,
        FormatRepository $formatRepository
    ): Response
    {
        return $this->render('admin/index.html.twig', [
            'authors' => $authorRepository->findBy([], ['name' => 'ASC']),
            'categories' => $categoryRepository->findBy([], ['name' => 'ASC']),
            'formats' => $formatRepository->findBy([], ['name' => 'ASC']),
            'currentBookId' => $id,
        ]);
    }

}
