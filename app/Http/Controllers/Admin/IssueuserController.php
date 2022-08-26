<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Issue;
use App\Models\IssueUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IssueuserController extends Controller
{
    public function index()
    {
        if(Auth::user()->is_admin == 1){
        $issues = Issue::with('issueUser')->paginate(5);
      
        return view('admin.user.index',['issues'=>$issues]);
        }
    }

    public function delete($issue_id , $user_id)
    {
        $issue_user = IssueUser::where('issue_id',$issue_id)->where('user_id',$user_id);
        $issue_user->delete();

        return response()->json([
        'success' => 'Record deleted successfully!'
        ]);
    }

}
