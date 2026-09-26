<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Browse Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Success Message -->
            @session('success')
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
            @endsession

            @session('error')
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
            @endsession

            <form method="GET" action="{{ route('member.books.index') }}" class="mb-4 flex gap-2">
                <x-text-input
                    name="q"
                    type="text"
                    class="block w-full"
                    placeholder="Search by title or author..."
                    :value="old('q', $search)" />
                <x-primary-button type="">
                    Search
                </x-primary-button>
            </form>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <table class="min-w-full divide-y divide-gray-200">

                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left">
                                    Title
                                </th>

                                <th class="px-4 py-2 text-left">
                                    Author
                                </th>

                                <th class="px-4 py-2 text-left">
                                    Available Copies
                                </th>

                                <th class="px-4 py-2 text-left">
                                    Action
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse($books as $book)
                            <tr>
                                <td class="px-4 py-2">
                                    {{$book->title}}
                                </td>

                                <td class="px-4 py-2">
                                    {{$book->author}}
                                </td>

                                <td class="px-4 py-2">
                                    {{$book->available_copies_count}}
                                </td>

                                <td class="px-4 py-2">
                                    @if($book->available_copies_count > 0)
                                    <form method="POST" action="{{ route('member.books.borrow', $book) }}">
                                        @csrf
                                        <button
                                            type="submit"
                                            class="bg-blue-500 hover:bg-blue-700 text-white text-sm py-1 px-3 rounded">
                                            Borrow
                                        </button>
                                    </form>
                                    @else
                                    <span class="text-gray-400 text-sm">Not available</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                                    @if($search)
                                    No books found for "{{ $search }}".
                                    @else
                                    No books available.
                                    @endif
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