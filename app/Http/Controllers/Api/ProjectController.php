<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the Projects.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $projects = Project::with('issues')->get();
            return response()->json($projects);
    }

}
