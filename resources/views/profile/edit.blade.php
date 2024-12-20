<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Личный кабинет') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Забронированные туры</h3>

                    @if ($bookedTours->isEmpty())
                        <p class="text-gray-600">У вас пока нет забронированных туров.</p>
                    @else
                        <div class="space-y-6">
                            @foreach ($bookedTours as $booking)
                                <div class="border border-gray-200 p-4 rounded-lg">
                                    <p class="text-gray-800 font-semibold">Тур: {{ $booking->tour->title }}</p>
                                    <p class="text-gray-600">Дата: {{ $booking->tour->date->format('d.m.Y') }}</p>
                                    <p class="text-gray-600">Количество мест: {{ $booking->number }}</p>
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