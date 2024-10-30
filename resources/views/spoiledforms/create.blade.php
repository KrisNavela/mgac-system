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
                    
                    <form action="{{ route('spoiledforms.store') }}" method="POST">
                        @csrf

                        <div class="mt-4" style="width: 300px;">
                            <x-input-label for="spoiled_date" :value="__('Date')" />
                            <x-text-input id="spoiled_date" class="block mt-1 w-full" type="date" name="spoiled_date" autofocus autocomplete="spoiled_date" />
                            <x-input-error :messages="$errors->get('spoiled_date')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="spoiled_no" :value="__('Spoiled No')" />
                            <x-text-input id="spoiled_no" class="block mt-1 w-full" type="text" name="spoiled_no" autofocus autocomplete="spoiled_no" />
                            <x-input-error :messages="$errors->get('spoiled_no')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="item_id" :value="__('Item')" />
                            <select name="item_id" id="item_id" required>
                                <option value="">Select a category</option>
                                @foreach($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->item_desc }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mt-4">
                            <x-input-label for="quantity" :value="__('Quantity')" />
                            <x-text-input id="quantity" class="block mt-1 w-full" type="number" name="quantity" autofocus autocomplete="quantity" />
                            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="spoiled_reason" :value="__('Reason')" />
                            <x-text-input id="spoiled_reason" class="block mt-1 w-full" type="text" name="spoiled_reason" autofocus autocomplete="spoiled_reason" />
                            <x-input-error :messages="$errors->get('spoiled_reason')" class="mt-2" />
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
