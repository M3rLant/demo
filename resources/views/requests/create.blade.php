@extends("dashboard")

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Бронирование тура</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Тур: {{ $tour->title }}</h2>
        <p class="text-gray-600 mb-4">Дата: {{ $tour->date }}</p>

        <form action="{{ route('request.store') }}" method="POST">
            @csrf

            <!-- ID тура (скрытое поле) -->
            <input type="hidden" name="tour_id" value="{{ $tour->id }}">

            <!-- Количество участников -->
            <div class="mb-4">
                <label for="number" class="block text-sm font-medium text-gray-700">Количество участников</label>
                <input type="number" name="number" id="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="1" min="1">
                @error('number')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Стоимость -->
            <div class="mb-4">
                <label for="cost" class="block text-sm font-medium text-gray-700">Стоимость</label>
                <input type="number" name="cost" id="cost" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ $tour->price }}" min="0" readonly>
                @error('cost')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Кнопка отправки -->
            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200 ease-in-out">
                    Забронировать
                </button>
            </div>
        </form>
    </div>
</div>
@endsection