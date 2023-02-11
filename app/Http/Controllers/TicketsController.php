<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketsController extends Controller
{
    public function find()
    {
        try {
            return response()->json([
                "status" => true,
                "message" => "Tickets consultados con exito",
                "data" => Ticket::get()
            ]);
        } catch (\Throwable $th) {
            return response()->json([$th], 400);
        }
    }

    public function paginate(Request $request){
        try {
            $pageSize = Ticket::query()->paginate($request->page_size);
            return response()->json([
                "status" => true,
                "message" => "Tickets consultados con exito",
                "data" => $pageSize
            ]);
        } catch (\Throwable $th) {
            return response()->json([$th], 400);
        }
    }
    public function save(Request $request)
    {
        try {

            $validated = Validator::make($request->all(), [
                'user_name' => 'required',
                'status' => 'required'
            ]);

            if ($validated->fails()) {
                return response()->json(["errors" => $validated->errors()->all()], 400);
            }

            $status = strtolower($request->status);

            if ($status != "abierto" && $status != "cerrado") {
                return [
                    "errors" => "Porfavor ingrese un estado valido abierto y/o cerrado"
                ];
            }

            return response()->json([
                "status" => true,
                "message" => "¡Ticket creado correctamente!",
                "grupos" => Ticket::create([
                    'user_name' => $request->user_name,
                    'status' => $status
                ]),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([$th], 400);
        }
    }

    public function update($tickets_id, Request $request)
    {
        try {
            $validated = Validator::make($request->all(), [
                'user_name' => 'required',
                'status' => 'required'
            ]);

            if ($validated->fails()) {
                return response()->json(["errors" => $validated->errors()->all()], 400);
            }

            $status = strtolower($request->status);

            if ($status != "abierto" && $status != "cerrado") {
                return [
                    "errors" => "Porfavor ingrese un estado valido abierto y/o cerrado"
                ];
            }

            Ticket::where('tickets_id', $tickets_id)
                ->update([
                    'user_name' => $request->user_name,
                    'status' => $request->status,
                ]);

            return response()->json([
                "status" => true,
                "message" => "¡Ticket $request->user_name modificado correctamente!",
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([$th], 400);
        }
    }
    public function find_byId($tickets_id)
    {
        if (!$this->validated_existence($tickets_id)) {
            return response()->json([
                "status" => false,
                "message" => "El ticket que intentas buscar no existe."
            ], 400);
        }
        return response()->json([
            "status" => true,
            "message" => "Ticket consultados con exito",
            "data" => Ticket::where('tickets_id', $tickets_id)->first()->getAttributes()
        ]);
    }
    public function delete($tickets_id)
    {
        try {
            if (!$this->validated_existence($tickets_id)) {
                return response()->json([
                    "message" => "El Ticket que deseas eliminar no existe"
                ]);
            }
            $ticket = Ticket::where('tickets_id', $tickets_id);
            $ticket_selected = $ticket->first()->getAttributes();
            $ticket->delete();
            return response()->json([
                "status" => true,
                "message" => "Ticket eliminado con exito",
                "data" => $ticket_selected
            ]);
        } catch (\Throwable $th) {
            return response()->json([$th], 400);
        }
    }

    private function validated_existence($tickets_id)
    {
        return Ticket::where('tickets_id', '=', $tickets_id)->first() ? true : false;
    }
}
