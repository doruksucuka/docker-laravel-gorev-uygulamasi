@extends('layouts.app')

@section('title', 'Task Categories')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Task Categories</h2>
                    <button type="button" 
                            @click="showAddModal = true"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm font-medium transition">
                        Add Category
                    </button>
                </div>

                <div x-data="categoryManagement()" class="mt-6">
                    <!-- Add Category Modal -->
                    <div x-show="showAddModal" class="fixed inset-0 z-50 overflow-y-auto">
                        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                            <div x-show="showAddModal" x-transition class="fixed inset-0 transition-opacity" aria-hidden="true">
                                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                            </div>
                            
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                            
                            <div x-show="showAddModal" x-transition class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
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
                                                           x-model="newCategoryName"
                                                           id="categoryName"
                                                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200"
                                                           placeholder="Enter category name">
                                                </div>
                                                <div x-show="addError" class="mt-2 text-sm text-red-600 dark:text-red-400">
                                                    <span x-text="addError"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button type="button" 
                                            @click="addCategory"
                                            :disabled="adding"
                                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50"
                                            x-text="adding ? 'Adding...' : 'Add Category'">
                                        Add Category
                                    </button>
                                    <button type="button" 
                                            @click="showAddModal = false; newCategoryName = ''; addError = null"
                                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-600 text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Category Modal -->
                    <div x-show="showEditModal" class="fixed inset-0 z-50 overflow-y-auto">
                        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                            <div x-show="showEditModal" x-transition class="fixed inset-0 transition-opacity" aria-hidden="true">
                                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                            </div>
                            
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                            
                            <div x-show="showEditModal" x-transition class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
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
                                                           x-model="editingCategory.name"
                                                           id="editCategoryName"
                                                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200"
                                                           placeholder="Enter category name">
                                                </div>
                                                <div x-show="editError" class="mt-2 text-sm text-red-600 dark:text-red-400">
                                                    <span x-text="editError"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button type="button" 
                                            @click="updateCategory"
                                            :disabled="updating"
                                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50"
                                            x-text="updating ? 'Updating...' : 'Update Category'">
                                        Update Category
                                    </button>
                                    <button type="button" 
                                            @click="showEditModal = false; editError = null"
                                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-600 text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Categories List -->
                    <div class="mt-4">
                        @if($categories->count() > 0)
                            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($categories as $category)
                                    <li x-data="{ category: @js($category) }" 
                                        class="py-4 flex items-center justify-between">
                                        <div class="flex items-center">
                                            <span class="text-lg font-medium text-gray-900 dark:text-gray-100" 
                                                  x-text="category.name">
                                                {{ $category->name }}
                                            </span>
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            <button type="button" 
                                                    @click="openEditModal(category)"
                                                    class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                Edit
                                            </button>
                                            <button type="button" 
                                                    @click="deleteCategory(category)"
                                                    :disabled="deleting"
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 disabled:opacity-50">
                                                Delete
                                            </button>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="text-center py-8">
                                <p class="text-gray-500 dark:text-gray-400">No categories found.</p>
                                <p class="text-gray-500 dark:text-gray-400 mt-2">Add your first category to get started.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function categoryManagement() {
        return {
            showAddModal: false,
            showEditModal: false,
            newCategoryName: '',
            editingCategory: {
                id: null,
                name: ''
            },
            adding: false,
            updating: false,
            deleting: false,
            addError: null,
            editError: null,
            
            async addCategory() {
                if (!this.newCategoryName.trim()) {
                    this.addError = 'Category name is required';
                    return;
                }
                
                this.adding = true;
                this.addError = null;
                
                try {
                    const response = await fetch('{{ route('categories.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            name: this.newCategoryName.trim()
                        })
                    });
                    
                    if (!response.ok) {
                        const error = await response.json();
                        throw new Error(error.name ? error.name[0] : 'Failed to add category');
                    }
                    
                    const newCategory = await response.json();
                    
                    // Add the new category to the list
                    const categoryElement = document.createElement('li');
                    categoryElement.className = 'py-4 flex items-center justify-between';
                    categoryElement.setAttribute('x-data', `{ category: ${JSON.stringify(newCategory)} }`);
                    categoryElement.innerHTML = `
                        <div class="flex items-center">
                            <span class="text-lg font-medium text-gray-900 dark:text-gray-100">${newCategory.name}</span>
                        </div>
                        <div class="flex items-center space-x-4">
                            <button type="button" 
                                    @click="openEditModal(category)"
                                    class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                Edit
                            </button>
                            <button type="button" 
                                    @click="deleteCategory(category)"
                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                Delete
                            </button>
                        </div>
                    `;
                    
                    const list = document.querySelector('ul.divide-y');
                    if (list) {
                        list.appendChild(categoryElement);
                    } else {
                        // If list doesn't exist, create it
                        const container = document.querySelector('.mt-4');
                        container.innerHTML = `
                            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                                <li class="py-4 flex items-center justify-between" x-data="{ category: ${JSON.stringify(newCategory)} }">
                                    <div class="flex items-center">
                                        <span class="text-lg font-medium text-gray-900 dark:text-gray-100">${newCategory.name}</span>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <button type="button" 
                                                @click="openEditModal(category)"
                                                class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                            Edit
                                        </button>
                                        <button type="button" 
                                                @click="deleteCategory(category)"
                                                class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                            Delete
                                        </button>
                                    </div>
                                </li>
                            </ul>
                        `;
                    }
                    
                    // Close modal and reset form
                    this.showAddModal = false;
                    this.newCategoryName = '';
                } catch (error) {
                    this.addError = error.message || 'Failed to add category';
                } finally {
                    this.adding = false;
                }
            },
            
            openEditModal(category) {
                this.editingCategory = { ...category };
                this.showEditModal = true;
                this.editError = null;
            },
            
            async updateCategory() {
                if (!this.editingCategory.name.trim()) {
                    this.editError = 'Category name is required';
                    return;
                }
                
                this.updating = true;
                this.editError = null;
                
                try {
                    const response = await fetch(`/categories/${this.editingCategory.id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            name: this.editingCategory.name.trim()
                        })
                    });
                    
                    if (!response.ok) {
                        const error = await response.json();
                        throw new Error(error.name ? error.name[0] : 'Failed to update category');
                    }
                    
                    const updatedCategory = await response.json();
                    
                    // Update the category in the list
                    const categoryElements = document.querySelectorAll('[x-data*="category"]');
                    categoryElements.forEach(el => {
                        const categoryData = el.getAttribute('x-data');
                        if (categoryData.includes(`"id":${this.editingCategory.id}`)) {
                            el.querySelector('span.font-medium').textContent = updatedCategory.name;
                        }
                    });
                    
                    // Close modal
                    this.showEditModal = false;
                } catch (error) {
                    this.editError = error.message || 'Failed to update category';
                } finally {
                    this.updating = false;
                }
            },
            
            async deleteCategory(category) {
                if (!confirm(`Are you sure you want to delete the category "${category.name}"?`)) {
                    return;
                }
                
                this.deleting = true;
                
                try {
                    const response = await fetch(`/categories/${category.id}`, {
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
                    const categoryElements = document.querySelectorAll('[x-data*="category"]');
                    categoryElements.forEach(el => {
                        const categoryData = el.getAttribute('x-data');
                        if (categoryData.includes(`"id":${category.id}`)) {
                            el.remove();
                        }
                    });
                } catch (error) {
                    alert(error.message || 'Failed to delete category');
                } finally {
                    this.deleting = false;
                }
            }
        }
    }
</script>
@endsection