<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @php
        $total = $total ?? $tasks->count();
        $completed = $completed ?? $tasks->where('is_completed', true)->count();
        $pending = $pending ?? $tasks->where('is_completed', false)->count();
        $latestTasks = $latestTasks ?? $tasks->sortByDesc('created_at')->take(5);
    @endphp
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-lg">
                    <div class="text-sm text-gray-500 dark:text-gray-400">Toplam Görev</div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $total }}</div>
                </div>
                <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-lg">
                    <div class="text-sm text-gray-500 dark:text-gray-400">Tamamlanan</div>
                    <div class="text-2xl font-bold text-green-500">{{ $completed }}</div>
                </div>
                <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-lg">
                    <div class="text-sm text-gray-500 dark:text-gray-400">Bekleyen</div>
                    <div class="text-2xl font-bold text-red-500">{{ $pending }}</div>
                </div>
            </div>

            <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-lg mt-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">Son Eklenen Görevler</h3>
                <ul class="space-y-2">
                    @foreach ($latestTasks as $task)
                        <li class="p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
                            <span class="dark:text-white">{{ $task->title }}</span>
                            @if ($task->is_completed)
                                <span class="text-green-600 text-sm ml-2">(Tamamlandı)</span>
                            @else
                                <span class="text-yellow-400 text-sm ml-2">(Beklemede)</span>
                            @endif
                            <div class="text-xs text-gray-600 dark:text-gray-300 mt-1">
                                {{ \Illuminate\Support\Carbon::parse($task->created_at)->format('d.m.Y H:i') }}
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-lg mt-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">Yeni Görev Ekle</h3>
                <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Başlık</label>
                        <input type="text" name="title" id="title" required
                            class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500">
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Açıklama</label>
                        <textarea name="description" id="description" rows="3"
                                class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500"></textarea>
                    </div>
                    <div>
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none">
                            Görev Ekle
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>    
</x-app-layout>
