<?php
 
namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Issue;
use Illuminate\Support\Facades\Auth;

class FileUploadController extends Controller
{
     /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\StoreIssueRequest for validata and follow  Single Responsibility Principle
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 
    public function store(StoreFileRequest $request)
    {
       
        $name = $request->file('file')->getClientOriginalName();
 
        $path = $request->file('file')->storeAs('public/files',$name);
 
 
        $file = new File;
 
        $file->name = $name;
        $file->comment = $request->comment;
        $file->user_id = Auth::user()->id;
        $file->path = $path;
        $file->save();

        $this->markAsDone($request->issue_id); //Single Responsibility Principle
        
        return redirect('user-issues')->with('status', 'File Has been Submited successfully');
 
    }

    /**
     * this function store user issue as submited 
     */
    public function markAsDone($issue_id){
        $issue = Issue::find($issue_id);
        $issue->stage_id = 3;
        $issue->save();
    }
}