<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Issue;
use App\Models\Project;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard() {
        $projects_count = Project::count();
        $users_count = User::count();
        $issues = Issue::all();
        $open_issues = [];
        $closed_issues = [];
        $issues->each(function ($issue) use (&$open_issues, &$closed_issues) {
            $issue->status == 1 ? array_push($open_issues, $issue) : array_push($closed_issues, $issue);
        });

        return view('user.dashboard', [
            'projects_count' => $projects_count,
            'users_count' => $users_count,
            'open_issues' => count($open_issues),
            'closed_issues' => count($closed_issues)
        ]);
    }
}
