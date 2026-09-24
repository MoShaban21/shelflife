<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Loans') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <table class="min-w-full divide-y divide-gray-200">

                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left">Book</th>
                                <th class="px-4 py-2 text-left">Borrowed</th>
                                <th class="px-4 py-2 text-left">Due Date</th>
                                <th class="px-4 py-2 text-left">Returned</th>
                                <th class="px-4 py-2 text-left">Status</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse($loans as $loan)
                            <tr>
                                <td class="px-4 py-2">{{ $loan->bookCopy->book->title }}</td>

                                <td class="px-4 py-2">
                                    {{$loan->borrowed_at->format('Y-m-d')}}
                                </td>

                                <td class="px-4 py-2">
                                    {{$loan->due_date->format('Y-m-d')}}
                                </td>

                                <td class="px-4 py-2">
                                    {{ $loan->returned_at ? $loan->returned_at->format('Y-m-d') : 'Not returned yet' }}
                                </td>

                                <td class="px-4 py-2">
                                    @if($loan->returned_at)
                                    <span class="bg-gray-100 text-gray-700 text-xs font-semibold px-2 py-1 rounded">
                                        Returned
                                    </span>
                                    @elseif($loan->is_overdue)
                                    <span class="bg-red-100 text-red-700 text-xs font-semibold px-2 py-1 rounded">
                                        Overdue
                                    </span>
                                    @else
                                    <span class="bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded">
                                        Active
                                    </span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                                    You have no loans yet.
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