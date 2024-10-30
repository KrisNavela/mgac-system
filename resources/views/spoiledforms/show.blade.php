<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Request') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" x-data="">

                        <div class="mt-4">
                            <x-input-label for="spoiled_date" :value="__('Date')" />
                            <x-text-input id="spoiled_date" class="block mt-1 w-full" type="Date" name="spoiled_date" :value="$spoiledform->spoiled_date" disable/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="spoiled_no" :value="__('Spoiled No')" />
                            <x-text-input id="spoiled_no" class="block mt-1 w-full" type="text" name="spoiled_no" :value="$spoiledform->spoiled_no" disable/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="item_id" :value="__('Item')" />
                            <x-text-input id="item_id" class="block mt-1 w-full" type="text" name="item_id" :value="$spoiledform->item_id" disable/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="quantity" :value="__('Quantity')" />
                            <x-text-input id="quantity" class="block mt-1 w-full" type="Number" name="quantity" :value="$spoiledform->quantity" disable/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="spoiled_reason" :value="__('Reason')" />
                            <x-text-input id="spoiled_reason" class="block mt-1 w-full" type="text" name="spoiled_reason" :value="$spoiledform->spoiled_reason" disable/>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="" class="bg-green-500 text-white hover:bg-blue-700 text-sm px-2 py-1 rounded-md">
                                Edit Item
                            </a>
                        </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
