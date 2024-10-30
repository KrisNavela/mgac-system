<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Items') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end">
                        <a href="{{ route('items.create') }}" class="bg-blue-500 text-white hover:bg-blue-700 text-sm px-2 py-1 rounded-md">Create</a>
                    </div>
                    
                    
                    
                    <table class="min-w-full divide-y divide-gray-200 mt-2">
                        <thead class="bg-gray-50">
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">ID</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Item Code</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Description</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Total Quantity</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Total Request</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Total Spoiled</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Current Stock</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Action</th>
                        </thead>                
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($items as $item)
                            <tr class="px-6 py-4 whitespace-nowrap">
                                <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase">{{ $item->id }}</td>
                                <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase"> {{ $item->item_code }}</td>
                                <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase">{{ $item->item_desc }}</td>
                                <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase">{{ $item->quantity }}</td>
                                <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase">{{ $item->requisitions_sum_item_requisitionin_pcs }}</td>
                                <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase">{{ $item->spoiled_forms_sum_quantity }}</td>
                                <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase">{{ $item->quantity - $item->requisitions_sum_item_requisitionin_pcs - $item->spoiled_forms_sum_quantity }}</td>
                                <td>

                                <a href="{{ route('items.show', $item->id) }}" class="bg-blue-300 text-white hover:bg-blue-700 text-sm px-2 py-1 rounded-md">Show</a>
                                <a href="{{ route('items.edit', $item->id)}}" class="bg-green-500 text-white hover:bg-green-700 text-sm px-2 py-1 rounded-md">Edit</a>
                                
                                <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white hover:bg-red-700 text-sm px-2 py-1 rounded-md">Delete</button> 
                                </form>
                            
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div>
                        {{ $items->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>


    
</x-app-layout>
