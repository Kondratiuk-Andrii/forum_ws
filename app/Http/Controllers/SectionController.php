<?php

namespace App\Http\Controllers;

use App\Http\Requests\Section\StoreRequest;
use App\Http\Requests\Section\UpdateRequest;
use App\Http\Resources\Branch\BranchResource;
use App\Http\Resources\Section\SectionResource;
use App\Http\Resources\Section\SectionWithBranchesResource;
use App\Models\Branch;
use App\Models\Section;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::with('branches')->get();

        return inertia('Section/Index', [
            'sections' => SectionWithBranchesResource::collection($sections),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Section/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Section::firstOrCreate($data);

        return redirect()->route('sections.index')
            ->with('message', ['icon' => 'success', 'title' => "Section {$data['title']} was created successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        return inertia('Section/Edit', [
            'section' => SectionResource::make($section),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Section $section)
    {

        $data = $request->validated();
        $section->update($data);

        return redirect()->route('sections.index')
            ->with('message', ['icon' => 'success', 'title' => "Section {$section->title} was updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        $section->delete();

        return redirect()->back()
            ->with('message', ['icon' => 'success', 'title' => "Section {$section->title} was deleted successfully"]);
    }

    public function branchIndex(Section $section)
    {
        return BranchResource::collection($section->branches->whereNull('parent_id'));
    }

    public function branchIndexExcept(Section $section, Branch $branch)
    {
        $branches = $section->branches()
            ->where('id', '!=', $branch->id)
            ->whereNull('parent_id')
            ->get();

        return BranchResource::collection($branches);
    }
}
