<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Branch') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mt-4">
                        <x-input-label for="branch_code" :value="__('Branch Code')" />
                        <x-text-input id="branch_code" class="block mt-1 w-full" type="text" name="branch_code" :value="$branch->branch_code" disable/>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="branch_name" :value="__('Branch Name')" />
                        <x-text-input id="branch_name" class="block mt-1 w-full" type="text" name="branch_name" :value="$branch->branch_name" disable/>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="manager_name" :value="__('Manager')" />
                        <x-text-input id="manager_name" class="block mt-1 w-full" type="text" name="manager_name" :value="$branch->manager_name" disable/>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="manager_position" :value="__('Position')" />
                        <x-text-input id="manager_position" class="block mt-1 w-full" type="text" name="manager_position" :value="$branch->manager_position" disable/>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="address1" :value="__('Address 1')" />
                        <x-text-input id="address1" class="block mt-1 w-full" type="text" name="address1" :value="$branch->address1" disable/>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="address2" :value="__('Address 2')" />
                        <x-text-input id="address2" class="block mt-1 w-full" type="text" name="address2" :value="$branch->address2" disable/>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="type_office" :value="__('Type')" />
                        <x-text-input id="type_office" class="block mt-1 w-full" type="text" name="type_office" :value="$branch->type_office" disable/>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('branches.edit', $branch->id)}}" class="bg-green-500 text-white hover:bg-blue-700 text-sm px-2 py-1 rounded-md">
                            Edit Item
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
