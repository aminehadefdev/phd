<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use App\Entity\Event;
use App\Service\FileService;

class EventController extends AbstractController
{
    /**
     * @Route("/event/{id}", methods={"GET"}, name="get_event")
     */
    public function index($id, NormalizerInterface $normalizer): Response
    {
        $eventEntity = $this->getDoctrine()->getRepository(Event::class)->find($id);
        if (!$eventEntity) {
            throw $this->createNotFoundException(
                'No events found for id ' . $id
            );
        }
        $event = $normalizer->normalize($eventEntity, null, []);

        return new JsonResponse(["event" => $event]);
    }

    /**
     * @Route("/event", methods={"GET"}, name="get_events")
     */
    public function getAll(NormalizerInterface $normalizer): Response
    {
        $eventEntity = $this->getDoctrine()
            ->getRepository(Event::class)
            ->findAll();

        $events = $normalizer->normalize($eventEntity, null, []);

        return new JsonResponse(["events" => $events]);
    }

    /**
     * @Route("/event", methods={"POST"}, name="post_event")
     */
    public function create(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager, ValidatorInterface $validator, FileService $fileUploader): Response
    {
        /** @var UploadedFile $uploadedFile */
        $uploadedFile = $request->files->get('image');
        $jsonRequestEvent =  json_encode($request->request->all());
        $filename = null;
        $event = null;

        if ($uploadedFile) {
            $filename = $fileUploader->upload($uploadedFile);
            if (!$filename) {
                return $this->json(["message" => "bad file Extensio"], 400);
            }
        } else {
            return $this->json(["message" => "images fail"], 400);
        }
        try {
            $event = $serializer->deserialize($jsonRequestEvent, Event::class, "json");
        } catch (\Throwable $th) {
            return $this->json(["message" => "bad request"], 400);
        }
        $errors = $validator->validate($event);
        if (count($errors) > 0) {
            return [
                "message" => "validation errors",
                $this->json($errors, 400)
            ];
        }

        $event->setImage($filename);
        $entityManager->persist($event);
        $entityManager->flush();

        return $this->json([$event], 201);
    }
    /**
     * @Route("/event/{id}", methods={"POST"}, name="up_event")
     */
    public function update($id, Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator, Filesystem $filesystem, FileService $fileUploader): Response
    {
        $jsonRequestEvent =  $request->request;
        /** @var UploadedFile $uploadedFile */
        $uploadedFile = $request->files->get('file');
        $event = $entityManager->getRepository(Event::class)->find($id);
        if ($event) {
            if ($jsonRequestEvent->get('title')) {
                $event->setTitle($jsonRequestEvent->get('title'));
            }
            if ($jsonRequestEvent->get('organizer')) {
                $event->setOrganizer($jsonRequestEvent->get('organizer'));
            }
            if ($jsonRequestEvent->get('type')) {
                $event->setType($jsonRequestEvent->get('type'));
            }
            if ($jsonRequestEvent->get('date')) {
                $event->setDate(
                    new \DateTime($jsonRequestEvent->get('date'))
                );
            }
            if ($jsonRequestEvent->get('locality')) {
                $event->setLocality($jsonRequestEvent->get('locality'));
            }
            if ($uploadedFile) {
                try {
                    $filesystem->remove($this->getParameter('events_directory') . "/" . $event->getImage());
                } catch (\Throwable $th) {
                    //throw $th;
                }
                $filename = $fileUploader->upload($uploadedFile);
                if (!$filename) {
                    return $this->json(["message" => "bad file Extensio"], 400);
                }
                $event->setImage($filename);
            }
        } else {
            return $this->json(["message" => "event not found"], 400);
        }
        $errors = $validator->validate($event);
        if (count($errors) > 0) {
            return $this->json($errors, 400);
        }

        $entityManager->persist($event);
        $entityManager->flush();

        return $this->json([$event], 201);
    }
    /**
     * @Route("/event/{id}", methods={"DELETE"}, name="delete_event")
     */
    public function delete($id, EntityManagerInterface $entityManager, Filesystem $filesystem)
    {
        $event = $entityManager->getRepository(Event::class)->find($id);
        $filename = $event->getImage();
        try {
            $filesystem->remove($this->getParameter('events_directory') . "/" . $filename);
        } catch (\Throwable $th) {
            //throw $th;
        }
        if (!$event) {
            return $this->json([
                "message" => "event not found",
            ], 400);
        }
        $entityManager->remove($event);
        $entityManager->flush();
        return $this->json([
            "message" => "event removed"
        ]);
    }
}
