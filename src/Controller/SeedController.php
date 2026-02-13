<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

final class SeedController extends AbstractController
{
    #[Route('/seed', name: 'app_seed')]
    public function seed(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        // Create admin user
        $admin = new User();
        $admin->setEmail('admin@blog.com');
        $admin->setFirstName('Admin');
        $admin->setLastName('User');
        $admin->setCreateAt(new \DateTimeImmutable());
        $admin->setRoles(['ROLE_ADMIN']);
        $hashedPassword = $passwordHasher->hashPassword($admin, 'admin123');
        $admin->setPassword($hashedPassword);
        
        // Create regular user
        $user = new User();
        $user->setEmail('user@blog.com');
        $user->setFirstName('Jean');
        $user->setLastName('Dupont');
        $user->setCreateAt(new \DateTimeImmutable());
        $user->setRoles(['ROLE_USER']);
        $hashedPassword = $passwordHasher->hashPassword($user, 'user123');
        $user->setPassword($hashedPassword);
        
        // Create categories
        $techCategory = new Category();
        $techCategory->setName('Technologie');
        $techCategory->setDescription('Articles sur la technologie et la programmation');
        
        $travelCategory = new Category();
        $travelCategory->setName('Voyage');
        $travelCategory->setDescription('Récits de voyages et découvertes');
        
        // Create posts
        $post1 = new Post();
        $post1->setTitle('Introduction à Symfony');
        $post1->setContent('Symfony est un framework PHP puissant et flexible. Dans cet article, nous allons explorer les concepts fondamentaux de Symfony et comment l\'utiliser pour construire des applications web robustes.');
        $post1->setPicture('https://via.placeholder.com/400x300?text=Symfony');
        $post1->setPublishAt(new \DateTimeImmutable());
        $post1->setUser($admin);
        $post1->setCategory($techCategory);
        
        $post2 = new Post();
        $post2->setTitle('Doctrine ORM - Expliqué');
        $post2->setContent('Doctrine est un ORM puissant pour PHP. Cet article explique comment utiliser Doctrine pour gérer les relations entre entités de manière efficace.');
        $post2->setPicture('https://via.placeholder.com/400x300?text=Doctrine');
        $post2->setPublishAt(new \DateTimeImmutable());
        $post2->setUser($admin);
        $post2->setCategory($techCategory);
        
        $post3 = new Post();
        $post3->setTitle('Ma visite à Paris');
        $post3->setContent('Paris, la ville de la lumière, est une destination magnifique. Découvrez mes impressions et conseils pour visiter la capitale française.');
        $post3->setPicture('https://via.placeholder.com/400x300?text=Paris');
        $post3->setPublishAt(new \DateTimeImmutable());
        $post3->setUser($user);
        $post3->setCategory($travelCategory);
        
        $entityManager->persist($admin);
        $entityManager->persist($user);
        $entityManager->persist($techCategory);
        $entityManager->persist($travelCategory);
        $entityManager->persist($post1);
        $entityManager->persist($post2);
        $entityManager->persist($post3);
        $entityManager->flush();
        
        return new Response('
            <h1>✅ Données créées avec succès !</h1>
            <p><strong>Admin:</strong> admin@blog.com / admin123</p>
            <p><strong>User:</strong> user@blog.com / user123</p>
            <p><a href="/">Aller à l\'accueil</a></p>
        ');
    }
}
