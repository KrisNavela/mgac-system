<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Series Status') }}
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
        
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                <div style="display: flex; gap: 20px; justify-content: left;">
                    <!-- resources/views/numberseries/index.blade.php -->
                    <form method="GET" action="{{ route('numberseries.index') }}" style="flex: 1; max-width: 400px;">
                        <div class="">
                            <x-input-label for="item_id" :value="__('Line')" />
                            <select class="" id="item_id" name="item_id">
                                <option value="">Select an Item</option> <!-- Default option -->
                                    @foreach ($items as $item)
                                        <option 
                                            value="{{ $item->id }}" 
                                            {{ request('item_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->item_desc }}
                                        </option>
                                    @endforeach
                            </select>
                        </div>

                        @if (auth()->user()->role_id == '2')
                            <div class="mt-4">
                                <x-input-label for="branch_code" :value="__('Branch Code')" />
                                <x-text-input id="branch_code" class="block mt-1 w-full" style="width: 100px;" type="text" name="branch_code" :value="auth()->user()->branch?->branch_code" disable/>
                            </div>

                            <div class="mt-4">
                                <x-input-label for="branch_name" :value="__('Branch Name')" />
                                <x-text-input id="branch_name" class="block mt-1 w-full" style="width: 300px;" type="text" name="branch_name" :value="auth()->user()->branch?->branch_name" disable/>
                            </div>
                        @else 
                        <div class="mt-4">
                            <x-input-label for="branch_code" :value="__('Branch Code')" />
                            <select class="" id="branch_code" name="branch_code">
                                <option value="">Select Branch</option> <!-- Default option -->
                                    @foreach ($branches as $branch)
                                        <option 
                                            value="{{ $branch->branch_code }}" 
                                            {{ request('branch_code') == $branch->branch_code ? 'selected' : '' }}>
                                            {{ $branch->branch_name }}
                                        </option>
                                    @endforeach
                            </select>
                        </div>
                        @endif

                        <div class="mt-4">
                            <x-input-label for="number_status" :value="__('Status')" />
                            <select name="number_status" class="form-control">
                                <option value="" {{ request('number_status') == '' ? 'selected' : '' }}>Select a category</option>
                                <option value="Unused" {{ request('number_status') == 'Unused' ? 'selected' : '' }}>Unused</option>
                                <option value="Used" {{ request('number_status') == 'Used' ? 'selected' : '' }}>Used</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="bg-green-500 text-white hover:bg-green-700 text-sm px-2 py-1 rounded-md">Filter</button>
                            <a href="{{ route('numberseries.index') }}" class="bg-gray-500 text-white hover:bg-gray-700 text-sm px-2 py-1 rounded-md">Reset</a> <!-- Reset filter -->
                        </div>
                    </form>

                    @if ($roleId == 1 || $roleId == 11)

                    <form action="{{ route('import.series') }}" method="POST" enctype="multipart/form-data" style="flex: 1; max-width: 400px;">
                        @csrf
                        <div class="">
                            <x-input-label :value="__('Import Series')" />
                            <input type="file" name="file" required>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="bg-green-500 text-white hover:bg-green-700 text-sm px-2 py-1 rounded-md">Upload</button>
                        </div>

                    </form>
                    
                    @endif
                    
                </div>    


                <!-- Results Section -->
                @if(!request()->hasAny(['item_id']))
                    <p>No records to display. Please apply filters.</p>
                @else
                <table class="min-w-full divide-y divide-gray-200 mt-2">
                        <thead class="bg-gray-50">
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">ID</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Req No</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Date</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Line</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Branch</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Series Number</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Status</th>
                            <th class="px-6 py-3 text=left text-xs font-medium text-black uppercase">Used?</th>
                        </thead>                
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($numberseries as $newnumberseries)
                                <tr class="px-6 py-4 whitespace-nowrap">
                                    <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase">{{ $newnumberseries->id }}</td>
                                    <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase">{{ $newnumberseries->requisition->req_no }}</td>
                                    <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase">{{ $newnumberseries->requisition->req_date }}</td>
                                    <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase">{{ $newnumberseries->item->item_desc }}</td>
                                    <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase">{{ $newnumberseries->branch_name }}</td>
                                    <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase">{{ $newnumberseries->number }}</td>
                                    <td class="px-6 py-3 text=left text-xs font-medium text-gray-800 uppercase">{{ $newnumberseries->number_status }}</td>
                                    <td>
                                    

                                    <form action="{{ route('numberseries.update.forreported', $newnumberseries->id) }}?{{ http_build_query(request()->all()) }}" method="POST">
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
                @endif       
        </div>
    </div>


    
</x-app-layout>
