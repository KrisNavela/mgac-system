<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Branches') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                <div class="flex justify-end">
                    <a href="{{ route('branches.create') }}" class="bg-blue-500 text-white hover:bg-blue-700 text-sm px-2 py-1 rounded-md">Create</a>
                </div>
                    
                    
                    <div class="overflow-x-auto max-h-[500px] overflow-y-auto">
                        <table class="min-w-full divide-y divide-gray-200 mt-2">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase">Code</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase">Branch</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase">Manager</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase">Position</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase">Address 1</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase">Address 2</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase">Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($branches as $branch)
                                <tr>
                                    <td class="px-6 py-3 text-xs text-gray-800 uppercase">{{ $branch->id }}</td>
                                    <td class="px-6 py-3 text-xs text-gray-800 uppercase">{{ $branch->branch_code }}</td>
                                    <td class="px-6 py-3 text-xs text-gray-800 uppercase">{{ $branch->branch_name }}</td>
                                    <td class="px-6 py-3 text-xs text-gray-800 uppercase">{{ $branch->manager_name }}</td>
                                    <td class="px-6 py-3 text-xs text-gray-800 uppercase">{{ $branch->manager_position }}</td>
                                    <td class="px-6 py-3 text-xs text-gray-800 uppercase">{{ $branch->address1 }}</td>
                                    <td class="px-6 py-3 text-xs text-gray-800 uppercase">{{ $branch->address2 }}</td>
                                    <td class="px-6 py-3 text-xs text-gray-800 uppercase">{{ $branch->type_office }}</td>
                                    <td class="px-6 py-3 space-x-1">
                                        <a href="{{ route('branches.show', $branch->id) }}" class="bg-blue-300 text-white hover:bg-blue-700 text-sm px-2 py-1 rounded-md">Show</a>
                                        <a href="{{ route('branches.edit', $branch->id) }}" class="bg-green-500 text-white hover:bg-green-700 text-sm px-2 py-1 rounded-md">Edit</a>
                                        <form action="{{ route('branches.destroy', $branch->id) }}" method="POST" class="inline">
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
    </div>
</x-app-layout>
