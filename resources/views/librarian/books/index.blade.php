<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Books
            </h2>

            <a href="{{route('librarian.books.create')}}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add Book
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @session('success')
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                    @endsession
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left">Title</th>
                                <th class="px-4 py-2 text-left">Author</th>
                                <th class="px-4 py-2 text-left">ISBN</th>
                                <th class="px-4 py-2 text-left">Copies</th>
                                <th class="px-4 py-2 text-left">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">

                            <!-- Book row example -->
                            @forelse($books as $book)
                            <tr>
                                <td class="px-4 py-2">{{$book->title}}</td>
                                <td class="px-4 py-2">{{$book->author}}</td>
                                <td class="px-4 py-2">{{$book->isbn ?? '---'}}</td>
                                <td class="px-4 py-2">{{$book->copies_count}}</td>

                                <td class="px-4 py-2">
                                    <form action="{{route('librarian.books.copies.store', $book)}}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="bg-green-500 hover:bg-green-700 text-white text-sm py-1 px-3 rounded">
                                            Add Copy
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- More books will appear here -->
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                                    No books yet.
                                </td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>