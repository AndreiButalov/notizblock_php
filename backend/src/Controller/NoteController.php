<?php

namespace App\Controller;

use App\Entity\Note;
use App\Repository\NoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class NoteController extends AbstractController
{
    #[Route('/api/notes', name: 'api_notes', methods: ['GET'])]
    public function index(NoteRepository $noteRepository): JsonResponse
    {
        $notes = $noteRepository->findAll();

        $data = array_map(static function ($note) {
            return [
                'id' => $note->getId(),
                'title' => $note->getTitle(),
                'content' => $note->getContent(),
                'createdAt' => $note->getCreatedAt()?->format(DATE_ATOM),
            ];
        }, $notes);

        return $this->json($data);
    }

    #[Route('/api/notes', name: 'api_notes_create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true) ?? [];
        $title = trim((string) ($data['title'] ?? ''));
        $content = trim((string) ($data['content'] ?? ''));

        if ($title === '' || $content === '') {
            return $this->json(['error' => 'Titel und Inhalt sind erforderlich.'], 400);
        }

        $note = new Note();
        $note->setTitle($title);
        $note->setContent($content);
        $note->setCreatedAt(new \DateTimeImmutable());

        $entityManager->persist($note);
        $entityManager->flush();

        return $this->json([
            'id' => $note->getId(),
            'title' => $note->getTitle(),
            'content' => $note->getContent(),
            'createdAt' => $note->getCreatedAt()?->format(DATE_ATOM),
        ], 201);
    }
}
