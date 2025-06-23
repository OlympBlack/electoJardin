<?php

namespace App\Http\Controllers;

use App\Models\newsletter;
use Illuminate\Http\Request;

class newsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newsletters = Newsletter::latest('id')->paginate();
        return view('backend.newsletter.index', compact('newsletters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:newsletter,email',
        ]);

        Newsletter::create([
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Merci pour votre inscription à la newsletter');
    }

    /**
     * Display the specified resource.
     */
    public function show(newsletter $newsletter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(newsletter $newsletter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, newsletter $newsletter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $newsletter = newsletter::find($id);

        if (!$newsletter) {
            return redirect()->back()->with('error', 'newsletter not found');
        }

        $status = $newsletter->delete();

        $message = $status
            ? 'newsletter successfully deleted'
            : 'Error, Please try again';

        return redirect()->route('newsletter.index')->with(
            $status ? 'success' : 'error',
            $message
        );
    }
}
