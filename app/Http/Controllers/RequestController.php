<?php

namespace App\Http\Controllers;

use App\Models\Request as RequestModel; // Используем псевдоним для модели Request
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Request as Requests;
use Carbon\Carbon;

class RequestController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        

        
        $tours = Requests::all();

        $tours->each(function ($tour) {
            $tour->date = Carbon::parse($tour->date);
        });
       

        return view("tours.index", compact("tours"));
    }

    /**
     * Отображает форму бронирования тура.
     *
     * @param int $tourId
     * @return \Illuminate\View\View
     */
    public function create($tourId)
    {
        // Найти тур по ID
        $tour = Tour::findOrFail($tourId);

        // Проверка, что пользователь авторизован
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Вы должны быть авторизованы для бронирования тура.');
        }

        return view('requests.create', compact('tour'));
    }

    /**
     * Сохраняет заявку на бронирование в базу данных.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Проверка, что пользователь авторизован
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Вы должны быть авторизованы для бронирования тура.');
        }

        // Валидация данных
        $validatedData = $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'number' => 'required|integer|min:1', // Количество участников
            'cost' => 'required|integer|min:0', // Стоимость
        ]);

        // Создание заявки
        RequestModel::create([
            'user_id' => Auth::id(), // ID текущего пользователя
            'tour_id' => $validatedData['tour_id'],
            'number' => $validatedData['number'],
            'cost' => $validatedData['cost'],
        ]);

        return redirect()->route('dashboard')->with('success', 'Заявка на бронирование успешно создана!');
    }
}