<?php

namespace App\Http\Controllers;

use App\Models\Order;

class ExternalApiController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/external-api/status/{order}",
     *     summary="Check the status of an order via external API",
     *     tags={"External API"},
     *     @OA\Parameter(
     *         name="order",
     *         in="path",
     *         required=true,
     *         description="Order ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response with the order status",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="order_number", type="string", example="ORDER-12345"),
     *             @OA\Property(property="status", type="string", enum={"pending", "shipped", "delivered", "canceled"}, example="shipped")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Order not found"
     *     )
     * )
     */
    public function checkStatus(Order $order)
    {
        $statuses = Order::STATUSES;
        $status = $statuses[array_rand($statuses)];

        return response()->json([
            'order_number' => $order->order_number,
            'status' => $status,
        ]);
    }
}
