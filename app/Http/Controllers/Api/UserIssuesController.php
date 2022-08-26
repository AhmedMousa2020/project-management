<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Issue;
use App\Models\IssueUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProjectRequest;

class UserIssuesController extends Controller
{
    
    /**
     * Display a listing of the issues that belong to user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id =$request->user_id;
        
        $issues = Issue::with('issueUser')->where('user_id',$id)->get();
       
        return response()->json($issues);
        
    }


}
