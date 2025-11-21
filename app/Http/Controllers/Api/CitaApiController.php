<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CitaApiController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/citas",
     *     summary="Listar citas del usuario autenticado",
     *     description="Obtiene todas las citas del usuario que hizo la petición",
     *     operationId="getCitas",
     *     tags={"Citas"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de citas obtenida exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Citas obtenidas exitosamente"),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="fecha", type="string", format="date", example="2025-11-20"),
     *                     @OA\Property(property="hora", type="string", format="time", example="10:00:00"),
     *                     @OA\Property(property="total", type="number", format="float", example=150.00),
     *                     @OA\Property(property="estado", type="string", example="confirmada"),
     *                     @OA\Property(
     *                         property="servicios",
     *                         type="array",
     *                         @OA\Items(
     *                             type="object",
     *                             @OA\Property(property="nombre", type="string", example="Corte de Cabello")
     *                         )
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="No autenticado"
     *     )
     * )
     */
    public function index(Request $request)
    {
        $citas = Cita::with('servicios')
                     ->where('user_id', $request->user()->id)
                     ->orderByDesc('fecha')
                     ->orderByDesc('hora')
                     ->get();

        return response()->json([
            'success' => true,
            'message' => 'Citas obtenidas exitosamente',
            'data' => $citas
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/citas",
     *     summary="Crear una nueva cita",
     *     description="Crea una nueva cita para el usuario autenticado",
     *     operationId="storeCita",
     *     tags={"Citas"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Datos de la cita",
     *         @OA\JsonContent(
     *             required={"fecha","hora","servicios"},
     *             @OA\Property(property="fecha", type="string", format="date", example="2025-11-20"),
     *             @OA\Property(property="hora", type="string", format="time", example="10:00"),
     *             @OA\Property(
     *                 property="servicios",
     *                 type="array",
     *                 @OA\Items(type="integer", example=1),
     *                 description="IDs de los servicios"
     *             ),
     *             @OA\Property(property="notas", type="string", example="Preferencia de estilista")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Cita creada exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Cita creada exitosamente"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=10),
     *                 @OA\Property(property="fecha", type="string", example="2025-11-20"),
     *                 @OA\Property(property="total", type="number", example=150.00)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="No autenticado"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
            'servicios' => 'required|array|min:1',
            'servicios.*' => 'exists:servicios,id',
            'notas' => 'nullable|string|max:500'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            // Verificar disponibilidad
            $existe = Cita::where('fecha', $request->fecha)
                          ->where('hora', $request->hora)
                          ->whereIn('estado', ['pendiente', 'confirmada'])
                          ->exists();

            if ($existe) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ya existe una cita en ese horario'
                ], 422);
            }

            // Obtener servicios y calcular total
            $servicios = Servicio::whereIn('id', $request->servicios)->get();
            $total = $servicios->sum('precio');

            // Crear cita
            $cita = Cita::create([
                'user_id' => $request->user()->id,
                'fecha' => $request->fecha,
                'hora' => $request->hora,
                'total' => $total,
                'estado' => 'pendiente',
                'notas' => $request->notas
            ]);

            // Asociar servicios
            foreach ($servicios as $servicio) {
                $cita->servicios()->attach($servicio->id, [
                    'precio' => $servicio->precio
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Cita creada exitosamente',
                'data' => $cita->load('servicios')
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la cita',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/citas/{id}",
     *     summary="Obtener detalles de una cita",
     *     description="Obtiene los detalles de una cita específica",
     *     operationId="showCita",
     *     tags={"Citas"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la cita",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Cita encontrada"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cita no encontrada"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="No autorizado"
     *     )
     * )
     */
    public function show(Request $request, $id)
    {
        $cita = Cita::with('servicios')->find($id);

        if (!$cita) {
            return response()->json([
                'success' => false,
                'message' => 'Cita no encontrada'
            ], 404);
        }

        // Verificar que la cita pertenezca al usuario
        if ($cita->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'No tienes permiso para ver esta cita'
            ], 403);
        }

        return response()->json([
            'success' => true,
            'message' => 'Cita encontrada',
            'data' => $cita
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/citas/{id}",
     *     summary="Cancelar una cita",
     *     description="Cancela una cita del usuario autenticado",
     *     operationId="destroyCita",
     *     tags={"Citas"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la cita",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Cita cancelada exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cita no encontrada"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="No autorizado"
     *     )
     * )
     */
    public function destroy(Request $request, $id)
    {
        $cita = Cita::find($id);

        if (!$cita) {
            return response()->json([
                'success' => false,
                'message' => 'Cita no encontrada'
            ], 404);
        }

        if ($cita->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'No tienes permiso para cancelar esta cita'
            ], 403);
        }

        $cita->update(['estado' => 'cancelada']);

        return response()->json([
            'success' => true,
            'message' => 'Cita cancelada exitosamente'
        ], 200);
    }
}