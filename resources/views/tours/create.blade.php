@extends("dashboard")

@section('content')
<div class="m-8 ">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Создать репорт</h2>
    <div>
        <a href="/" class="ml-2 mt-20 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200 ease-in-out">
            Назад
        </a>
    </div>
    <form method="POST" action="{{ route('reports.store') }}" class="bg-white p-6 rounded-lg space-y-4">
        @csrf

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Описание отчета</label>
            <textarea id="description" name="description" rows="4" class="w-full mt-1 border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Введите описание" required></textarea>
        </div>
        <div>
            <label for="number" class="block text-sm font-medium text-gray-700">Номер</label>
            <input id="number" name="number"  class="w-full mt-1 border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Номер" required />
        </div>

        <div class="text-right">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-200 ease-in-out">
                Создать
            </button>
        </div>
    </form>
</div>
@endsection
