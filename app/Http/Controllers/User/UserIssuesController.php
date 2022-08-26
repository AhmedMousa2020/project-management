<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Issue;
use App\Models\IssueUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProjectRequest;

class UserIssuesController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        
        $issues = Issue::with('issueUser')->where('user_id',$id)->get();
       
        return view('user.issues.index',['issues'=>$issues]);
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $issue = Issue::findOrFail($id);
        $project = Issue::where('project_id',$issue->project_id)->first()->project;
        return view('user.issues.submit', ['issue' => $issue,'project'=>$project]);
        
    }

}
