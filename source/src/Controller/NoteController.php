<?php

namespace App\Controller;

use App\Service\NoteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class NoteController extends AbstractController
{
    private NoteService $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }

    #[Route('/api/notes', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $notes = $this->noteService->all();

        return new JsonResponse($notes);
    }

    #[Route('api/note/{filename}', methods: ['GET'])]
    public function show(string $filename): JsonResponse
    {
        $note = $this->noteService->for($filename);

        return new JsonResponse($note);
    }
}
