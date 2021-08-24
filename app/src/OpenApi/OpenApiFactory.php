<?php

declare(strict_types=1);

namespace App\OpenApi;

use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\Core\OpenApi\OpenApi;
use ApiPlatform\Core\OpenApi\Model;

final class OpenApiFactory implements OpenApiFactoryInterface
{
    public function __construct(
        private OpenApiFactoryInterface $decorated
    )
    {
    }

    public function __invoke(array $context = []): OpenApi
    {
        $openApi =  $this->decorated->__invoke($context);
        $schemas = $openApi->getComponents()->getSchemas();

        $schemas['Token'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'token' => [
                    'type' => 'string',
                    'readOnly' => true,
                ],
            ],
        ]);
        $schemas['Credentials'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'email' => [
                    'type' => 'string',
                    'example' => 'admin@admin.nl',
                ],
                'password' => [
                    'type' => 'string',
                    'example' => 'admin',
                ],
            ],
        ]);
        $schemas['ManageMediaToUser'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'media_id' => [
                    'type' => 'int',
                    'example' => '2',
                ],
            ],
        ]);

        $pathItem = new Model\PathItem(
            ref: 'JWT Token',
            post: new Model\Operation(
                operationId: 'postCredentialsItem',
                tags: ['Token'],
                responses: [
                    '200' => [
                        'description' => 'Get JWT token',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/Token',
                                ],
                            ],
                        ],
                    ],
                ],
                summary: 'Get JWT token to login.',
                requestBody: new Model\RequestBody(
                    description: 'Generate new JWT Token',
                    content: new \ArrayObject([
                        'application/json' => [
                            'schema' => [
                                '$ref' => '#/components/schemas/Credentials',
                            ],
                        ],
                    ]),
                ),
            ),
        );
        $openApi->getPaths()->addPath('/api/authentication_token', $pathItem);

        $pathItem = $openApi->getPaths()->getPath('/api/users/{id}/add-media');
        $operation = $pathItem->getPut();
        $requestBody = new Model\RequestBody(
            description: 'Add Media To User',
            content: new \ArrayObject([
                'application/json' => [
                    'schema' => [
                        '$ref' => '#/components/schemas/ManageMediaToUser',
                    ],
                ],
            ]),
        );
        $openApi->getPaths()->addPath('/api/users/{id}/add-media', $pathItem->withPut(
            $operation->withRequestBody($requestBody)
        ));

        $pathItem = $openApi->getPaths()->getPath('/api/users/{id}/remove-media');
        $operation = $pathItem->getPut();
        $requestBody = new Model\RequestBody(
            description: 'Add Media To User',
            content: new \ArrayObject([
                'application/json' => [
                    'schema' => [
                        '$ref' => '#/components/schemas/ManageMediaToUser',
                    ],
                ],
            ]),
        );
        $openApi->getPaths()->addPath('/api/users/{id}/remove-media', $pathItem->withPut(
            $operation->withRequestBody($requestBody)
        ));

        return $openApi;
    }
}