<x-app-layout>
    <div class="py-12">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Active Loans') }}
            </h2>
        </x-slot>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <table class="min-w-full divide-y divide-gray-200">

                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left">Member</th>
                                <th class="px-4 py-2 text-left">Book</th>
                                <th class="px-4 py-2 text-left">Copy #</th>
                                <th class="px-4 py-2 text-left">Borrowed At</th>
                                <th class="px-4 py-2 text-left">Due Date</th>
                                <th class="px-4 py-2 text-left">Status</th>
                                <th class="px-4 py-2 text-left">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse ($loans as $loan)

                            <tr>
                                <td class="px-4 py-2">{{ $loan->user->name }}</td>
                                <td class="px-4 py-2">{{$loan->bookCopy->book->title}}</td>
                                <td class="px-4 py-2">{{$loan->bookCopy->copy_number}}</td>
                                <td class="px-4 py-2">{{$loan->borrowed_at}}</td>
                                <td class="px-4 py-2">{{$loan->due_date}}</td>

                                <td class="px-4 py-2">
                                    @if($loan->is_overdue)
                                    <span class="bg-red-100 text-red-700 text-xs font-semibold px-2 py-1 rounded">
                                        Overdue
                                    </span>
                                    @else
                                    <span class="bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded">
                                        Active
                                    </span>
                                    @endif
                                </td>

                                <td class="px-4 py-2">
                                    <form action={{ route('librarian.loans.return', $loan) }} method="POST">
                                        @csrf
                                        <button
                                            type="submit"
                                            class="bg-blue-500 hover:bg-blue-700 text-white text-sm py-1 px-3 rounded">
                                            Mark Returned
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-4 py-4 text-center text-gray-500">
                                    No active loans.
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