<?php
namespace App\Controller\Actions;

use App\Services\UserService;

class GetMeAction
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function __invoke() {
        return $this->userService->getCurrentUser();
    }
}