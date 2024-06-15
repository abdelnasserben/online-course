<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Topic;
use App\Models\Tutorial;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function courses(Request $request)
    {
        $query = Course::query();

        // Filtre par Topic
        if ($request->has('topic')) {
            $topics = explode(',', $request->input('topic')); // Transformer les clés séparées par des virgules en tableau
            $query->whereIn('topic_id', $topics);
        }

        // Filtre par Niveau
        if ($request->has('level')) {
            $levels = explode(',', $request->input('level'));
            $query->whereIn('level', $levels);
        }

        // Filtre par Type (gratuit/premium)
        if ($request->has('type')) {
            $types = explode(',', $request->input('type'));
            if (in_array('gratuit', $types) && in_array('premium', $types)) {
                //on applique aucun filtre
            } elseif (in_array('premium', $types)) {
                $query->where('is_premium', true);
            } else {
                $query->where('is_premium', false);
            }
        }

        // Recherche par mot-clé
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->input('search') . '%');
        }

        $courses = $query->orderBy('created_at', 'desc')->paginate(8); //$courses = $query->get(); si on veut pas de pagination
        $topics = Topic::select('id', 'name')->get();

        return view('courses.index', [
            'courses' => $courses,
            'topics' => $topics
        ]);
    }

    public function showCourse(Course $course)
    {
        return view('courses.show', [
            'course' => $course
        ]);
    }

    public function showTutorial(Course $course, Tutorial $tutorial)
    {
        //$comments = $tutorial->comments()->whereNull('parent_id')->orderBy('created_at', 'desc')->get();
        $comments = $tutorial->comments;
        return view('courses.tutorial', [
            'tutorial' => $tutorial,
            'comments' => $comments,
        ]);
    }

    public function uploadTutorialSource(Course $course, Tutorial $tutorial)
    {
        return view('courses.source', [
            'tutorial' => $tutorial
        ]);
    }
}
