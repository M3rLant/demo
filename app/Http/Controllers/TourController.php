<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TourController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        

        
        $tours = Tour::all();

        $tours->each(function ($tour) {
            $tour->date = Carbon::parse($tour->date);
        });
       

        return view("tours.index", compact("tours"));
    }

    // public function create()
    // {
    //     return view("report.create");
    // }

    public function destroy(Tour $tours)
    {
        $tours->delete();
        return redirect()->back();
    }

    public function store(Request $request, Tour $tours)
    {
        $data = $request->validate([
            "description" => "required|string|max:255",
            "number" => "required|string|max:255",
        ]);

        $data["user_id"] = auth()->id();
        $data["status_id"] = 1;
        $tour->create($data);
        return redirect()->back();
    }

    public function show(Report $tour)
    {
        $user = auth()->user();

        if ($user->role !== "admin" && $tour->user_id !== $user->id) {
            abort(403, "У вас нет прав для просмотра этого отчёта.");
        }

        return view("report.show", compact("report"));
    }

    public function update(Request $request, Report $tour)
    {
        $data = $request->validate([
            "description" => "required|string|max:255",
        ]);

        $tour->update($data);
        return redirect()->back();
    }

    public function updateStatus(Request $request, Report $tour)
    {
        if (auth()->user()->role !== "admin") {
            abort(403, "У вас нет прав для изменения статуса.");
        }

        $data = $request->validate([
            "status_id" => "required|exists:statuses,id",
        ]);

        $tour->update($data);

        return redirect()
            ->back()
            ->with("success", "Статус отчёта успешно обновлён!");
    }


}