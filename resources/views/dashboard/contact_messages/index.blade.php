@extends('layouts.app')

@section('content')
<div x-data="{ isSwalOpen: false, deleteUrl: '' }" class="space-y-6">

    <!-- Header Utama -->
    <div class="space-y-4">
        <h1 class="text-2xl font-medium text-slate-900">User Feedback</h1>

        <!-- Search Form -->
        <form action="{{ route('contact-messages.index') }}" method="GET" class="relative w-72">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <img src="{{ asset('icons/ci_search-magnifying-glass.png') }}" alt="Search" class="w-4 h-4">
            </div>
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}" 
                placeholder="Search user, subject, or message" 
                class="w-full h-9 pl-9 pr-8 border border-slate-200 rounded-lg text-xs text-slate-700 bg-white placeholder-slate-600 focus:outline-none focus:ring-0 focus:border-slate-300">
            @if(request('search'))
                <a href="{{ route('contact-messages.index') }}" 
                    title="Reset search"
                    class="absolute inset-y-0 right-0 pr-2.5 flex items-center text-slate-400 hover:text-slate-600 text-xs font-semibold">
                    ✕
                </a>
            @endif
        </form>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200/80">
        <!-- Table Title -->
        <div class="mb-4">
            <h3 class="text-base font-bold text-slate-800">User Messages</h3>
        </div>

        <!-- Responsive Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-100 text-slate-700 text-xs font-semibold">
                        <th class="py-3 px-4 rounded-l-lg">Date</th>
                        <th class="py-3 px-4">User Name</th>
                        <th class="py-3 px-4">Subject</th>
                        <th class="py-3 px-4">Message</th>
                        <th class="py-3 px-4 rounded-r-lg text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="text-xs text-slate-700 font-medium divide-y divide-slate-100">
                    @forelse($feedbacks as $item)
                        <tr>
                            <td class="py-4 px-4 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                            </td>
                            <td class="py-4 px-4 whitespace-nowrap">
                                {{ $item->user->name ?? 'Guest' }}
                            </td>
                            <td class="py-4 px-4 whitespace-nowrap">
                                {{ $item->subject }}
                            </td>
                            <td class="py-4 px-4 max-w-md">
                                <p class="line-clamp-2 leading-relaxed text-slate-700" title="{{ $item->message }}">
                                    {{ $item->message }}
                                </p>
                            </td>
                            <td class="py-4 px-4 text-center whitespace-nowrap">
                                <button type="button" title="Delete feedback" class="inline-flex items-center justify-center bg-transparent border-0 p-0">
                                    <img 
                                        src="{{ asset('icons/fa7-regular_trash-can.png') }}" 
                                        alt="Delete" 
                                        class="w-6 h-6 cursor-pointer"
                                        @click.stop.prevent="
                                            deleteUrl = '{{ route('contact-messages.destroy', $item->id) }}';
                                            isSwalOpen = true;
                                            Swal.mixin({
                                                customClass: {
                                                    confirmButton: 'bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg mx-1',
                                                    cancelButton: 'bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg mx-1'
                                                },
                                                buttonsStyling: false
                                            }).fire({
                                                title: 'Are you sure?',
                                                text: 'You won\'t be able to revert this!',
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonText: 'Yes, delete it!',
                                                cancelButtonText: 'No, cancel!',
                                                reverseButtons: true,
                                                returnFocus: false,
                                                didClose: () => {
                                                    setTimeout(() => { isSwalOpen = false; }, 100);
                                                }
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    const form = document.getElementById('globalDeleteForm');
                                                    form.action = deleteUrl;
                                                    form.submit();
                                                }
                                            });
                                        "
                                    >
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400">
                                No user feedback messages found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Footer & Pagination -->
        @if($feedbacks->count() > 0)
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3 mt-6 text-xs text-slate-800">
                <div>
                    Showing {{ $feedbacks->firstItem() }}-{{ $feedbacks->lastItem() }} out of {{ $feedbacks->total() }} User Messages
                </div>
                <div>
                    {{ $feedbacks->links('components.pagination') }}
                </div>
            </div>
        @endif
    </div>

    <!-- Hidden Delete Form -->
    <form id="globalDeleteForm" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</div>
@endsection