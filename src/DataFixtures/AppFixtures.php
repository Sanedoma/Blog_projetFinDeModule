<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Category;
use App\Entity\Post;
use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        // Create admin
        $admin = new User();
        $admin->setFirstName('Admin');
        $admin->setLastName('User');
        $admin->setEmail('admin@blog.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setCreateAt(new \DateTimeImmutable());
        $admin->setPassword($this->passwordHasher->hashPassword($admin, 'admin123'));
        $manager->persist($admin);

        // Regular user
        $user = new User();
        $user->setFirstName('Jean');
        $user->setLastName('Dupont');
        $user->setEmail('user@blog.com');
        $user->setRoles(['ROLE_USER']);
        $user->setCreateAt(new \DateTimeImmutable());
        $user->setPassword($this->passwordHasher->hashPassword($user, 'user123'));
        $manager->persist($user);

        // Categories
        $categories = [];
        $names = ['Actualités', 'Développement', 'Lifestyle'];
        foreach ($names as $name) {
            $c = new Category();
            $c->setName($name);
            $c->setDescription("Articles sur $name");
            $manager->persist($c);
            $categories[] = $c;
        }

        // Posts
        for ($i = 1; $i <= 6; $i++) {
            $post = new Post();
            $post->setTitle("Article d'exemple #$i");
            $post->setContent("Contenu d'exemple pour l'article $i. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a diam lectus.");
            $post->setPublishAt(new \DateTimeImmutable(sprintf('-%d days', rand(0, 30))));
            $post->setPicture('https://picsum.photos/seed/post' . $i . '/900/300');
            // Alternate author
            $post->setUser($i % 2 === 0 ? $admin : $user);
            // Random category
            $post->setCategory($categories[array_rand($categories)]);
            $manager->persist($post);

            // Add a couple comments
            $commentCount = rand(0, 3);
            for ($j = 0; $j < $commentCount; $j++) {
                $comment = new Comment();
                $comment->setContent('Un commentaire de démonstration #' . ($j + 1));
                $comment->setCreateAt(new \DateTimeImmutable(sprintf('-%d hours', rand(1, 200))));
                $comment->setUser($user);
                $comment->setPost($post);
                $manager->persist($comment);
            }
        }

        $manager->flush();
    }
}
