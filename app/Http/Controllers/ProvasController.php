<?php

namespace App\Http\Controllers;

use App\Models\Provas;
use App\Http\Requests\StoreProvasRequest;
use App\Http\Requests\UpdateProvasRequest;

class ProvasController extends Controller
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
     * @param  \App\Http\Requests\StoreProvasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProvasRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provas  $provas
     * @return \Illuminate\Http\Response
     */
    public function show(Provas $provas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provas  $provas
     * @return \Illuminate\Http\Response
     */
    public function edit(Provas $provas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProvasRequest  $request
     * @param  \App\Models\Provas  $provas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProvasRequest $request, Provas $provas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provas  $provas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provas $provas)
    {
        //
    }
}
