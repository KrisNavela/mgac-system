<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                

            <div class="p-6 text-gray-900">
                <div class="overflow-x-auto max-h-[500px] overflow-y-auto">
                    <table class="min-w-full divide-y divide-gray-200 mt-2">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase">First Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase">Last Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase">Branch</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase">Action</th>
                            </tr>
                        </thead>                
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)
                            <tr>
                                <td class="px-6 py-3 text-xs text-gray-800 uppercase">{{ $user->id }}</td>
                                <td class="px-6 py-3 text-xs text-gray-800 uppercase">{{ $user->first_name }}</td>
                                <td class="px-6 py-3 text-xs text-gray-800 uppercase">{{ $user->last_name }}</td>
                                <td class="px-6 py-3 text-xs text-gray-800 lowercase">{{ $user->email }}</td>
                                <td class="px-6 py-3 text-xs text-gray-800 uppercase">{{ $user->role->name }}</td>
                                <td class="px-6 py-3 text-xs text-gray-800 uppercase">{{ $user->branch->branch_name }}</td>
                                <td class="px-6 py-3">
                                    <a href="{{ route('users.edit', $user->id)}}" class="bg-green-500 text-white hover:bg-green-700 text-sm px-2 py-1 rounded-md">Edit</a>
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
