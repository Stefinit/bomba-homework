<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="Bomba Homework API",
 *     version="1.0.0",
 *     description="API documentation for the Order Tracking System"
 * )
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="Local API Server"
 * )
 *
 * @OA\Schema(
 *     schema="OrderItem",
 *     type="object",
 *     required={"product_name", "quantity", "price"},
 *     @OA\Property(property="product_name", type="string", example="T-Shirt"),
 *     @OA\Property(property="quantity", type="integer", example=2),
 *     @OA\Property(property="price", type="number", format="float", example=19.99)
 * )
 *
 * @OA\Schema(
 *     schema="Order",
 *     type="object",
 *     required={"order_number", "status", "total_amount"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="order_number", type="string", example="ORDER-12345"),
 *     @OA\Property(property="status", type="string", enum={"pending", "shipped", "delivered", "canceled"}, example="pending"),
 *     @OA\Property(property="total_amount", type="number", format="float", example=99.99),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-23T10:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-23T10:15:00Z"),
 *     @OA\Property(
 *         property="items",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/OrderItem")
 *     )
 * )
 */
class SwaggerController
{
}
