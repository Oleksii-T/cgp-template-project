<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\FeedbackRequest;
use App\Models\Feedback;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackMail;
use App\Models\Page;

class FeedbackController extends Controller
{
    public function index()
    {
        $page = Page::get('contact-us');

        return view('feedbacks.index', compact('page'));
    }

    public function store(FeedbackRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();
        $data['user_id'] = $user->id??null;
        $feedback = Feedback::create($data);

        if (Setting::get('email_feedback')) {
            Mail::to(Setting::get('email_feedback_to'))->send(new FeedbackMail($feedback));
        }

        return $this->jsonSuccess('Feedback send successfully', [
            'redirect' => route('feedbacks.index')
        ]);
    }
}
