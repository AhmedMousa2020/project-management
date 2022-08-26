<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Issue;
use App\Models\IssueUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreIssueRequest;

class IssueController extends Controller
{
    
    /**
     * Display a listing of the issues across Api.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $issues = Issue::with('issueUser')->paginate(5);
            return response()->json($issues);
    }

}
