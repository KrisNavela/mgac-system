<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Series Status') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                <!-- resources/views/number_series/index.blade.php -->
                <form method="GET" action="{{ route('numberseries.index') }}">
                    <label for="item_id">Filter by Line:</label>
                    <select class="" id="item_id" name="item_id">
                        <option value="{{ request('item_id') }}">{{ $items->item_desc }}</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->item_desc }}</option>
                            @endforeach
                    </select>
                    
                    <label for="created_at">Filter by Date:</label>
                    <input type="date" id="created_at" name="created_at" value="">

                    <button type="submit">Filter</button>
                    <a href="{{ route('numberseries.index') }}">Reset</a> <!-- Reset filter -->
                </form>
                    
                    <table class="min-w-full divide-y divide-gray-200 mt-2">
                        <thead class="bg-gray-50">
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">ID</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Req No</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Date</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Line</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Number</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Status</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Reported?</th>
                        </thead>                
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($numberseries as $newnumberseries)
                                <tr class="px-6 py-4 whitespace-nowrap">
                                    <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase">{{ $newnumberseries->id }}</td>
                                    <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase">{{ $newnumberseries->requisition->req_no }}</td>
                                    <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase">{{ $newnumberseries->requisition->req_date }}</td>
                                    <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase">{{ $newnumberseries->item->item_desc }}</td>
                                    <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase">{{ $newnumberseries->number }}</td>
                                    <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase">{{ $newnumberseries->number_status }}</td>
                                    <td>
                                    

                                    <form action="{{ route('numberseries.update.forreported', $newnumberseries->id) }}" method="POST">
                                        @csrf
                                        @method('PUT') <!-- Specify PUT for update -->
                                        <button type="submit" class="bg-green-500 text-white hover:bg-green-700 text-sm px-2 py-1 rounded-md"
                                        onclick="return confirm('Are you sure you want to proceed this?');">Yes</button>
                                    </form>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <div>
                {{ $numberseries->links() }}
            </div>
        </div>
    </div>


    
</x-app-layout>
