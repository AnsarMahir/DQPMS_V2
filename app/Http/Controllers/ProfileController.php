<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Pastpaper;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function processForm(Request $request)
    {
        // if ($request->getMethod() === 'GET' && $request->route()->getName() === 'process-form') {
        //     // Redirect to a different route or URL
        //     return redirect()->route('home')->with('error', 'GET method is not supported for process-form route.');
        // }
        // Retrieve submitted data
        $validated = $request->validate([
            'exam' => 'required',
            'questiontype' => 'required',
            'qnature' => 'required',
            'language' => 'required',
            'noofq' => 'required',

        ]);
        $selectedValues = $request->only(['exam', 'questiontype', 'qnature', 'language', 'noofq']);
        //add user ID with the retrieved data
        $selectedValues['user_id'] = Auth::id();

        return view('PaperDetails')->with('selectedValues', $selectedValues);
    
}

}
