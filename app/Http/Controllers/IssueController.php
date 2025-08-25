<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IssueController extends Controller
{
    public function index()
    {
        $issues = Issue::where('user_id', Auth::id())->latest()->get();
        return view('dashboard', compact('issues'));
    }

    // Show create form
    public function create()
    {
        return view('issues.create');
    }

    // Store new issue
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:open,in_progress,resolved',
            'priority' => 'required|in:low,medium,high',
        ]);

        Issue::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'priority' => $request->priority,
        ]);

        return redirect()->route('issues.index')->with('success', 'Issue created successfully.');
    }

    // Show a single issue
    public function show(Issue $issue)
    {
        $this->authorizeIssue($issue);
        return view('issues.show', compact('issue'));
    }

    // Show edit form
    public function edit(Issue $issue)
    {
        $this->authorizeIssue($issue);
        return view('issues.edit', compact('issue'));
    }

    // Update issue
    public function update(Request $request, Issue $issue)
    {
        $this->authorizeIssue($issue);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:open,in_progress,resolved',
            'priority' => 'required|in:low,medium,high',
        ]);

        $issue->update($request->only('title', 'description', 'status', 'priority'));

        return redirect()->route('issues.index')->with('success', 'Issue updated successfully.');
    }

    // Delete issue
    public function destroy(Issue $issue)
    {
        $this->authorizeIssue($issue);
        $issue->delete();
        return redirect()->route('issues.index')->with('success', 'Issue deleted successfully.');
    }

    // Ensure the issue belongs to the logged-in user
    private function authorizeIssue(Issue $issue)
    {
        if ($issue->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }
    public function updateStatus(Request $request, Issue $issue)
    {
        $request->validate([
            'status' => 'required|in:open,in_progress,resolved,closed',
        ]);

        $issue->update(['status' => $request->status]);

        return response()->json(['message' => 'Status updated successfully.']);
    }

}
