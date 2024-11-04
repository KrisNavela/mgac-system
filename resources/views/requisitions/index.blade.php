<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Requisitions') }}
        </h2>
    </x-slot>

<div class="py-7">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    
                    <x-nav-link :href="route('requisitions.index')" :active="request()->routeIs('requisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('All') }}  
                        <div class="text-red-500 font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline">{{ $requisitionsCount }}</span>
                        </div>
                    </x-nav-link>
                    
                    @if ($roleId == 1)
                        <x-nav-link :href="route('pendingrequisitions.index')" :active="request()->routeIs('pendingrequisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                            {{ __('Pending') }} 
                            <div class="text-red-500 font-bold px-1 py-1 rounded relative" role="alert">
                                <span class="block sm:inline">{{ $pendingrequisitionCount }}</span>
                            </div>
                        </x-nav-link>
                    

                    <x-nav-link :href="route('forbondapprovalrequisitions.index')" :active="request()->routeIs('forbondapprovalrequisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('Bonds Approval') }} 
                        <div class="text-red-500 font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline">{{ $bondsapprovalCount }}</span>
                        </div>
                        
                    </x-nav-link>

                    <x-nav-link :href="route('foruwapprovalrequisitions.index')" :active="request()->routeIs('foruwapprovalrequisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('Underwriting Approval') }}
                        <div class="text-red-500 font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline">{{ $uwapprovalCount }}</span>
                        </div>
                    </x-nav-link>

                    <x-nav-link :href="route('collasstrequisitions.index')" :active="request()->routeIs('collasstrequisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('Coll Asst Approval') }}
                        <div class="text-red-500 font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline">{{ $collasstapprovalCount }}</span>
                        </div>
                    </x-nav-link>

                    <x-nav-link :href="route('collmngrequisitions.index')" :active="request()->routeIs('collmngrequisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('Coll Manager Approval') }}
                        <div class="text-red-500 font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline">{{ $collmngapprovalCount }}</span>
                        </div>
                    </x-nav-link>

                    <x-nav-link :href="route('approvedrequisitions.index')" :active="request()->routeIs('approvedrequisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('Final Approval') }}
                        <div class="text-red-500 font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline">{{ $approvedrequisitionsCount }}</span>
                        </div>
                    </x-nav-link>

                    <x-nav-link :href="route('fortransmittal.index')" :active="request()->routeIs('fortransmittal.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('For Transmittal') }}
                    </x-nav-link>

                    <x-nav-link :href="route('cancelrequisitions.index')" :active="request()->routeIs('cancelrequisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('Cancel') }}
                        <div class="text-red-500 font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline">{{ $cancelrequisitionsCount }}</span>
                        </div>
                    </x-nav-link>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Responsive Data View</h1>

                <!-- Table view for desktop screens -->
                <div class="hidden md:block overflow-x-auto">
                    <div class="flex justify-end">
                        <a href="{{ route('requisitions.create') }}" class="bg-blue-500 text-white hover:bg-blue-700 text-sm px-2 py-1 rounded-md">Create</a>
                    </div>

          
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b-2 border-gray-200">
                                <th class="w-20 p-3 text-sm font-semibold tracking-wide text-left text-black uppercase">ID</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left text-black uppercase">Requestion Number</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left text-black uppercase">Date</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left text-black uppercase">Status</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left text-black uppercase">User</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left text-black uppercase"># Items</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left text-black uppercase">Branch</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left text-black uppercase">Type</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left text-black uppercase">Actions</th>
                            </thead>                
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($requisitions as $requisition)
                                <tr class="bg-white">
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap uppercase"> {{ $requisition->id }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap uppercase"> {{ $requisition->req_no }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap uppercase"> {{ $requisition->req_date }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap uppercase"> {{ $requisition->status }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap uppercase"> {{ $requisition->user->first_name }} {{ $requisition->user->last_name }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap uppercase"> {{ $requisition->items_count }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap uppercase"> {{ $requisition->user->branch->branch_name }}</td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap uppercase"> {{ $requisition->user->branch->type_office }}</td>

                                    <td>

                                    <a href="{{ route('requisitions.show', $requisition->id) }}" class="bg-blue-300 text-white hover:bg-blue-700 text-sm px-2 py-1 rounded-md">Show</a>
                                    @can('view', $requisition)
                                        <a href="{{ route('requisitions.edit', $requisition->id)}}" class="bg-green-500 text-white hover:bg-green-700 text-sm px-2 py-1 rounded-md">Edit</a>

                                        <form action="{{ route('requisitions.destroy', $requisition->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white hover:bg-red-700 text-sm px-2 py-1 rounded-md">Delete</button> 
                                        </form>
                                    @endcan
                                
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            {{ $requisitions->links() }}
                        </div>
                    
                </div>




    <!-- Card view for mobile screens -->
    <div class="block md:hidden">
        <div class="space-y-4">
            <div class="grid gap-8 md:grid-cols-6 lg:grid-cols-7">
                @foreach ($requisitions as $requisition)
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-900">{{ $requisition->id }}</h2>
                    <p class="text-sm text-gray-600">{{ $requisition->req_no }}</p>
                    <p class="text-sm text-gray-600">Role: {{ $requisition->req_date }}</p>
                    <div class="mt-4">
                        <button class="bg-blue-500 text-white px-3 py-1 rounded">Edit</button>
                        <button class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
                    
</x-app-layout>


    

