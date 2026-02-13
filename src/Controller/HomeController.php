<?php

namespace App\Controller;

use App\Repository\PostRepository;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        Request $request,
        PostRepository $postRepository,
        CategoryRepository $categoryRepository,
        UserRepository $userRepository,
        PaginatorInterface $paginator
    ): Response
    {
        $categoryId = $request->query->get('category');
        $authorId = $request->query->get('author');
        $dateFrom = $request->query->get('date_from');
        $dateTo = $request->query->get('date_to');
        $search = $request->query->get('q');

        $posts = $postRepository->findWithFilters(
            $categoryId ? (int)$categoryId : null,
            $authorId ? (int)$authorId : null,
            $dateFrom,
            $dateTo,
            $search
        );

        // Paginate results (12 per page)
        $pagination = $paginator->paginate(
            $posts,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('home/index.html.twig', [
            'pagination' => $pagination,
            'categories' => $categoryRepository->findAll(),
            'authors' => $userRepository->findAll(),
            'selectedCategory' => $categoryId,
            'selectedAuthor' => $authorId,
            'selectedDateFrom' => $dateFrom,
            'selectedDateTo' => $dateTo,
            'searchQuery' => $search,
        ]);
    }
}
