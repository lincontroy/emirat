<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Mail\NewKYCSubmissionNotification;
use Mail;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

     public function support(){
        return view('support');
     }
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

        dd($request);
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
    
        // Store files
        $user->update([
            'id_front_path' => $request->file('id_front')->store('kyc_documents/'.$user->id, 'public'),
            'id_back_path' => $request->file('id_back')->store('kyc_documents/'.$user->id, 'public'),
            'selfie_path' => $request->file('selfie')->store('kyc_documents/'.$user->id, 'public'),
            'kyc_status' => 'pending',
            'kyc_submitted_at' => now(),
        ]);
    
        // Send notification to admin
        $adminEmails = [
            'lincolnmunene37@gmail.com',
            'info@emiratefunds.com'       
        ];
    
        // Filter out any empty values just in case
        $adminEmails = array_filter($adminEmails);
    
        if (!empty($adminEmails)) {
            Mail::to(config('mail.from.address')) // Main recipient
                ->bcc($adminEmails) // Blind copy to all admins
                ->send(new NewKYCSubmissionNotification($user));
        }
    
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