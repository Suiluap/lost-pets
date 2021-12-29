<?php

namespace App\Http\Controllers;

use File;
use App\Models\Save;
use App\Models\Report;
use App\Models\Status;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    public function index(){
        return view('reports.main');
    }

    public function listIndex(Status $status)
    {
        $reports = $status->reports()->latest()->paginate(9);
        return view('reports.list', ['reports' => $reports, 'status' => $status]);
    }

    public function myIndex()
    {
        $reports = Auth::user()->reports()->latest()->paginate(9);
        return view('reports.list', ['reports' => $reports]);
    }

    public function reportIndex(Report $report)
    {
        $comments = $report->comments()->latest()->paginate(5);
        return view('reports.report', ['report' => $report, 'comments' => $comments]);
    }

    public function addIndex()
    {
        $statuses = Status::all();
        return view('reports.add', ['statuses' => $statuses]);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'status' => 'required',
            'picture' => 'required|image|max:2048',
            'description' => 'required|max:9999',
            'address' => 'required|max:255',
            'date' => 'required|date'
        ]);

        $pictureName = time().'.'.$request->picture->extension();
        $request->picture->move(public_path('pictures/'.Auth::id()), $pictureName);

        $report = Report::create([
            'name' => $request->name,
            'status_id' => $request->status,
            'picture' => $pictureName,
            'description' => $request->description,
            'address' => $request->address,
            'date' => $request->date,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('report', $report);
    }

    public function editReportIndex(Report $report)
    {
        if($report->ownedByUser() || auth()->user()->isAdmin())
        {
            $statuses = Status::all();
            return view('reports.edit', ['report' => $report, 'statuses' => $statuses]);
        }
        else
        {
            abort(403);
        }
    }

    public function editReport(Report $report, Request $request)
    {
        if($report->ownedByUser() || auth()->user()->isAdmin())
        {
            $this->validate($request, [
                'name' => 'required|max:255',
                // 'status' => 'required|in:1,2,3',
                'status' => 'required',
                'picture' => 'image|max:2048',
                'description' => 'required|max:9999',
                'address' => 'required|max:255',
                'date' => 'required|date'
            ]);

            if($request->picture != null)
            {
                $request->picture->move(public_path('pictures/'.Auth::id()), $report->picture);
            }

            $report->update([
                'name' => $request->name,
                'status_id' => $request->status,
                'description' => $request->description,
                'address' => $request->address,
                'date' => $request->date
            ]);

            return redirect()->route('report', $report);
        }
        else
        {
            abort(403);
        }
    }

    public function deleteReport(Report $report)
    {
        if ($report->ownedByUser() || auth()->user()->isAdmin()){
            File::delete(public_path("pictures/$report->user_id/$report->picture"));
            $report->delete();

            return redirect()->route('my')->with('status','Skelbimas pašalintas sėkmingai');
        }
        else{
            abort(403);
        }
    }

    public function savedIndex()
    {
        $saves = Save::where('user_id', Auth::user()->id)->get('report_id')->toArray();
        $reports = Report::whereIn('id', $saves)->latest()->paginate(9);

        return view('reports.list', ['reports' => $reports]);
    }

    public function saveReport(Report $report)
    {
        Save::create([
            'user_id' => Auth::user()->id,
            'report_id' => $report->id
        ]);

        return back();
    }

    public function forgetReport(Report $report)
    {
        if($report->savedbyUser())
        {
            $report->saves()->where('user_id', Auth::user()->id)->delete();
            return back();
        }
        else
        {
            abort(403);
        }
    }

    public function comment(Report $report, Request $request)
    {
        $this->validate($request, [
            'comment' => 'required|max:999'
        ]);

        Comment::create([
            'text' => $request->comment,
            'user_id' => Auth::user()->id,
            'report_id' => $report->id
        ]);

        return back();
    }

    public function deleteComment(Report $report, Comment $comment)
    {
        if ($comment->ownedByUser() || $report->ownedByUser() || auth()->user()->isAdmin())
        {
            $comment->delete();
            return back();
        }
        else{
            abort(403);
        }
    }

    public function commentIndex(Report $report, Comment $comment)
    {
        if ($comment->ownedByUser() || $report->ownedByUser() || auth()->user()->isAdmin())
        {
            return view('reports.comment', ['report' => $report, 'comment' => $comment]);
        }
        else{
            abort(403);
        }
    }

    public function editComment(Request $request, Report $report, Comment $comment)
    {
        if ($comment->ownedByUser() || $report->ownedByUser() || auth()->user()->isAdmin())
        {
            $this->validate($request, [
                'comment' => 'required|max:999'
            ]);

            $comment->update([
                'text' => $request->comment
            ]);

            return redirect()->route('report', ['report' => $report]);
        }
        else{
            abort(403);
        }
    }

    public function statusesIndex()
    {
        $statuses = Status::all()->sortBy('id');
        return view('reports.statuses', ['statuses' => $statuses]);
    }

    public function deleteStatus(Status $status)
    {
        if (auth()->user()->isAdmin()){
            $status->delete();

            return back();
        }
        else{
            abort(403);
        }
    }

    public function addStatusIndex()
    {
        return view('reports.statusAdd');
    }

    public function addStatus(Request $request)
    {
        if (auth()->user()->isAdmin()){
            $this->validate($request, [
                'status' => 'required|max:255'
            ]);

            Status::create([
                'name' => $request->status,
            ]);

            return redirect()->route('statuses');
        }
        else{
            abort(403);
        }
    }

    public function statusIndex(Status $status)
    {
        return view('reports.statusEdit', ['status' => $status]);
    }

    public function editStatus(Request $request, Status $status)
    {
        if (auth()->user()->isAdmin()){
            $this->validate($request, [
                'status' => 'required|max:255'
            ]);

            $status->update([
                'name' => $request->status,
            ]);

            return redirect()->route('statuses');
        }
        else{
            abort(403);
        }
    }
}
