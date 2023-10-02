<?php

namespace App\Http\Controllers;

use App\Models\Prompt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PromptController extends Controller
{
    public function index()
    {
        try {
            $prompts = Prompt::paginate(10); // Fetch prompts with pagination

            return Inertia::render('Prompt/Index', [
                'prompts' => $prompts,
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return Inertia::render('Prompt/Create');
    }

    public function store(Request $request)
    {
        try {
            Prompt::create([
                'prompt' => $request->input('prompt'),
                'prompt_level' => $request->input('prompt_level'),
                'prompt_type' => $request->input('prompt_type'),
            ]);

            return redirect()->route('prompt.index')->with('success', 'Prompt created successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function perform(Prompt $prompt)
    {
        return Inertia::render('Prompt/Perform', [
            'prompt' => $prompt,
        ]);
    }

    public function execute(Prompt $prompt, Request $request)
    {
        try {
            return DB::connection('honeypot')->select($request->get('query'));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function edit(Prompt $prompt)
    {
        return Inertia::render('Prompt/Edit', [
            'prompt' => $prompt,
        ]);
    }

    public function update(Request $request, Prompt $prompt)
    {
        try {
            $prompt->update([
                'prompt' => $request->input('prompt'),
                'prompt_level' => $request->input('prompt_level'),
                'prompt_type' => $request->input('prompt_type'),
            ]);

            return redirect()->route('prompt.index')->with('success', 'Prompt updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy(Prompt $prompt)
    {
        try {
            $prompt->delete();

            return redirect()->route('prompt.index')->with('success', 'Prompt deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
