<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) {
            return view('admin.feedbacks.index');
        }

        return Feedback::dataTable(Feedback::query());
    }

    public function show(Request $request, Feedback $feedback)
    {
        return view('admin.feedbacks.show', compact('feedback'));
    }

    public function destroy(Request $request, Feedback $feedback)
    {
        $feedback->delete();

        return $this->jsonSuccess('Feedback deleted successfully');
    }
}
