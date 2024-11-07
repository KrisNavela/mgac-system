<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

<div class="py-7">
    <!-- Navigation Links -->
    <div class="sm:overflow-x-auto sm:whitespace-nowrap md:overflow-x-visible md:whitespace-normal">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                @if ($roleId == 1 || $roleId == 2 || $roleId == 3 || $roleId == 4 || $roleId == 5 || $roleId == 6 || $roleId == 7 || $roleId == 8 || $roleId == 9 || $roleId == 10 || $roleId == 11)
                    <x-nav-link :href="route('requisitions.index')" :active="request()->routeIs('requisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('All') }}  
                        <div class="text-red-500 font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline">{{ $requisitionsCount }}</span>
                        </div>
                    </x-nav-link>
                @endif

                @if ($roleId == 1 || $roleId == 3 || $roleId == 4)
                    <x-nav-link :href="route('pendingrequisitions.index')" :active="request()->routeIs('pendingrequisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('Pending') }} 
                        <div class="text-red-500 font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline">{{ $pendingrequisitionCount }}</span>
                        </div>
                    </x-nav-link>
                @endif
                
                @if ($roleId == 1 || $roleId == 9)
                    <x-nav-link :href="route('forbondapprovalrequisitions.index')" :active="request()->routeIs('forbondapprovalrequisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('Bonds Approval') }} 
                        <div class="text-red-500 font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline">{{ $bondsapprovalCount }}</span>
                        </div>
                    </x-nav-link>
                @endif

                @if ($roleId == 1 || $roleId == 10)
                    <x-nav-link :href="route('foruwapprovalrequisitions.index')" :active="request()->routeIs('foruwapprovalrequisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('Underwriting Approval') }}
                        <div class="text-red-500 font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline">{{ $uwapprovalCount }}</span>
                        </div>
                    </x-nav-link>
                @endif

                @if ($roleId == 1 || $roleId == 7)
                    <x-nav-link :href="route('collasstrequisitions.index')" :active="request()->routeIs('collasstrequisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('Coll Asst Approval') }}
                        <div class="text-red-500 font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline">{{ $collasstapprovalCount }}</span>
                        </div>
                    </x-nav-link>
                @endif

                @if ($roleId == 1 || $roleId == 8)
                    <x-nav-link :href="route('collmngrequisitions.index')" :active="request()->routeIs('collmngrequisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('Coll Manager Approval') }}
                        <div class="text-red-500 font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline">{{ $collmngapprovalCount }}</span>
                        </div>
                    </x-nav-link>
                @endif

                @if ($roleId == 1 || $roleId == 5 || $roleId == 6)
                    <x-nav-link :href="route('approvedrequisitions.index')" :active="request()->routeIs('approvedrequisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('Final Approval') }}
                        <div class="text-red-500 font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline">{{ $approvedrequisitionsCount }}</span>
                        </div>
                    </x-nav-link>
                @endif

                @if ($roleId == 1 || $roleId == 11)
                    <x-nav-link :href="route('fortransmittal.index')" :active="request()->routeIs('fortransmittal.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('For Transmittal') }}
                        <div class="text-red-500 font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline">{{ $fortransmittalCount }}</span>
                        </div>
                    </x-nav-link>
                @endif

                @if ($roleId == 1 || $roleId == 2 || $roleId == 3 || $roleId == 4 || $roleId == 5 || $roleId == 6 || $roleId == 7 || $roleId == 8 || $roleId == 9 || $roleId == 10 || $roleId == 11)
                    <x-nav-link :href="route('cancelrequisitions.index')" :active="request()->routeIs('cancelrequisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('Cancel') }}
                        <div class="text-red-500 font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline">{{ $cancelrequisitionsCount }}</span>
                        </div>
                    </x-nav-link>
                @endif

                    <x-nav-link :href="route('cocapprovalrequisitions.index')" :active="request()->routeIs('cocapprovalrequisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('COC Approval') }}
                        <div class="text-red-500 font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline"></span>
                        </div>
                    </x-nav-link>

                    <x-nav-link :href="route('treasuryapprovalrequisitions.index')" :active="request()->routeIs('treasuryapprovalrequisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('Treasury Approval') }}
                        <div class="text-red-500 font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline">{{ $treasuryapprovalCount }}</span>
                        </div>
                    </x-nav-link>

                </div>  
            </div>
        </div>
    </div>
</div>

    <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('requisitions.index')" :active="request()->routeIs('requisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                    {{ __('All') }}
                </x-responsive-nav-link>
            </div>
        </div>
    </nav>


    <!-- Card view for mobile screens -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
        <div class="space-y-4">

            <div class="flex justify-end">
                <a href="{{ route('requisitions.create') }}" class="bg-blue-500 text-white hover:bg-blue-700 text-sm px-2 py-1 rounded-md">Create</a>
            </div>

            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                @foreach ($requisitions as $requisition)
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-900">{{ $requisition->id }}</h2>
                    <p class="text-sm text-gray-600">Requestion Number: {{ $requisition->req_no }}</p>
                    <p class="text-sm text-gray-600">Date: {{ $requisition->req_date }}</p>
                    <p class="text-sm text-gray-600">Status: {{ $requisition->status }}</p>
                    <p class="text-sm text-gray-600">Request By: {{ $requisition->user->first_name }} {{ $requisition->user->last_name }}</p>
                    <p class="text-sm text-gray-600"># Items: {{ $requisition->items_count }}</p>
                    <p class="text-sm text-gray-600">Branch: {{ $requisition->user->branch->branch_name }}</p>
                    <p class="text-sm text-gray-600">Type: {{ $requisition->user->branch->type_office }}</p>
                    <div class="mt-4">
                    <a href="{{ route('requisitions.show', $requisition->id) }}" class="bg-blue-300 text-white hover:bg-blue-700 text-sm px-2 py-1 rounded-md">Show</a>
                        @can('view', $requisition)
                            <a href="{{ route('requisitions.edit', $requisition->id)}}" class="bg-green-500 text-white hover:bg-green-700 text-sm px-2 py-1 rounded-md">Edit</a>

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
