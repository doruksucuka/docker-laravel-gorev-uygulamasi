<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Görev Detayları') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-8 space-y-6">
                    <div class="mb-4">
                        <a href="{{ route('tasks.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm font-semibold rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">
                            ← Geri Dön
                        </a>
                    </div>
                    <div>
                        <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white">{{ $task->title }}</h3>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Oluşturulma Tarihi: {{ $task->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>

                    <div class="space-y-2">
                        <div>
                            <span class="text-md font-medium text-gray-700 dark:text-gray-300">Açıklama:</span>
                            <p class="mt-1 text-gray-800 dark:text-gray-200">{{ $task->description ?? 'Açıklama yok.' }}</p>
                        </div>

                        <div>
                            <span class="text-md font-medium text-gray-700 dark:text-gray-300">Son Tarih:</span>
                            <p class="mt-1 text-gray-800 dark:text-gray-200">
                                {{ $task->due_date ? $task->due_date->format('d M Y') : 'Belirtilmemiş' }}
                            </p>
                        </div>

                        <div>
                            <span class="text-md font-medium text-gray-700 dark:text-gray-300">Durum:</span>
                            <p class="mt-1 text-gray-800 dark:text-gray-200">
                                @if ($task->is_completed)
                                    <span class="text-green-500 font-semibold">Tamamlandı</span>
                                @else
                                    <span class="text-yellow-500 font-semibold">Beklemede</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="pt-6 flex justify-end">
                        <a href="{{ route('tasks.edit', $task->id) }}"
                           class="inline-flex items-center px-4 py-2 bg-indigo-600 dark:bg-indigo-500 text-white text-sm font-semibold rounded-md hover:bg-indigo-700 dark:hover:bg-indigo-600 focus:outline-none">
                            Düzenle
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>