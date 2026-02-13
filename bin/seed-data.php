<?php
// bin/console script to create admin user and test data

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

return function() {
    return function(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher) {
        // Create admin user
        $admin = new User();
        $admin->setEmail('admin@blog.com');
        $admin->setFirstName('Admin');
        $admin->setLastName('User');
        $admin->setCreateAt(new \DateTimeImmutable());
        $admin->setRoles(['ROLE_ADMIN']);
        $hashedPassword = $passwordHasher->hashPassword($admin, 'admin123');
        $admin->setPassword($hashedPassword);
        
        // Create a category
        $category = new Category();
        $category->setName('Technologie');
        $category->setDescription('Articles sur la technologie');
        
        // Create a post
        $post = new Post();
        $post->setTitle('Mon premier article');
        $post->setContent('Ceci est un article de test créé automatiquement');
        $post->setPicture('https://via.placeholder.com/300x200');
        $post->setPublishAt(new \DateTimeImmutable());
        $post->setUser($admin);
        $post->setCategory($category);
        
        $entityManager->persist($admin);
        $entityManager->persist($category);
        $entityManager->persist($post);
        $entityManager->flush();
        
        echo "✅ Admin user created: admin@blog.com (password: admin123)\n";
        echo "✅ Category created: Technologie\n";
        echo "✅ Post created: Mon premier article\n";
    };
};
