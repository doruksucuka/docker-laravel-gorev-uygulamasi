<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Task Categories
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold">Task Categories</h2>
                        <button type="button" 
                                onclick="openAddModal()"
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm font-medium transition">
                            Add Category
                        </button>
                    </div>

                    <!-- Add Category Modal -->
                    <div id="addModal" role="dialog" aria-modal="true" aria-labelledby="addModalTitle" class="fixed inset-0 z-50 overflow-y-auto hidden">
                        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                            <div class="fixed inset-0 transition-opacity bg-gray-500 opacity-75"></div>
                            
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                            
                            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" tabindex="-1">
                                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="sm:flex sm:items-start">
                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100 mb-4">
                                                Add New Category
                                            </h3>
                                            <div class="mt-2">
                                                <div>
                                                    <label for="categoryName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                        Category Name
                                                    </label>
                                                    <input type="text" 
                                                           id="categoryName"
                                                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200"
                                                           placeholder="Enter category name">
                                                </div>
                                                <div id="addError" class="mt-2 text-lg font-bold text-red-600 dark:text-red-400 bg-red-100 p-2 rounded-md hidden"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button type="button" 
                                            onclick="addCategory()"
                                            id="addButton"
                                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-lg font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                        Add Category
                                    </button>
                                    <button type="button" 
                                            onclick="closeAddModal()"
                                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-600 text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Category Modal -->
                    <div id="editModal" role="dialog" aria-modal="true" aria-labelledby="editModalTitle" class="fixed inset-0 z-50 overflow-y-auto hidden">
                        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                            <div class="fixed inset-0 transition-opacity bg-gray-500 opacity-75"></div>
                            
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                            
                            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" tabindex="-1">
                                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="sm:flex sm:items-start">
                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100 mb-4">
                                                Edit Category
                                            </h3>
                                            <div class="mt-2">
                                                <div>
                                                    <label for="editCategoryName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                        Category Name
                                                    </label>
                                                    <input type="text" 
                                                           id="editCategoryName"
                                                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200"
                                                           placeholder="Enter category name">
                                                    <input type="hidden" id="editCategoryId">
                                                </div>
                                                <div id="editError" class="mt-2 text-lg font-bold text-red-600 dark:text-red-400 bg-red-100 p-2 rounded-md hidden"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button type="button" 
                                            onclick="updateCategory()"
                                            id="updateButton"
                                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                        Update Category
                                    </button>
                                    <button type="button" 
                                            onclick="closeEditModal()"
                                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-600 text-lg font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Categories List -->
                    <div class="mt-4">
                        @if($categories->count() > 0)
                            <ul class="divide-y divide-gray-200 dark:divide-gray-700" id="categoriesList">
                                @foreach($categories as $category)
                                    <li class="py-4 flex items-center justify-between" data-category-id="{{ $category->id }}">
                                        <div class="flex items-center">
                                            <span class="text-lg font-medium text-gray-900 dark:text-gray-100 category-name">
                                                {{ $category->name }}
                                            </span>
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            <button type="button"
                                                    onclick="openEditModal({{ $category->id }}, '{{ $category->name }}')"
                                                    class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 text-sm px-2 py-1 border border-blue-600 rounded">
                                                Edit
                                            </button>
                                            <button type="button"
                                                    onclick="deleteCategory({{ $category->id }}, '{{ $category->name }}')"
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 text-sm px-2 py-1 border border-red-600 rounded">
                                                Delete
                                            </button>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="text-center py-8" id="emptyState">
                                <p class="text-gray-500 dark:text-gray-400">No categories found.</p>
                                <p class="text-gray-500 dark:text-gray-400 mt-2">Add your first category to get started.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Modal functions
        function openAddModal() {
            document.getElementById('addModal').classList.remove('hidden');
            document.getElementById('categoryName').value = '';
            document.getElementById('addError').classList.add('hidden');
        }

        function closeAddModal() {
            document.getElementById('addModal').classList.add('hidden');
        }

        function openEditModal(id, name) {
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editCategoryId').value = id;
            document.getElementById('editCategoryName').value = name;
            document.getElementById('editError').classList.add('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // CRUD functions
        async function addCategory() {
            const name = document.getElementById('categoryName').value.trim();
            const button = document.getElementById('addButton');
            const errorDiv = document.getElementById('addError');
            
            if (!name) {
                errorDiv.textContent = 'Category name is required';
                errorDiv.classList.remove('hidden');
                return;
            }
            
            button.disabled = true;
            button.textContent = 'Adding...';
            errorDiv.classList.add('hidden');
            
            try {
                const response = await fetch('{{ route('categories.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ name: name })
                });
                
                if (!response.ok) {
                    const error = await response.json();
                    throw new Error(error.name ? error.name[0] : 'Failed to add category');
                }
                
                const newCategory = await response.json();
                
                // Add the new category to the list
                addCategoryToList(newCategory);
                
                // Close modal and reset form
                closeAddModal();
            } catch (error) {
                errorDiv.textContent = error.message || 'Failed to add category';
                errorDiv.classList.remove('hidden');
            } finally {
                button.disabled = false;
                button.textContent = 'Add Category';
            }
        }

        async function updateCategory() {
            const id = document.getElementById('editCategoryId').value;
            const name = document.getElementById('editCategoryName').value.trim();
            const button = document.getElementById('updateButton');
            const errorDiv = document.getElementById('editError');
            
            if (!name) {
                errorDiv.textContent = 'Category name is required';
                errorDiv.classList.remove('hidden');
                return;
            }
            
            button.disabled = true;
            button.textContent = 'Updating...';
            errorDiv.classList.add('hidden');
            
            try {
                const response = await fetch(`/categories/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ name: name })
                });
                
                if (!response.ok) {
                    const error = await response.json();
                    throw new Error(error.name ? error.name[0] : 'Failed to update category');
                }
                
                const updatedCategory = await response.json();
                
                // Update the category in the list
                updateCategoryInList(id, updatedCategory.name);
                
                // Close modal
                closeEditModal();
            } catch (error) {
                errorDiv.textContent = error.message || 'Failed to update category';
                errorDiv.classList.remove('hidden');
            } finally {
                button.disabled = false;
                button.textContent = 'Update Category';
            }
        }

        async function deleteCategory(id, name) {
            if (!confirm(`Are you sure you want to delete the category "${name}"?`)) {
                return;
            }
            
            try {
                const response = await fetch(`/categories/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                
                if (!response.ok) {
                    const error = await response.json();
                    throw new Error(error.message || 'Failed to delete category');
                }
                
                // Remove the category from the list
                removeCategoryFromList(id);
            } catch (error) {
                alert(error.message || 'Failed to delete category');
            }
        }

        // Helper functions
        function addCategoryToList(category) {
            const list = document.getElementById('categoriesList');
            const emptyState = document.getElementById('emptyState');
            
            if (emptyState) {
                emptyState.remove();
            }
            
            if (!list) {
                // Create the list if it doesn't exist
                const container = document.querySelector('.mt-4');
                container.innerHTML = `
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700" id="categoriesList">
                        <li class="py-4 flex items-center justify-between" data-category-id="${category.id}">
                            <div class="flex items-center">
                                <span class="text-lg font-medium text-gray-900 dark:text-gray-100 category-name">${category.name}</span>
                            </div>
                            <div class="flex items-center space-x-4">
                                <button type="button"
                                        onclick="openEditModal(${category.id}, '${category.name}')"
                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 text-sm px-2 py-1 border border-blue-600 rounded">
                                    Edit
                                </button>
                                <button type="button"
                                        onclick="deleteCategory(${category.id}, '${category.name}')"
                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 text-sm px-2 py-1 border border-red-600 rounded">
                                    Delete
                                </button>
                            </div>
                        </li>
                    </ul>
                `;
            } else {
                // Add to existing list
                const li = document.createElement('li');
                li.className = 'py-4 flex items-center justify-between';
                li.setAttribute('data-category-id', category.id);
                li.innerHTML = `
                    <div class="flex items-center">
                        <span class="text-lg font-medium text-gray-900 dark:text-gray-100 category-name">${category.name}</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button type="button" 
                                onclick="openEditModal(${category.id}, '${category.name}')"
                                class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                            Edit
                        </button>
                        <button type="button" 
                                onclick="deleteCategory(${category.id}, '${category.name}')"
                                class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                            Delete
                        </button>
                    </div>
                `;
                list.appendChild(li);
            }
        }

        function updateCategoryInList(id, name) {
            const categoryItem = document.querySelector(`[data-category-id="${id}"]`);
            if (categoryItem) {
                const nameSpan = categoryItem.querySelector('.category-name');
                nameSpan.textContent = name;
                
                // Update the onclick attributes
                const editButton = categoryItem.querySelector('button[onclick*="openEditModal"]');
                const deleteButton = categoryItem.querySelector('button[onclick*="deleteCategory"]');
                
                editButton.setAttribute('onclick', `openEditModal(${id}, '${name}')`);
                deleteButton.setAttribute('onclick', `deleteCategory(${id}, '${name}')`);
            }
        }

        function removeCategoryFromList(id) {
            const categoryItem = document.querySelector(`[data-category-id="${id}"]`);
            if (categoryItem) {
                categoryItem.remove();
                
                // Check if list is empty
                const list = document.getElementById('categoriesList');
                if (list && list.children.length === 0) {
                    const container = document.querySelector('.mt-4');
                    container.innerHTML = `
                        <div class="text-center py-8" id="emptyState">
                            <p class="text-gray-500 dark:text-gray-400">No categories found.</p>
                            <p class="text-gray-500 dark:text-gray-400 mt-2">Add your first category to get started.</p>
                        </div>
                    `;
                }
            }
        }
    </script>
</x-app-layout>