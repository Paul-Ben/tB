<?php

namespace App\Http\Controllers;

use App\Models\ClassCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ManagerClassCategoryController extends Controller
{
    /**
     * Display a listing of class categories.
     */
    public function index(Request $request): View
    {
        $query = ClassCategory::query()->withCount('classrooms');

        if ($request->filled('search')) {
            $query->search($request->get('search'));
        }

        $categories = $query->orderBy('name')->paginate(15)->appends($request->query());

        return view('manager.class-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new class category.
     */
    public function create(): View
    {
        return view('manager.class-categories.create');
    }

    /**
     * Store a newly created class category in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            'abbreviation' => ['required', 'string', 'max:10', 'unique:class_categories,abbreviation'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        ClassCategory::create($validator->validated());

        return redirect()->route('manager.class-categories.index')
            ->with('success', 'Class category created successfully.');
    }

    /**
     * Display the specified class category.
     */
    public function show(ClassCategory $classCategory): View
    {
        $classCategory->loadCount('classrooms');
        $classrooms = $classCategory->classrooms()->orderBy('name')->paginate(10);

        return view('manager.class-categories.show', compact('classCategory', 'classrooms'));
    }

    /**
     * Show the form for editing the specified class category.
     */
    public function edit(ClassCategory $classCategory): View
    {
        return view('manager.class-categories.edit', compact('classCategory'));
    }

    /**
     * Update the specified class category in storage.
     */
    public function update(Request $request, ClassCategory $classCategory): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            'abbreviation' => [
                'required', 'string', 'max:10',
                Rule::unique('class_categories', 'abbreviation')->ignore($classCategory->id),
            ],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $classCategory->update($validator->validated());

        return redirect()->route('manager.class-categories.index')
            ->with('success', 'Class category updated successfully.');
    }

    /**
     * Remove the specified class category from storage.
     */
    public function destroy(ClassCategory $classCategory): RedirectResponse
    {
        if ($classCategory->classrooms()->exists()) {
            return redirect()->route('manager.class-categories.index')
                ->with('error', 'Cannot delete a category that has classrooms associated.');
        }

        $classCategory->delete();

        return redirect()->route('manager.class-categories.index')
            ->with('success', 'Class category deleted successfully.');
    }
}