<?php

namespace App\Controller;

use App\Repository\PostRepository;
use App\Repository\CategoryRepository;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin')]
#[IsGranted('ROLE_ADMIN')]
class AdminController extends AbstractController
{
    #[Route('/dashboard', name: 'app_admin_dashboard')]
    public function dashboard(
        PostRepository $postRepository,
        CategoryRepository $categoryRepository,
        CommentRepository $commentRepository,
        UserRepository $userRepository
    ): Response {
        $posts = $postRepository->findAll();
        $categories = $categoryRepository->findAll();
        $comments = $commentRepository->findAll();
        $users = $userRepository->findAll();

        return $this->render('admin/dashboard.html.twig', [
            'posts' => $posts,
            'totalPosts' => count($posts),
            'totalCategories' => count($categories),
            'totalComments' => count($comments),
            'totalUsers' => count($users),
        ]);
    }

    #[Route('/posts', name: 'app_admin_posts')]
    public function posts(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findAll();

        return $this->render('admin/posts.html.twig', [
            'posts' => $posts,
        ]);
    }

    #[Route('/categories', name: 'app_admin_categories')]
    public function categories(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('admin/categories.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/users', name: 'app_admin_users')]
    public function users(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();

        return $this->render('admin/users.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/comments', name: 'app_admin_comments')]
    public function comments(CommentRepository $commentRepository): Response
    {
        $comments = $commentRepository->findAll();

        return $this->render('admin/comments.html.twig', [
            'comments' => $comments,
        ]);
    }

    #[Route('/users/{id}/toggle-active', name: 'app_admin_user_toggle_active', methods: ['POST'])]
    public function toggleUserActive(User $user, EntityManagerInterface $entityManager): Response
    {
        $user->setIsActive(!$user->isActive());
        $entityManager->flush();

        $status = $user->isActive() ? 'activé' : 'désactivé';
        $this->addFlash('success', "L'utilisateur {$user->getFirstName()} {$user->getLastName()} a été {$status}.");

        return $this->redirectToRoute('app_admin_users');
    }
}
