<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Servicio;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="API Salón de Belleza",
 *     version="1.0.0",
 *     description="API REST para gestión de citas y servicios del salón de belleza",
 *     @OA\Contact(
 *         email="admin@salon.com",
 *         name="Equipo de Desarrollo"
 *     )
 * )
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="Servidor API"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="sanctum",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="Sanctum"
 * )
 */
class ServicioApiController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/servicios",
     *     summary="Listar todos los servicios",
     *     description="Obtiene la lista completa de servicios disponibles",
     *     operationId="getServicios",
     *     tags={"Servicios"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de servicios obtenida exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Servicios obtenidos exitosamente"),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="nombre", type="string", example="Corte de Cabello"),
     *                     @OA\Property(property="descripcion", type="string", example="Corte moderno y personalizado"),
     *                     @OA\Property(property="precio", type="number", format="float", example=80.00),
     *                     @OA\Property(property="duracion_minutos", type="integer", example=30),
     *                     @OA\Property(property="activo", type="boolean", example=true)
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        $servicios = Servicio::where('activo', true)->get();

        return response()->json([
            'success' => true,
            'message' => 'Servicios obtenidos exitosamente',
            'data' => $servicios
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="/api/servicios/{id}",
     *     summary="Obtener un servicio específico",
     *     description="Obtiene los detalles de un servicio por su ID",
     *     operationId="getServicio",
     *     tags={"Servicios"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del servicio",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Servicio encontrado",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Servicio encontrado"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="nombre", type="string", example="Corte de Cabello"),
     *                 @OA\Property(property="precio", type="number", format="float", example=80.00)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Servicio no encontrado",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Servicio no encontrado")
     *         )
     *     )
     * )
     */
    public function show($id)
    {
        $servicio = Servicio::find($id);

        if (!$servicio) {
            return response()->json([
                'success' => false,
                'message' => 'Servicio no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Servicio encontrado',
            'data' => $servicio
        ], 200);
    }
}