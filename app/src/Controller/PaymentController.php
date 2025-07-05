<?php

namespace App\Controller;

use App\UseCase\CheckPayment;
use OpenApi\Attributes as OA;
use App\UseCase\CreateNewPayment;
use App\DTO\CreateNewPayment\Request;
use Nelmio\ApiDocBundle\Attribute\Model;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\DTO\CheckPayment\Request as CheckPaymentRequest;
use App\DTO\CheckPayment\Response;
use Doctrine\ORM\NoResultException;
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
                new OA\Property(property: 'message', type: 'string', example: 'Thanks for payment! We will contact you soon via email.'),
                new OA\Property(property: 'id', type: 'string', example: '1')
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
        $response = $createNewPayment->execute($request);

        return $this->json([
            'id' => $response->id,
            'message' => 'Thanks for payment! We will contact you soon via email.',
        ]);
    }

    #[Route('/payment/{id}', name: 'app_payment_get', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Payment information',
        content: new Model(type: Response::class)
    )]
    #[OA\Parameter(
        name: 'id',
        in: 'path',
        description: 'The ID of the payment to check',
        required: true,
        schema: new OA\Schema(type: 'integer')
    )]
    #[OA\Tag(name: 'payment')]
    public function getPayment(
        int $id,
        CheckPayment $checkPayment
    ): JsonResponse
    {
        try {
            $response = $checkPayment->execute(new CheckPaymentRequest($id));
        } catch (NoResultException $e) {
            throw $this->createNotFoundException('Payment not found');
        }

        return $this->json([
            'transaction_id' => $response->transaction_id,
            'status' => $response->status,
            'date' => $response->date,
        ]);
    }
}
