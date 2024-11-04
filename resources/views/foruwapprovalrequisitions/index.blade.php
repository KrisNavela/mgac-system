<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('For Underwriting Approval') }}
        </h2>
    </x-slot>

<div class="py-7">
    <!-- Navigation Links -->
    <div class="sm:overflow-x-auto sm:whitespace-nowrap md:overflow-x-visible md:whitespace-normal">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                <x-nav-link :href="route('requisitions.index')" :active="request()->routeIs('requisitions.index')" class="bg-gray-500 text-white hover:bg-green-400 text-sm px-2 py-1 rounded-md">
                        {{ __('All') }}  
                        <div class="text-red-500 font-bold px-1 py-1 rounded relative" role="alert">
                            <span class="block sm:inline">{{ $requisitionsCount }}</span>
                        </div>
                    
                    </x-nav-link>

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
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200 mt-2">
                        <thead class="bg-gray-50">
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">ID</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Requestion Number</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Date</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Status</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">User</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase"># Items</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Branch</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Type</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Actions</th>
                        </thead>                
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($requisitions as $requisition)
                            <tr class="px-6 py-4 whitespace-nowrap">
                                <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase"> {{ $requisition->id }}</td>
                                <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase"> {{ $requisition->req_no }}</td>
                                <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase"> {{ $requisition->req_date }}</td>
                                <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase"> {{ $requisition->status }}</td>
                                <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase"> {{ $requisition->user->first_name }} {{ $requisition->user->last_name }}</td>
                                <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase"> {{ $requisition->items_count }}</td>
                                <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase"> {{ $requisition->user->branch->branch_name }}</td>
                                <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase"> {{ $requisition->user->branch->type_office }}</td>

                                <td>
                                    <a href="{{ route('foruwapprovalrequisitions.show', $requisition->id) }}" class="bg-blue-300 text-white hover:bg-blue-700 text-sm px-2 py-1 rounded-md">Show</a>
                                    <a href="{{ route('foruwapprovalrequisitions.edit', $requisition->id)}}" class="bg-green-500 text-white hover:bg-green-700 text-sm px-2 py-1 rounded-md">Edit</a>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div>
                        {{ $requisitions->links() }}
                    </div>
                </div>

                
            </div>
        </div>
    </div>


    
</x-app-layout>
