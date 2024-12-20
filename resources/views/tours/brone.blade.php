@extends("dashboard")

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Список туров</h1>

    <!-- Список отчетов -->
    <div class="space-y-4">
        @foreach($tours as $tour)
        <div class="bg-blue-50 shadow-md rounded-lg p-4 flex justify-between items-center border-2 border-blue-300">
            <div>
                <p class="text-sm text-red-500 font-semibold">
                    {{ $tour->date->format('d.m.Y') }}
                </p>
                <img src="{{ $tour->path_img }}" alt="Image" class="mt-2">
                <p class="text-lg font-semibold text-black mt-2">{{ $tour->title }}</p>
                <p class="text-gray-600 mt-2">{{ $tour->description }}</p>
                <p class="text-gray-600 mt-2">Цена: {{ $tour->price }}</p>

                {{-- Вывод данных пользователя, если роль администратора --}}
                @auth
                {{-- @if (auth()->user()->role === 'admin') --}}
                    <p class="text-gray-600 mt-2">
                        {{-- Автор: {{ $tour->user->surname }} {{ $tour->user->name }} {{ $tour->user->middlename }} --}}
                    </p>
                @endauth
                @auth
                <a href="{{ route('dashboard') }}" class="bg-clo ml-2 mt-20 bg-blue-500 text-white   underline px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200 ease-in-out">
                    Забранировать
                </a>
                @endauth
            </div>

            <div>
                {{-- Форма для обновления статуса (если роль администратора) --}}
                {{-- @if (auth()->user()->role === 'admin')
                    <form method="POST" action="{{ route('report.update-status', $tour->id) }}">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200 ease-in-out">
                            Сохранить
                        </button>
                    </form>
                @else
                   Вывод статуса отчета 
                    @if ($tour->status_id === 1)
                        <span class="text-black font-bold">новое</span>
                    @elseif ($tour->status_id === 2)
                        <span class="text-red-500 font-bold">отклонено</span>
                    @elseif ($tour->status_id === 3)
                        <span class="text-blue-500 font-bold">подтверждено</span>
                    @endif
                @endif --}}
            </div>
        </div>
        @endforeach

        {{-- Кнопка для создания новой заявки --}}
        {{-- <div>
            <a href="{{ route('reports.create') }}" class="ml-2 mt-20 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200 ease-in-out">
                Создать заявку
            </a>
        </div> --}}
    </div>
</div>
@endsection