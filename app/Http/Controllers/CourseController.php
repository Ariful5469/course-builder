<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course; // Corrected namespace
use App\Models\Module;
use App\Models\Content;

class CourseController extends Controller
{
    public function create()
    {
        return view('courses.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'feature_video' => 'nullable|string',
        'modules' => 'required|array',
        'modules.*.title' => 'required|string|max:255',
        'modules.*.contents' => 'array',
        'modules.*.contents.*.title' => 'required|string|max:255',
        'modules.*.contents.*.video_type' => 'nullable|string',
        'modules.*.contents.*.video_url' => 'nullable|string',
        'modules.*.contents.*.duration' => 'nullable|string',
    ]);

    $course = Course::create([
        'title' => $request->title,
        'feature_video' => $request->feature_video
    ]);

    foreach ($request->modules as $module) {
        $mod = $course->modules()->create([
            'title' => $module['title']
        ]);

        if (isset($module['contents'])) {
            foreach ($module['contents'] as $content) {
                $mod->contents()->create([
                    'title' => $content['title'],
                    'video_type' => $content['video_type'] ?? null,
                    'video_url' => $content['video_url'] ?? null,
                    'duration' => $content['duration'] ?? null
                ]);
            }
        }
    }

    // Redirect to welcome page (home) with success message
    return redirect()->route('welcome')->with('success', 'Course Created Successfully');
}

    // 🔹 Add show method
    public function show($id)
    {
        $course = Course::with('modules.contents')->findOrFail($id);
        return view('courses.show', compact('course'));
    }
}
