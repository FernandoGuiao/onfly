<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDespesaRequest;
use App\Http\Requests\UpdateDespesaRequest;
use App\Http\Resources\DespesaDefaultResource;
use App\Models\Despesa;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DespesaController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Despesa::class, null, [
            'except' => ['store']
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $despesas = Despesa::filterUser()->paginate();
        return response(new DespesaDefaultResource($despesas), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDespesaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDespesaRequest $request)
    {
        $this->authorize('create', [Despesa::class, $request]);
        DB::beginTransaction();
        try {
            $despesa = Despesa::create($request->all());
            $despesa->sendNotification();
            DB::commit();
            return response(new DespesaDefaultResource($despesa), 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response(["message" => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function show(Despesa $despesa)
    {
        return response(new DespesaDefaultResource($despesa), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDespesaRequest  $request
     * @param  \App\Models\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDespesaRequest $request, Despesa $despesa)
    {
        DB::beginTransaction();
        try {
            $despesa->update($request->all());
            DB::commit();
            return response(new DespesaDefaultResource($despesa), 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response(["message" => $e->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Despesa $despesa)
    {
        DB::beginTransaction();
        try {
            $despesa->delete();
            DB::commit();
            return response(["message" => "Despesa removida com sucesso"], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response(["message" => $e->getMessage()], 400);
        }
    }
}
