<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Book
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="#">

                        <!-- Title -->
                        <div>
                            <label for="title"
                                   class="block font-medium text-sm text-gray-700">
                                Title
                            </label>

                            <input id="title"
                                   name="title"
                                   type="text"
                                   class="mt-1 block w-full"
                                   required
                                   autofocus>
                        </div>

                        <!-- Author -->
                        <div class="mt-4">
                            <label for="author"
                                   class="block font-medium text-sm text-gray-700">
                                Author
                            </label>

                            <input id="author"
                                   name="author"
                                   type="text"
                                   class="mt-1 block w-full"
                                   required>
                        </div>

                        <!-- ISBN -->
                        <div class="mt-4">
                            <label for="isbn"
                                   class="block font-medium text-sm text-gray-700">
                                ISBN
                            </label>

                            <input id="isbn"
                                   name="isbn"
                                   type="text"
                                   class="mt-1 block w-full">
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <label for="description"
                                   class="block font-medium text-sm text-gray-700">
                                Description
                            </label>

                            <textarea id="description"
                                      name="description"
                                      class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                      rows="4"></textarea>
                        </div>

                        <div class="flex items-center justify-end mt-6">

                            <a href="#"
                               class="text-gray-600 underline mr-4">
                                Cancel
                            </a>

                            <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Save Book
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>