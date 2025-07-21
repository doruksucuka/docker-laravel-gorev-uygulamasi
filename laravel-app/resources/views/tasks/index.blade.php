<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Görevler') }}
            </h2>
            <form method="GET" action="{{ route('tasks.index') }}" class="flex items-center gap-2 flex-wrap">
                <input type="text" name="search" placeholder="Görev ara..."
                       value="{{ request('search') }}"
                       class="px-4 py-2 rounded border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500" />

                <select name="status" class="px-4 py-2 rounded border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Tüm Durumlar</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Tamamlanan</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Bekleyen</option>
                </select>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">
                    Filtrele
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-end mb-6">
                <a href="{{ route('tasks.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">
                    + Yeni Görev Ekle
                </a>
            </div>

            @forelse ($tasks as $task)
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-md p-5 mb-5 border dark:border-gray-700">
                    <h3 class="text-lg font-semibold {{ $task->is_completed ? 'text-green-400' : 'text-white' }}">
                        <a href="{{ route('tasks.show', $task) }}" class="hover:underline">
                            {{ $task->title }}
                        </a>
                    </h3>
                    @if($task->category)
                        <p class="text-xs text-gray-400 mt-1">{{ $task->category->name }}</p>
                    @endif
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">{{ $task->description }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Tarih: {{ $task->created_at->format('d.m.Y H:i') }}</p>

                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-sm px-2 py-1 rounded 
                            {{ $task->is_completed ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">
                            {{ $task->is_completed ? '✅ Tamamlandı' : '⏳ Beklemede' }}
                        </span>

                        <div class="flex gap-2">
                            @if (!$task->is_completed)
                                <form action="{{ route('tasks.complete', $task) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="text-sm bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                        Tamamla
                                    </button>
                                </form>
                            @endif

                            <a href="{{ route('tasks.edit', $task) }}"
                               class="text-sm bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                Düzenle
                            </a>

                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Bu görevi silmek istediğinizden emin misiniz?')" class="px-3 py-1 text-sm bg-red-600 hover:bg-red-700 text-white rounded-md transition">
                                    Sil
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-600 dark:text-gray-300">Henüz görev yok.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>