<?php

namespace App\Controller;

use App\Repository\NoteRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
}
