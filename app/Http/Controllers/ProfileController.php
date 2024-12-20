<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Request as RequestModel;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function index(Request $request)
    {
        // Получаем ID текущего пользователя
        $userId = Auth::id();

        // Проверяем роль пользователя
        if (Auth::user()->role === 'admin') {
            // Администратор видит все заявки
            $bookedTours = RequestModel::with(['tour', 'user'])->get();
        } else {
            // Обычный пользователь видит только свои заявки
            $bookedTours = RequestModel::where('user_id', $userId)
                ->with('tour') // Подгружаем связанные туры
                ->get();
        }

        // Фильтрация по туру (если указан tour_id в запросе)
        if ($request->has('tour_id')) {
            $bookedTours = $bookedTours->where('tour_id', $request->tour_id);
        }

        return view('profile.index', compact('bookedTours'));
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

        return Redirect::route('profile.index')->with('status', 'profile-updated');
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
