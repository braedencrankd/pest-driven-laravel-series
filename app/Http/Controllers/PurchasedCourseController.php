<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchasedCourseRequest;
use App\Http\Requests\UpdatePurchasedCourseRequest;
use App\Models\PurchasedCourse;

class PurchasedCourseController extends Controller
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
    public function store(StorePurchasedCourseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchasedCourse $purchasedCourse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchasedCourse $purchasedCourse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchasedCourseRequest $request, PurchasedCourse $purchasedCourse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchasedCourse $purchasedCourse)
    {
        //
    }
}
