<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[Route('/profile')]
final class ProfileController extends AbstractController
{
    #[Route('/', name: 'app_profile_index', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        $user = $this->getUser();

        return $this->render('profile/index.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/edit', name: 'app_profile_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function edit(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Handle file upload
            $profilePictureFile = $form->get('profilePicture')->getData();
            if ($profilePictureFile) {
                $originalFilename = pathinfo($profilePictureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $profilePictureFile->guessExtension();

                try {
                    $profilePictureFile->move(
                        $this->getParameter('profiles_directory'),
                        $newFilename
                    );
                } catch (\Exception $e) {
                    $this->addFlash('danger', 'Erreur lors du téléchargement de la photo.');
                    return $this->redirectToRoute('app_profile_edit');
                }

                // Delete old profile picture if it exists
                if ($user->getProfilePicture()) {
                    $oldPath = $this->getParameter('profiles_directory') . '/' . $user->getProfilePicture();
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }

                $user->setProfilePicture($newFilename);
            }

            $user->setUpdateAt(new \DateTimeImmutable());
            $entityManager->flush();

            $this->addFlash('success', 'Votre profil a été mis à jour avec succès.');

            return $this->redirectToRoute('app_profile_index');
        }

        return $this->render('profile/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_profile_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('profile/show.html.twig', [
            'profile_user' => $user,
        ]);
    }
}
