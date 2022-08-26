<?php

namespace App\Http\Controllers;

use App\Models\Transacoes;
use App\Http\Requests\StoreTransacoesRequest;
use App\Http\Requests\UpdateTransacoesRequest;

class TransacoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransacoesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransacoesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transacoes  $transacoes
     * @return \Illuminate\Http\Response
     */
    public function show(Transacoes $transacoes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transacoes  $transacoes
     * @return \Illuminate\Http\Response
     */
    public function edit(Transacoes $transacoes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransacoesRequest  $request
     * @param  \App\Models\Transacoes  $transacoes
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransacoesRequest $request, Transacoes $transacoes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transacoes  $transacoes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transacoes $transacoes)
    {
        //
    }
}
