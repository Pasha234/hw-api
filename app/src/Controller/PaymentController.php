<?php

namespace App\Controller;

use OpenApi\Attributes as OA;
use App\UseCase\CreateNewPayment;
use App\DTO\CreateNewPayment\Request;
use Nelmio\ApiDocBundle\Attribute\Model;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class PaymentController extends AbstractController
{
    #[Route('/payment', name: 'app_payment', methods: ['POST'])]
    #[OA\Response(
        response: 200,
        description: 'Payment request accepted. The payment will be processed asynchronously.',
        content: new OA\JsonContent(
            type: 'object',
            properties: [
                new OA\Property(property: 'message', type: 'string', example: 'Thanks for payment! We will contact you soon via email.')
            ]
        )
    )]
    #[OA\RequestBody(description: 'Payment Information', content: new Model(type: Request::class))]
    #[OA\Tag(name: 'payment')]
    public function index(
        #[MapRequestPayload] Request $request,
        CreateNewPayment $createNewPayment
    ): JsonResponse
    {
        $createNewPayment->execute($request);

        return $this->json([
            'message' => 'Thanks for payment! We will contact you soon via email.',
        ]);
    }
}
