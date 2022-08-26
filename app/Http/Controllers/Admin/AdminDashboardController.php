<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Issue;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function dashboard() {
        $projects_count = Project::count();
        $users_count = User::count();
        $issues = Issue::all();
        $open_issues = [];
        $closed_issues = [];
        $issues->each(function ($issue) use (&$open_issues, &$closed_issues) {
            $issue->status == 1 ? array_push($open_issues, $issue) : array_push($closed_issues, $issue);
        });
        
    if(Auth::user()->is_admin == 1){
        return view('admin.dashboard', [
            'projects_count' => $projects_count,
            'users_count' => $users_count,
            'open_issues' => count($open_issues),
            'closed_issues' => count($closed_issues)
        ]);
    }else{
        return 'your are not authinticate please login as Admin to see this page';
    }
    }
}
