<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (Auth::user()->role === 'admin')
                {{ __('Панель администратора') }}
            @else
                {{ __('Личный кабинет') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (Auth::user()->role === 'admin')
                        <h3 class="text-lg font-semibold mb-4">Список всех заявок</h3>

                        <!-- Фильтр по турам -->
                        <form action="{{ route('profile.index') }}" method="GET" class="mb-4">
                            <label for="tour_id" class="block text-sm font-medium text-gray-700">Фильтр по туру:</label>
                            <select name="tour_id" id="tour_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Все туры</option>
                                @foreach ($bookedTours->pluck('tour')->unique('id') as $tour)
                                    <option value="{{ $tour->id }}">{{ $tour->title }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200 ease-in-out">
                                Применить фильтр
                            </button>
                        </form>
                    @else
                        <h3 class="text-lg font-semibold mb-4">Забронированные туры</h3>
                    @endif

                    @if ($bookedTours->isEmpty())
                        <p class="text-gray-600">
                            @if (Auth::user()->role === 'admin')
                                Заявок пока нет.
                            @else
                                У вас пока нет забронированных туров.
                            @endif
                        </p>
                    @else
                        <div class="space-y-6">
                            @foreach ($bookedTours as $booking)
                                <div class="border border-gray-200 p-4 rounded-lg">
                                    @if (Auth::user()->role === 'admin')
                                        <!-- Информация для администратора -->
                                        <p class="text-gray-800 font-semibold">Пользователь: {{ $booking->user->name }} {{ $booking->user->surname }} {{ $booking->user->email }}</p>
                                    @endif

                                    <p class="text-gray-800 font-semibold">Тур: {{ $booking->tour->title }}</p>
                                    <p class="text-gray-600">Дата: {{ $booking->tour->date }}</p>
                                    <p class="text-gray-600">Количество мест: {{ $booking->number }}</p>
                                    <p class="text-gray-600">Цена тура: {{ $booking->tour->price }} руб.</p>
                                    <p class="text-gray-600">Общая стоимость: {{ $booking->number * $booking->tour->price }} руб.</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>