<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Requisitions') }}
        </h2>
    </x-slot>

        <!-- Success Notification -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        <!-- Optional Auto-Close JavaScript -->
        <script>
            setTimeout(function() {
                let alert = document.querySelector('[role="alert"]');
                if (alert) {
                    alert.style.transition = "opacity 0.5s ease";
                    alert.style.opacity = "0";
                    setTimeout(() => alert.remove(), 500);
                }
            }, 3000); // Hide after 3 seconds
        </script>
        @endif


<div class="py-7">
    <!-- Navigation Links -->
    <div class="sm:overflow-x-auto sm:whitespace-nowrap md:overflow-x-visible md:whitespace-normal">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                @if ($roleId == 1 || $roleId == 2 || $roleId == 3 || $roleId == 4 || $roleId == 5 || $roleId == 6 || $roleId == 7 || $roleId == 8 || $roleId == 9 || $roleId == 10 || $roleId == 11 || $roleId == 12 || $roleId == 13 || $roleId == 14 || $roleId == 15)
                    <x-nav-link :href="route('requisitions.index')" :active="request()->routeIs('requisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('All') }}  
                        <div class="font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline">({{ $requisitionsCount }})</span>
                        </div>
                    </x-nav-link>
                @endif

                @if ($roleId == 1 || $roleId == 3 || $roleId == 4 || $roleId == 15)
                    <x-nav-link :href="route('pendingrequisitions.index')" :active="request()->routeIs('pendingrequisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('Review') }} 
                        <div class="font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline">({{ $pendingrequisitionCount }})</span>
                        </div>
                    </x-nav-link>
                @endif
                
                @if ($roleId == 1 || $roleId == 9)
                    <x-nav-link :href="route('forbondapprovalrequisitions.index')" :active="request()->routeIs('forbondapprovalrequisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('Bonds Approval') }} 
                        <div class="font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline">({{ $bondsapprovalCount }})</span>
                        </div>
                    </x-nav-link>
                @endif

                @if ($roleId == 1 || $roleId == 10)
                    <x-nav-link :href="route('foruwapprovalrequisitions.index')" :active="request()->routeIs('foruwapprovalrequisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('Underwriting Approval') }}
                        <div class="font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline">({{ $uwapprovalCount }})</span>
                        </div>
                    </x-nav-link>
                @endif

                @if ($roleId == 1 || $roleId == 7)
                    <x-nav-link :href="route('collasstrequisitions.index')" :active="request()->routeIs('collasstrequisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('Coll Asst Approval') }}
                        <div class="font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline">({{ $collasstapprovalCount }})</span>
                        </div>
                    </x-nav-link>
                @endif

                @if ($roleId == 1 || $roleId == 8)
                    <x-nav-link :href="route('collmngrequisitions.index')" :active="request()->routeIs('collmngrequisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('Coll Manager Approval') }}
                        <div class="font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline">({{ $collmngapprovalCount }})</span>
                        </div>
                    </x-nav-link>
                @endif

                @if ($roleId == 1 || $roleId == 5 || $roleId == 6)
                    <x-nav-link :href="route('approvedrequisitions.index')" :active="request()->routeIs('approvedrequisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('Final Approval') }}
                        <div class="font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline">({{ $approvedrequisitionsCount }})</span>
                        </div>
                    </x-nav-link>
                @endif

                @if ($roleId == 1 || $roleId == 11 || $roleId == 14)
                    <x-nav-link :href="route('fortransmittal.index')" :active="request()->routeIs('fortransmittal.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('For Transmittal') }}
                        <div class="font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline">({{ $fortransmittalCount }})</span>
                        </div>
                    </x-nav-link>
                @endif

                @if ($roleId == 1 || $roleId == 2 || $roleId == 3 || $roleId == 4 || $roleId == 5 || $roleId == 6 || $roleId == 7 || $roleId == 8 || $roleId == 9 || $roleId == 10 || $roleId == 11 || $roleId == 12 || $roleId == 13)
                    <x-nav-link :href="route('cancelrequisitions.index')" :active="request()->routeIs('cancelrequisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('Cancel') }}
                        <div class="font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline">({{ $cancelrequisitionsCount }})</span>
                        </div>
                    </x-nav-link>
                @endif

                @if ($roleId == 1 || $roleId == 13 || $roleId == 5 || $roleId == 6)
                    <x-nav-link :href="route('cocapprovalrequisitions.index')" :active="request()->routeIs('cocapprovalrequisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('COC Approval') }}
                        <div class="font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline">({{ $cocapprovalCount }})</span>
                        </div>
                    </x-nav-link>
                @endif

                @if ($roleId == 1 || $roleId == 12)
                    <x-nav-link :href="route('treasuryapprovalrequisitions.index')" :active="request()->routeIs('treasuryapprovalrequisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('Treasury Approval') }}
                        <div class="font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline">({{ $treasuryapprovalCount }})</span>
                        </div>
                    </x-nav-link>
                @endif

                @if ($roleId == 1 || $roleId == 2 || $roleId == 3 || $roleId == 4 || $roleId == 5 || $roleId == 6 || $roleId == 7 || $roleId == 8 || $roleId == 9 || $roleId == 10 || $roleId == 11 || $roleId == 12 || $roleId == 13 || $roleId == 14)
                    <x-nav-link :href="route('donerequisitions.index')" :active="request()->routeIs('donerequisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('Done') }}
                    </x-nav-link>
                @endif

                </div>
            </div>
        </div>
    </div>
</div>
    
    

    <!-- Card view for mobile screens -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
        <div class="space-y-4">
            
        <form method="GET" action="{{ route('requisitions.index') }}">
            <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}">
            <button type="submit" class="bg-blue-500 text-white hover:bg-blue-700 text-sm px-2 py-1 rounded-md">Search</button>
        </form>

            <div class="flex justify-end">
                <a href="{{ route('requisitions.create') }}" class="bg-green-500 text-white hover:bg-green-700 text-sm px-4 py-2 rounded-md">

                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                    Add
                    </svg>
                
                </a>
            </div>

           
            
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                @foreach ($requisitions as $requisition)
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-900">{{ $requisition->id }}</h2>
                    <p class="text-sm text-gray-600">Requestion Number: {{ $requisition->req_no }}</p>
                    <p class="text-sm text-gray-600">Date: {{ $requisition->req_date }}</p>

                    @if ($requisition->status == 'pending')
                        <p class="text-sm text-gray-600">Status: <a href="" class="bg-gray-500 text-white hover:bg-gray-700 text-sm px-2 py-1 rounded-md uppercase">{{ $requisition->status }}</a></p>
                    @elseif ($requisition->status == 'approved')
                        <p class="text-sm text-gray-600">Status: <a href="" class="bg-blue-500 text-white hover:bg-blue-700 text-sm px-2 py-1 rounded-md uppercase">{{ $requisition->status }}</a></p>
                    @elseif ($requisition->status == 'done')
                        <p class="text-sm text-gray-600">Status: <a href="" class="bg-green-500 text-white hover:bg-green-700 text-sm px-2 py-1 rounded-md uppercase">{{ $requisition->status }}</a></p>
                    @elseif ($requisition->status == 'cancelled')
                        <p class="text-sm text-gray-600">Status: <a href="" class="bg-red-500 text-white hover:bg-red-700 text-sm px-2 py-1 rounded-md uppercase">{{ $requisition->status }}</a></p>
                    @endif

                    <p class="text-sm text-gray-600">Request By: {{ $requisition->user->first_name }} {{ $requisition->user->last_name }}</p>
                    <p class="text-sm text-gray-600"># Items: {{ $requisition->items_count }}</p>
                    <p class="text-sm text-gray-600">Branch: {{ $requisition->user->branch->branch_name }}</p>
                    <p class="text-sm text-gray-600">Type: {{ $requisition->user->branch->type_office }}</p>
                    <p class="text-sm text-gray-600">COC Request: <label class="text-sm text-gray-600 uppercase">{{ $requisition->coc_request_status }}</label></p>
                    <p class="text-sm text-gray-600">Delivery Status: <label class="text-sm text-gray-600 uppercase">{{ $requisition->delivery_status }}</label></p> 
                    <div class="mt-4">
                    <a href="{{ route('requisitions.show', $requisition->id) }}" class="bg-blue-300 text-white hover:bg-blue-700 text-sm px-2 py-1 rounded-md">Show</a>
                        @can('view', $requisition)
                            <a href="{{ route('requisitions.edit', $requisition->id)}}" class="bg-green-500 text-white hover:bg-green-700 text-sm px-2 py-1 rounded-md" >Edit</a>

                            <form action="{{ route('requisitions.destroy', $requisition->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white hover:bg-red-700 text-sm px-2 py-1 rounded-md">Delete</button> 
                            </form>
                        @endcan
                    </div>
                </div>
                @endforeach
            </div>
            <div>
                {{ $requisitions->links() }}
            </div>
        </div>
    </div>

                    
</x-app-layout>


    

