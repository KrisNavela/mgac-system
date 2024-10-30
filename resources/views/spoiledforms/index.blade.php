<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Spoiled Items') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end">
                        <a href="{{ route('spoiledforms.create') }}" class="bg-blue-500 text-white hover:bg-blue-700 text-sm px-2 py-1 rounded-md">Create</a>
                    </div>
                    
                    
                    
                    <table class="min-w-full divide-y divide-gray-200 mt-2">
                        <thead class="bg-gray-50">
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">ID</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Date</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">No</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">User</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Item</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Quantity</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Reason</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Action</th>
                        </thead>                
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($spoiledforms as $spoiledform)
                            <tr class="px-6 py-4 whitespace-nowrap">
                                <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase">{{ $spoiledform->id }}</td>
                                <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase">{{ $spoiledform->spoiled_date }}</td>
                                <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase">{{ $spoiledform->spoiled_no }}</td>
                                <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase">{{ $spoiledform->user->first_name }} {{ $spoiledform->user->last_name }}</td>
                                <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase">{{ $spoiledform->item->item_desc  }}</td>
                                <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase">{{ $spoiledform->quantity }}</td>
                                <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase">{{ $spoiledform->spoiled_reason }}</td>
                                <td>

                                <a href="{{ route('spoiledforms.show', $spoiledform->id)}}" class="bg-blue-300 text-white hover:bg-blue-700 text-sm px-2 py-1 rounded-md">Show</a>
                                <a href="{{ route('spoiledforms.edit', $spoiledform->id)}}" class="bg-green-500 text-white hover:bg-green-700 text-sm px-2 py-1 rounded-md">Edit</a>
                                
                                <form action="" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white hover:bg-red-700 text-sm px-2 py-1 rounded-md">Delete</button> 
                                </form>
                            
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>


    
</x-app-layout>
