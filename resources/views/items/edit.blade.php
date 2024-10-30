<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                <div class="flex justify-end">    
                    <!-- Button to open the modal -->
                    <button class="bg-blue-500 text-white px-4 py-2 rounded" onclick="toggleModal('modalAddStock-id')">Add Stock</button>
                </div>
                        
                <div id="modalAddStock-id" class="fixed z-50 inset-0 hidden bg-black bg-opacity-50 flex justify-center items-center">
                <div class="bg-white p-6 rounded-lg shadow-lg w-2/3">
                    <div class="flex justify-end"> 
                        <button class="bg-red-500 text-white text-sm px-2 py-1 rounded-md" onclick="toggleModal('modalAddStock-id')">
                            Close
                        </button>
                    </div>

                        <div class="py-2" style="font-size: 12px;">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                        <table class="min-w-full divide-y divide-gray-200 mt-2">
                        <thead class="bg-gray-50">
                            <th class="px-1 py-1 text=left text-sm text-gray-500 uppercase" style="font-size: 11px; font-weight: bold; color: #333;">CV Number</th>
                            <th class="px-1 py-1 text=left text-sm text-gray-500 uppercase" style="font-size: 11px; font-weight: bold; color: #333;">Date Purchase</th>
                            <th class="px-1 py-1 text=left text-sm text-gray-500 uppercase" style="font-size: 11px; font-weight: bold; color: #333;">Quantity</th>
                            <th class="px-1 py-1 text=left text-sm text-gray-500 uppercase" style="font-size: 11px; font-weight: bold; color: #333;">Remarks</th>
                            <th class="px-1 py-1 text=left text-sm text-gray-500 uppercase" style="font-size: 11px; font-weight: bold; color: #333;">Add By</th>
                        </thead>                
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($itemOrders as $itemOrder)
                        <tr class="px-1 py-1 whitespace-nowrap">
                            <td> {{ $itemOrder->cv_no }}</td>
                            <td> {{ $itemOrder->date_purchase }}</td>
                            <td> {{ $itemOrder->add_stock }}</td>
                            <td> {{ $itemOrder->order_remarks }}</td>
                            <td> {{ $itemOrder->user->first_name }} {{ $itemOrder->user->last_name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>


                        <form method="POST" action="{{ route('items.update.addstock', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mt-4">
                                <x-input-label for="cv_no" :value="__('CV Number')" />
                                <x-text-input id="cv_no" class="block mt-1 w-full" type="text" name="cv_no" autofocus autocomplete="cv_no" />
                                <x-input-error :messages="$errors->get('cv_no')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="add_quantity" :value="__('Quantity')" />
                                <x-text-input id="add_quantity" class="block mt-1 w-full" type="number" name="add_quantity" value="0" autofocus autocomplete="add_quantity" />
                                <x-input-error :messages="$errors->get('add_quantity')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="date_purchase" :value="__('Date Purchase')" />
                                <x-text-input id="date_purchase" class="block mt-1 w-full" type="date" name="date_purchase" autofocus autocomplete="date_purchase" />
                                <x-input-error :messages="$errors->get('date_purchase')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="remarks_purchase" :value="__('Remarks')" />
                                <x-text-input id="remarks_purchase" class="block mt-1 w-full" type="text" name="remarks_purchase" autofocus autocomplete="remarks_purchase" />
                                <x-input-error :messages="$errors->get('remarks_purchase')" class="mt-2" />
                            </div>


                            <div class="py-2">
                                <button class="bg-green-500 text-white hover:bg-green-700 text-sm px-2 py-1 rounded-md">
                                    Save
                                </button>
                            </div>
                        </form>

                        </div>
                        </div>
                        </div>
                </div>
                </div>






            <!-- Add this JavaScript for modal functionality -->
            <script>
                function toggleModal(modalID) {
                    let modal = document.getElementById(modalID);
                    modal.classList.toggle('hidden');
                }
            </script>


                <form action="{{ route('items.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mt-4">
                            <x-input-label for="item_code" :value="__('Item Code')" />
                            <x-text-input id="item_code" class="block mt-1 w-full" type="text" name="item_code" :value="old('item_code', $item->item_code)" autofocus autocomplete="item_code" />
                            <x-input-error :messages="$errors->get('item_code')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="item_desc" :value="__('Item Description')" />
                            <x-text-input id="item_desc" class="block mt-1 w-full" type="text" name="item_desc" :value="old('item_desc', $item->item_desc)" autofocus autocomplete="item_desc" />
                            <x-input-error :messages="$errors->get('item_desc')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="quantity" :value="__('Quantity')" />
                            <x-text-input id="quantity" class="block mt-1 w-full" type="text" name="quantity" :value="old('quantity', $item->quantity)" autofocus autocomplete="quantity" />
                            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="totalrequest" :value="__('Total Request')" />
                            <x-text-input id="totalrequest" class="block mt-1 w-full" type="number" name="totalrequest" :value="old('totalrequest', $item->requisitions_sum_item_requisitionin_pcs)" autofocus autocomplete="totalrequest" />
                            <x-input-error :messages="$errors->get('totalrequest')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="totalspoiled" :value="__('Total Spoiled')" />
                            <x-text-input id="totalspoiled" class="block mt-1 w-full" type="number" name="totalspoiled" :value="old('totalspoiled', $item->spoiled_forms_sum_quantity)" autofocus autocomplete="totalspoiled" />
                            <x-input-error :messages="$errors->get('totalspoiled')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="currentstock" :value="__('Current Stock')" />
                            <x-text-input id="currentstock" class="block mt-1 w-full" type="number" name="currentstock" :value="$item->quantity - $item->requisitions_sum_item_requisitionin_pcs - $item->spoiled_forms_sum_quantity" autofocus autocomplete="currentstock" />
                            <x-input-error :messages="$errors->get('currentstock')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-green-500 text-white hover:bg-blue-700 text-sm px-2 py-1 rounded-md">
                                Update Item
                        </div>
                    </form>




                </div>
            </div>
        </div>
    </div>
</x-app-layout>
