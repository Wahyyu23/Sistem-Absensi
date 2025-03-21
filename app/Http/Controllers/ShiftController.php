<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entity\Shift;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $shiftName = $request->input('shiftName');
        $shiftStart = $request->input('shiftStart');
        $shiftEnd = $request->input('shiftEnd');

        $shift = app()->make(Shift::class, [
            'shiftName' => $shiftName,
            'shiftStart' => $shiftStart,
            'shiftEnd' => $shiftEnd
        ]);

        return response()->json(
            [
                'message' => 'Shift has been registered',
                'data' => $shift,
            ],201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
