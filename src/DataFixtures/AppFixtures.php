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
        $admin->setCreateAt(new \DateTimeImmutable('2025-01-01'));
        $admin->setPassword($this->passwordHasher->hashPassword($admin, 'admin123'));
        $admin->setIsActive(true);
        $manager->persist($admin);

        // Regular users
        $users = [];
        
        $user1 = new User();
        $user1->setFirstName('Jean');
        $user1->setLastName('Dupont');
        $user1->setEmail('jean@blog.com');
        $user1->setRoles(['ROLE_USER']);
        $user1->setCreateAt(new \DateTimeImmutable('2025-01-05'));
        $user1->setPassword($this->passwordHasher->hashPassword($user1, 'user123'));
        $user1->setIsActive(true);
        $manager->persist($user1);
        $users[] = $user1;

        $user2 = new User();
        $user2->setFirstName('Marie');
        $user2->setLastName('Martin');
        $user2->setEmail('marie@blog.com');
        $user2->setRoles(['ROLE_USER']);
        $user2->setCreateAt(new \DateTimeImmutable('2025-01-10'));
        $user2->setPassword($this->passwordHasher->hashPassword($user2, 'user123'));
        $user2->setIsActive(true);
        $manager->persist($user2);
        $users[] = $user2;

        $user3 = new User();
        $user3->setFirstName('Pierre');
        $user3->setLastName('Bernard');
        $user3->setEmail('pierre@blog.com');
        $user3->setRoles(['ROLE_USER']);
        $user3->setCreateAt(new \DateTimeImmutable('2025-01-15'));
        $user3->setPassword($this->passwordHasher->hashPassword($user3, 'user123'));
        $user3->setIsActive(true);
        $manager->persist($user3);
        $users[] = $user3;

        // Categories
        $categories = [];
        
        $cat1 = new Category();
        $cat1->setName('Développement');
        $cat1->setDescription('Articles sur la programmation et le développement web');
        $manager->persist($cat1);
        $categories[] = $cat1;

        $cat2 = new Category();
        $cat2->setName('Lifestyle');
        $cat2->setDescription('Articles sur la vie quotidienne et les tendances');
        $manager->persist($cat2);
        $categories[] = $cat2;

        $cat3 = new Category();
        $cat3->setName('Actualités');
        $cat3->setDescription('Dernières actualités du monde de la technologie');
        $manager->persist($cat3);
        $categories[] = $cat3;

        $cat4 = new Category();
        $cat4->setName('Design');
        $cat4->setDescription('Articles sur le design, l\'UX/UI et la créativité');
        $manager->persist($cat4);
        $categories[] = $cat4;

        // Posts with more realistic content
        $posts = [
            [
                'title' => 'Débuter avec Symfony 6',
                'content' => 'Symfony est un framework PHP puissant pour développer des applications web modernes. Dans cet article, nous allons découvrir les bases de Symfony 6, ses composants principaux et comment mettre en place votre premier projet. Nous verrons comment utiliser les routes, les contrôleurs, les services et bien d\'autres features essentielles.',
                'days' => 28,
                'category' => 0,
                'user' => 0,
                'featured' => true,
            ],
            [
                'title' => 'Les meilleures pratiques en CSS moderne',
                'content' => 'Le CSS a énormément évolué ces dernières années avec l\'arrivée de Flexbox, Grid et des variables CSS. Cet article explore les meilleures pratiques pour écrire du CSS maintenable et performant. Nous verrons comment organiser votre code, utiliser les variables CSS, et créer des layouts responsifs.',
                'days' => 25,
                'category' => 3,
                'user' => 1,
                'featured' => true,
            ],
            [
                'title' => 'JavaScript async/await expliqué',
                'content' => 'Les Promises et async/await sont essentiels en JavaScript moderne. Dans ce guide complet, nous apprenons comment écrire du code asynchrone lisible et maintenable. Nous couvrirons les callbacks, les Promises, async/await, et les patterns de gestion des erreurs.',
                'days' => 22,
                'category' => 0,
                'user' => 2,
                'featured' => true,
            ],
            [
                'title' => 'Les tendances du design en 2026',
                'content' => 'Cette année, nous voyons émerger de nouvelles tendances dans le design. Le minimalisme continue de dominer, mais avec des touches de couleurs audacieuses. Nous explorons également le retour du skeuomorphisme et l\'importance croissante de l\'accessibilité dans le design.',
                'days' => 20,
                'category' => 3,
                'user' => 0,
                'featured' => false,
            ],
            [
                'title' => 'Découvrez React Hooks',
                'content' => 'React Hooks révolutionnent la façon dont nous écrivons les composants React. Au lieu d\'utiliser des classes, nous pouvons maintenant utiliser des fonctions avec des hooks comme useState, useEffect et useContext. Cet article vous montre comment maîtriser les hooks et améliorer votre productivité.',
                'days' => 18,
                'category' => 0,
                'user' => 1,
                'featured' => false,
            ],
            [
                'title' => 'Comment rester productif en télétravail',
                'content' => 'Le télétravail offre de nombreux avantages mais peut aussi être une source de distraction. Découvrez les stratégies que j\'utilise pour rester productif, établir une routine de travail saine et maintenir l\'équilibre travail-vie privée. Nous verrons des outils et des techniques éprouvées.',
                'days' => 15,
                'category' => 1,
                'user' => 2,
                'featured' => false,
            ],
            [
                'title' => 'Les nouvelles features de PHP 8.3',
                'content' => 'PHP 8.3 apporte son lot de nouvelles features et d\'améliorations de performance. Cet article couvre les attributs, les typed properties, les enums, et bien d\'autres nouveautés. Apprenez comment mettre à jour votre code pour profiter de ces améliorations.',
                'days' => 12,
                'category' => 0,
                'user' => 0,
                'featured' => false,
            ],
            [
                'title' => 'Guide complet de Docker',
                'content' => 'Docker révolutionne la façon dont nous développons et déployons les applications. Ce guide complet couvre les images, les conteneurs, Docker Compose et les bonnes pratiques. Apprenez à containeriser vos applications et à simplifier votre workflow de développement.',
                'days' => 10,
                'category' => 0,
                'user' => 1,
                'featured' => true,
            ],
            [
                'title' => 'Mindfulness et bien-être au travail',
                'content' => 'La santé mentale est aussi importante que la santé physique. Découvrez comment intégrer la mindfulness dans votre journée de travail, gérer le stress et créer un environnement de travail sain. Des techniques simples mais efficaces pour améliorer votre qualité de vie.',
                'days' => 8,
                'category' => 1,
                'user' => 2,
                'featured' => false,
            ],
            [
                'title' => 'L\'IA transforme le développement web',
                'content' => 'L\'intelligence artificielle change la façon dont nous écrivons du code. Des outils comme ChatGPT et GitHub Copilot offrent une aide précieuse au développement. Découvrez comment utiliser l\'IA pour améliorer votre productivité tout en maintenant la qualité du code.',
                'days' => 5,
                'category' => 0,
                'user' => 0,
                'featured' => true,
            ],
            [
                'title' => 'Web3 et les crypto-monnaies expliquées',
                'content' => 'Le Web3 est souvent mal compris. Cet article démystifie les concepts clés : blockchain, smart contracts, NFTs et DAOs. Nous explorons comment ces technologies façonnent l\'avenir d\'Internet et les opportunités qu\'elles présentent aux développeurs.',
                'days' => 3,
                'category' => 2,
                'user' => 1,
                'featured' => false,
            ],
            [
                'title' => 'Optimiser les performances de votre site',
                'content' => 'La performance est cruciale pour l\'expérience utilisateur. Cet article couvre les Core Web Vitals, l\'optimisation des images, le lazy loading, et bien d\'autres techniques. Apprenez à diagnostiquer et résoudre les problèmes de performance de votre site.',
                'days' => 1,
                'category' => 0,
                'user' => 2,
                'featured' => true,
            ],
        ];

        foreach ($posts as $postData) {
            $post = new Post();
            $post->setTitle($postData['title']);
            $post->setContent($postData['content']);
            $post->setPublishAt(new \DateTimeImmutable(sprintf('-%d days', $postData['days'])));
            $post->setPicture('https://picsum.photos/seed/' . slugify($postData['title']) . '/900/300');
            $post->setUser($users[$postData['user']] ?? $admin);
            $post->setCategory($categories[$postData['category']]);
            $post->setFeatured($postData['featured']);
            $manager->persist($post);

            // Add varied comments
            $commentCount = rand(2, 5);
            $commentTexts = [
                'Article très intéressant, merci de ce partage!',
                'J\'ai trouvé cela très utile, j\'aimerais bien plus de détails sur ce sujet.',
                'Bonne explication, claire et concise.',
                'Ça m\'a vraiment aidé à comprendre le concept.',
                'Excellente approche, je vais tester ça tout de suite!',
                'C\'est exactement ce que je cherchais. Merci!',
                'Pourriez-vous couvrir aussi le cas d\'usage avancé?',
                'Très bien structuré et facile à suivre.',
                'Je ne suis pas d\'accord avec ce point de vue.',
                'Impeccable! J\'ai apporté ce à mon projet avec succès.',
            ];

            for ($j = 0; $j < $commentCount; $j++) {
                $comment = new Comment();
                $comment->setContent($commentTexts[array_rand($commentTexts)]);
                $comment->setCreateAt(new \DateTimeImmutable(sprintf('-%d hours', rand(1, 200))));
                $comment->setUser($users[array_rand($users)]);
                $comment->setPost($post);
                $manager->persist($comment);
            }
        }

        $manager->flush();
    }
}

// Helper function to slugify text
function slugify($text): string
{
    // Convert to lowercase
    $text = strtolower($text);
    // Replace spaces with hyphens
    $text = preg_replace('/\s+/', '-', $text);
    // Remove special characters
    $text = preg_replace('/[^a-z0-9-]/', '', $text);
    // Remove consecutive hyphens
    $text = preg_replace('/-+/', '-', $text);
    // Trim hyphens from start and end
    return trim($text, '-');
}
