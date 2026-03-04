<?php
namespace App\Http\Controllers;

use App\Models\Project;

class HomeController extends Controller
{
    public function index()
    {
        // Only featured projects
        $allProjects = Project::where('is_featured', 1)
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        $totalProjects = Project::count(); // total projects, still count all

        return view('pages.home', compact('allProjects', 'totalProjects'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function skills()
    {
        return view('pages.skills');
    }
}