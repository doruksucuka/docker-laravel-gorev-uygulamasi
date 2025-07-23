@props([
    'categories' => collect(),
    'selected' => []
])
@php
    $options = $categories->map(fn($c) => ['id' => $c->id, 'name' => $c->name]);
    $initialSelected = collect($selected)->map(fn($id) => (int) $id)->values();
@endphp

<div x-data="categorySelect({
        options: {{ \Illuminate\Support\Js::from($options) }},
        selected: {{ \Illuminate\Support\Js::from($initialSelected) }}
    })" class="relative">

    <!-- Display selected pills / placeholder -->
    <div @click="toggle" class="min-h-[2.5rem] border border-gray-300 dark:border-gray-600 rounded-md px-2 py-1 flex items-center flex-wrap gap-2 cursor-text bg-white dark:bg-gray-900">
        <template x-for="option in selectedOptions" :key="'pill'+option.id">
            <span class="px-2 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 hover:opacity-80 transition flex items-center gap-1">
                <span x-text="option.name"></span>
                <button type="button" @click.stop="remove(option.id)" class="ml-1 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">&times;</button>
            </span>
        </template>
        <span x-show="selected.length === 0" class="text-gray-500 text-sm select-none">Kategori seç…</span>
    </div>

    <!-- Dropdown -->
    <div x-show="open" @click.outside="open=false" class="absolute z-10 mt-1 w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md max-h-60 overflow-y-auto shadow-lg">
        <!-- Search -->
        <div class="p-2">
            <input x-model="search" type="text" placeholder="Ara…" class="w-full px-2 py-1 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 focus:outline-none text-sm" />
        </div>
        <template x-for="option in filteredOptions" :key="'opt'+option.id">
            <div @click="select(option)" class="px-3 py-2 cursor-pointer text-sm hover:bg-gray-100 dark:hover:bg-gray-700" :class="isSelected(option.id) ? 'bg-gray-100 dark:bg-gray-700' : ''" x-text="option.name"></div>
        </template>
        <div x-show="filteredOptions.length === 0" class="p-3 text-sm text-gray-500">Sonuç yok</div>
    </div>

    <!-- Hidden inputs -->
    <template x-for="id in selected" :key="'hidden'+id">
        <input type="hidden" name="categories[]" :value="id" />
    </template>
</div>

@once
    <script>
        function categorySelect({ options, selected }) {
            return {
                options,
                selected,
                search: '',
                open: false,
                toggle() { this.open = !this.open; this.search=''; },
                get selectedOptions() {
                    return this.options.filter(o => this.selected.includes(o.id));
                },
                select(option) {
                    if (!this.selected.includes(option.id)) {
                        this.selected.push(option.id);
                    } else {
                        this.remove(option.id);
                    }
                },
                remove(id) {
                    this.selected = this.selected.filter(i => i !== id);
                },
                isSelected(id) { return this.selected.includes(id); },
                get filteredOptions() {
                    if (!this.search) return this.options;
                    return this.options.filter(o => o.name.toLowerCase().includes(this.search.toLowerCase()));
                }
            }
        }
    </script>
@endonce
