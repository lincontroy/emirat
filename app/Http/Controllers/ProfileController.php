<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

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
     * Handle KYC submission
     */
    public function submitKYC(Request $request): RedirectResponse
    {
        $request->validate([
            'id_front' => 'required|file|mimes:jpeg,png,jpg|max:2048',
            'id_back' => 'required|file|mimes:jpeg,png,jpg|max:2048',
            'selfie' => 'required|file|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = $request->user();

        // Store ID front
        if ($request->hasFile('id_front')) {
            $idFrontPath = $request->file('id_front')->store('kyc_documents/' . $user->id, 'public');
            $user->id_front_path = $idFrontPath;
        }

        // Store ID back
        if ($request->hasFile('id_back')) {
            $idBackPath = $request->file('id_back')->store('kyc_documents/' . $user->id, 'public');
            $user->id_back_path = $idBackPath;
        }

        // Store selfie
        if ($request->hasFile('selfie')) {
            $selfiePath = $request->file('selfie')->store('kyc_documents/' . $user->id, 'public');
            $user->selfie_path = $selfiePath;
        }

        $user->kyc_status = 'pending'; // Set KYC status to pending
        $user->save();

        return Redirect::route('kyc')->with('status', 'kyc-submitted');
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
}