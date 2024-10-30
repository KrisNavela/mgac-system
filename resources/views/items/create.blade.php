<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('items.store') }}" method="POST">
                        @csrf
                        <div class="mt-4">
                            <x-input-label for="item_code" :value="__('Item Code')" />
                            <x-text-input id="item_code" class="block mt-1 w-full" type="text" name="item_code" autofocus autocomplete="item_code" />
                            <x-input-error :messages="$errors->get('item_code')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="item_desc" :value="__('Item Description')" />
                            <x-text-input id="item_desc" class="block mt-1 w-full" type="text" name="item_desc" autofocus autocomplete="item_desc" />
                            <x-input-error :messages="$errors->get('item_desc')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="quantity" :value="__('Quantity')" />
                            <x-text-input id="quantity" class="block mt-1 w-full" type="text" name="quantity" autofocus autocomplete="quantity" />
                            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 text-white hover:bg-blue-700 text-sm px-2 py-1 rounded-md">
                                Create Item
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
