<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        // Data dummy untuk pengaturan
        $settings = [
            'notifications' => [
                'email_new_books' => true,
                'email_due_reminder' => true,
                'email_overdue_alert' => true,
                'sms_notifications' => false,
            ],
            'privacy' => [
                'profile_visible' => true,
                'show_borrowed_books' => true,
                'allow_recommendations' => true,
            ],
            'preferences' => [
                'theme' => $user->theme ?? 'light',
                'language' => $user->language ?? 'id',
                'items_per_page' => $user->items_per_page ?? 10,
            ],
        ];

        return view('pengaturan', compact('user', 'settings'));
    }

    public function update()
    {
        $validated = request()->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'theme' => 'nullable|in:light,dark,auto',
            'language' => 'nullable|in:id,en,es',
            'items_per_page' => 'nullable|in:10,20,50',
        ]);

        $user = Auth::user();
        
        // Update user profile
        if (isset($validated['name'])) {
            $user->name = $validated['name'];
        }
        if (isset($validated['email'])) {
            $user->email = $validated['email'];
        }
        
        // Update preferences
        if (isset($validated['theme'])) {
            $user->theme = $validated['theme'];
        }
        if (isset($validated['language'])) {
            $user->language = $validated['language'];
        }
        if (isset($validated['items_per_page'])) {
            $user->items_per_page = $validated['items_per_page'];
        }
        
        $user->save();

        session()->flash('success', 'Pengaturan berhasil diperbarui!');

        return redirect()->route('settings');
    }

    public function updatePassword()
    {
        $validated = request()->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);

        // Simulate password update
        session()->flash('success', 'Password berhasil diubah!');

        return redirect()->route('settings');
    }
}
