<?php
namespace App\Controller\Actions;

use App\Entity\User;
use App\Entity\Media;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;

class ManageMediaToUserAction
{
    public function __invoke(User $data, Request $request, EntityManagerInterface $entityManager)
    {
        $mediaRepository = $entityManager->getRepository(Media::class);
        $content = json_decode($request->getContent(), true);
        $requestPath = explode('/', $request->getPathInfo())[4];

        if (!array_key_exists('media_id', $content)) {
            throw new MissingMandatoryParametersException('Missing mandatory parameter: media_id');
        }

        $mediaItem = $mediaRepository->find($content['media_id']);
        if (!$mediaItem) {
            throw new NotFoundHttpException('Mediaitem with ID: '. $content['media_id'] .' not found');
        }

        if ($requestPath === 'add-media') {
            $data->addWatchedMedium($mediaItem);
        } else if ($requestPath === 'remove-media') {
            $data->removeWatchedMedium($mediaItem);
        } else {
            throw new \HttpRequestException('Invalid endpoint');
        }

        $entityManager->flush();

        return $data;
    }
}