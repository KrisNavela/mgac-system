<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Branch') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <form action="{{ route('branches.update', $branch->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mt-4">
                            <x-input-label for="branch_code" :value="__('Branch Code')" />
                            <x-text-input id="branch_code" class="block mt-1 w-full" type="text" name="branch_code" :value="old('branch_code', $branch->branch_code)" autofocus autocomplete="branch_code" />
                            <x-input-error :messages="$errors->get('branch_code')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="branch_name" :value="__('Branch Name')" />
                            <x-text-input id="branch_name" class="block mt-1 w-full" type="text" name="branch_name" :value="old('branch_name', $branch->branch_name)" autofocus autocomplete="branch_name" />
                            <x-input-error :messages="$errors->get('branch_name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="manager_name" :value="__('Manager')" />
                            <x-text-input id="manager_name" class="block mt-1 w-full" type="text" name="manager_name" :value="old('manager_name', $branch->manager_name)" autofocus autocomplete="manager_name" />
                            <x-input-error :messages="$errors->get('manager_name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="manager_position" :value="__('Position')" />
                            <x-text-input id="manager_position" class="block mt-1 w-full" type="text" name="manager_position" :value="old('manager_position', $branch->manager_position)" autofocus autocomplete="manager_position" />
                            <x-input-error :messages="$errors->get('manager_position')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="address1" :value="__('Address 1')" />
                            <x-text-input id="address1" class="block mt-1 w-full" type="text" name="address1" :value="old('address1', $branch->address1)" autofocus autocomplete="address1" />
                            <x-input-error :messages="$errors->get('address1')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="address2" :value="__('Address 2')" />
                            <x-text-input id="address2" class="block mt-1 w-full" type="text" name="address2" :value="old('address2', $branch->address2)" autofocus autocomplete="address2" />
                            <x-input-error :messages="$errors->get('address2')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="type_office" :value="__('Type')" />
                            <x-text-input id="type_office" class="block mt-1 w-full" type="text" name="type_office" :value="old('type_office', $branch->type_office)" autofocus autocomplete="type_office" />
                            <x-input-error :messages="$errors->get('type_office')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-green-500 text-white hover:bg-blue-700 text-sm px-2 py-1 rounded-md">
                                Update
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
