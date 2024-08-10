<?php

namespace App\Http\Controllers;

use App\Http\Requests\Branch\StoreRequest;
use App\Http\Requests\Branch\UpdateRequest;
use App\Http\Resources\Branch\BranchResource;
use App\Http\Resources\Branch\BranchWithChildrenResource;
use App\Http\Resources\Section\SectionResource;
use App\Http\Resources\Section\SectionWithBranchesResource;
use App\Models\Branch;
use App\Models\Section;

class BranchController extends Controller
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
        $sections = Section::all();

        return inertia('Branch/Create', [
            'sections' => SectionResource::collection($sections),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        $data = $request->validated();
        Branch::firstOrCreate($data);

        return redirect()->route('sections.index')
            ->with('message', ['icon' => 'success', 'title' => 'Branch created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        return inertia('Branch/Show', [
            'branch' => BranchWithChildrenResource::make($branch),
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {

        return inertia('Branch/Edit', [
            'branch' => BranchResource::make($branch),
            'sections' => $branch->parent_id ? SectionWithBranchesResource::collection(Section::all()) : SectionResource::collection(Section::all()),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Branch $branch)
    {
        $data = $request->validated();
        $branch->update($data);

        return redirect()->route('branches.show', $branch->id)
            ->with('message', ['icon' => 'success', 'title' => 'Branch updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();

        return redirect()->route('sections.index')
            ->with('message', ['icon' => 'success', 'title' => 'Branch deleted successfully']);
    }

    /**
     * Create theme inside branch
     */
    public function themeCreate(Branch $branch)
    {
        // TODO: Theme create
    }
}
