<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TableRequest;
use App\Http\Resources\TableCollection;
use App\Http\Resources\TableResource;
use App\Models\Table;
use App\Traits\GeneratesQrCode;
use Illuminate\Http\Response;

class TableController extends Controller
{
    use GeneratesQrCode;
    /**
     * Display a listing of the resource.
     */
    public function index(): TableCollection
    {
        $this->authorize('viewAny', Table::class);
        return new TableCollection(Table::paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TableRequest $request): TableResource
    {
        $this->authorize('create',Table::class);
        $data = $request->validated();
        $table = Table::create($data);
        $this->generateQrCode($table);
        return new TableResource($table);
    }

    /**
     * Display the specified resource.
     */
    public function show(Table $table): TableResource
    {
        $this->authorize('view', $table);
        return new TableResource($table);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TableRequest $request, Table $table): TableResource
    {
        $this->authorize('update', $table);
        $data = $request->validated();
        $table->update($data);
        return new TableResource($table);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Table $table): Response
    {
        $this->authorize('delete', $table);
        $table->delete();
        return response()->noContent();
    }
}
