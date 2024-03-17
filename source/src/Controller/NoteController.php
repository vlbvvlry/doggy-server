<?php

namespace App\Controller;

use App\Service\NoteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
        $notes = $this->noteService->index();

        return new JsonResponse($notes);
    }

    #[Route('/api/note', methods: ['POST'])]
    public function today(Request $request): JsonResponse
    {
        $status = $this->noteService->today(content: $request->get('content'));

        return new JsonResponse($status);
    }

    #[Route('api/note/{filename}', methods: ['GET'])]
    public function show(string $filename): JsonResponse
    {
        $note = $this->noteService->show($filename);

        return new JsonResponse($note);
    }

    #[Route('api/note/{filename}', methods: ['PUT'])]
    public function update(Request $request, string $filename): JsonResponse
    {
        $status = $this->noteService->update($filename, $request->get('content'));

        return new JsonResponse($status);
    }

    public function destroy(string $filename): JsonResponse
    {
        return new JsonResponse();
    }
}
