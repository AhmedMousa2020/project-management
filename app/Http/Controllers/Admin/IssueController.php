<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Issue;
use App\Models\IssueUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreIssueRequest;

class IssueController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->is_admin == 1){
            $issues = Issue::with('issueUser')->orderBy('created_at', 'DESC')->paginate(5);
      
            return view('admin.issues.index',['issues'=>$issues]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $issue = new Issue();

        return view('admin.issues.create', ['issue' => $issue]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\StoreIssueRequest for validata and follow  Single Responsibility Principle
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIssueRequest $request)
    {
        $issue = new Issue();
        
        $issue->title =  $request->title;
        $issue->description =  $request->description;
        $issue->user_id =  Auth::user()->id;
        $issue->number = 1;
        $issue->stage_id = 1;
        $issue->project_id =  $request->project;
        $issue->save();

        $assigne_numbers = $request->assigned;
        $this->storeUserIssueRelationship($assigne_numbers,$issue); //Single Responsibility Principle
    
        return redirect('issues')->with('status', 'Success: Issue Created');
    }


     /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\IssueUser $issue
     * @return void
     */
    public function storeUserIssueRelationship($assigne_numbers,$issue){
        if(is_array($assigne_numbers)){
            foreach($assigne_numbers as $number){
                $check_user =IssueUser::where('user_id',$number)->where('issue_id',$issue->id)->first(); 
                if(empty($check_user)){
                    $issueuser = new IssueUser();
                    $issueuser->user_id =$number;
                    $issueuser->issue_id = $issue->id;
                    $issueuser->save();
                }
            }
        }
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function edit(Issue $issue)
    {
        $issue = Issue::findOrFail($issue->id);

        return view('admin.issues.create', ['issue' => $issue]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\StoreIssueRequest for validata and follow  Single Responsibility Principle
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function update(StoreIssueRequest $request, Issue $issue )
    {
        $assigne_numbers = $this->getUserAssigned($request,$issue); //Single Responsibility Principle

        $issue->title =  $request->title;
        $issue->description =  $request->description;
        $issue->user_id =  Auth::user()->id;
        $issue->number = is_array($assigne_numbers)?count($assigne_numbers):$assigne_numbers;
        $issue->stage_id = 1;
        $issue->project_id =  $request->project;
        $issue->save();

        $this->storeUserIssueRelationship($assigne_numbers,$issue); //Single Responsibility Principle

        return redirect('issues')->with('status', 'Success: issue Updated!');
    }

    /**
     * get the assignees users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Issue  $issue
     * @return user_assigne_id
     */
     public function getUserAssigned($request,$issue){
        $issue_id = $issue->id;
        if(!empty($request->assigned)){
            $assigne_numbers = $request->assigned;
        }else{
            $assigne_numbers = Issue::where('id', $issue_id)->pluck('number')->first();
        }

        return  $assigne_numbers;
     }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Issue $issue)
    {
        $issue->delete();
        return redirect('issues')->with('status', 'Success: issue Deleted!');
    }
}
