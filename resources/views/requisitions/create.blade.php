<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Requisition') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900" x-data="{
        items: [{
            id: null,
            quantity: 1,
            unit: 'Pad',
            unreportedCount: 0
        }],
        
        addItem() {
            this.items.push({
                id: null,
                quantity: 1,
                unit: 'Pad',
                unreportedCount: 0
            });
        },
        
        removeItem(index) {
            this.items.splice(index, 1);
        },
        
        // Function to fetch unreported count
        fetchUnreportedCount(event, index) {
            const itemId = event.target.value;

            if (itemId) {
                fetch(`/get-unreported-count?item_id=${itemId}`)
                    .then(response => response.json())
                    .then(data => {
                        this.items[index].unreportedCount = data.count;
                    })
                    .catch(error => {
                        console.error('Error fetching unreported count:', error);
                    });
            } else {
                this.items[index].unreportedCount = 0;
            }
        }
    }">
               
                
                    <form action="{{ route('requisitions.store') }}" method="POST" onsubmit="disableSubmitButton(this)">
                        @csrf
                            <!--
                            <div class="mt-4" style="width: 300px;">
                                <x-input-label for="req_date" :value="__('Date')" />
                                <x-text-input id="req_date" class="block mt-1 w-full" type="datetime-local" name="req_date" autofocus autocomplete="req_date" value="{{ old('req_date', date('Y-m-d H:i:s')) }}"/>
                                <x-input-error :messages="$errors->get('req_date')" class="mt-2" />
                            </div>
                            -->
                            <div class="mt-4">
                                <x-input-label for="type_request" :value="__('Type of Request')" />
                                <select class="" style="width: 200px;" id="type_request" class="block mt-1 w-full" type="text" name="type_request" autofocus autocomplete="type_request">
                                    <option value="Initial">Initial</option>
                                    <option value="Additional">Additional</option>
                                    <option value="Replenishment">Replenishment</option>
                                </select>
                                <x-input-error :messages="$errors->get('type_request')" class="mt-2" />
                            </div>

                            <div class="mt-4" style="width: 100px;">
                                <x-input-label for="coc_request_status" :value="__('COC Request')" />
                                <select class="" style="width: 100px;" id="coc_request_status" class="block mt-1 w-full" type="text" name="coc_request_status" autofocus autocomplete="coc_request_status">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                                <x-input-error :messages="$errors->get('coc_request_status')" class="mt-2" />
                            </div>

                            <div class="mt-4" style="width: 100px;">
                                <x-input-label for="replenishment_month" :value="__('Month')" />
                                <x-text-input id="replenishment_month" class="block mt-1 w-full" type="text" name="replenishment_month" autofocus autocomplete="replenishment_month" />
                                <x-input-error :messages="$errors->get('replenishment_month')" class="mt-2" />
                            </div>

                            <div class="mt-4" style="width: 100px;">
                                <x-input-label for="replenishment_year" :value="__('Year')" />
                                <x-text-input id="replenishment_year" class="block mt-1 w-full" type="text" name="replenishment_year" autofocus autocomplete="replenishment_year" />
                                <x-input-error :messages="$errors->get('replenishment_year')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="remarks" :value="__('Remarks')" />
                                <x-text-input id="remarks" class="block mt-1 w-full" type="text" name="remarks" autofocus autocomplete="remarks" />
                                <x-input-error :messages="$errors->get('remarks')" class="mt-2" />
                            </div>

                        <table class="min-w-full divide-y divide-gray-200 mt-2">
                            <thead class="bg-gray-50">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Item Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Unreported</th>
                                <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                                <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase">Unit</th>
                                <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase"></th>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            
                            
                                <template x-for="(item, index) in items" :key="index">
                                    <tr class="hover:bg-gray-200">
                                        <td class="px-2 py-2">
                                            <select 
                                                class="form-select"  
                                                id="dropdown"
                                                x-model="item.id"
                                                :name="'items['+index+'][id]'"
                                                @change="fetchUnreportedCount($event, index)"
                                            >
                                                <option value="">Please Select Item</option>
                                                    @foreach($items as $item)
                                                        <option value="{{ $item->id }}">{{ $item->item_desc }}</option>
                                                    @endforeach
                                            </select>
                                        </td>

                                        <td class="px-2 py-2">
                                            <input 
                                                type="number" 
                                                class="form-input"
                                                x-model="item.unreportedCount"
                                                :name="'items[' + index + '][unreportedCount]'"
                                                min="0"
                                                style="width: 100px;"
                                                readonly
                                            >
                                        </td>

                                        <td class="px-2 py-2">
                                            <input type="number" style="width: 100px;" x-model="item.quantity" :name="'items['+index+'][quantity]'">
                                        </td>
                                        <td class="px-2 py-2">
                                            <select class="" x-model="item.quantity_unit" :name="'items['+index+'][quantity_unit]'">
                                                <option value="Pad">Pad</option>
                                                <option value="Pcs">Pcs</option>
                                                <option value="Set">Set</option>
                                                <option value="Ream">Ream</option>
                                            </select>
                                        </td>
                                        <td class="px-2 py-2">
                                            <button type="button" class="bg-red-500 text-white hover:bg-red-700 text-sm px-2 py-1 rounded-md" @click="removeItem(index)">Remove</button>
                                        </td>
                                    </tr>
                                </template>
                            
                            </tbody>
                        </table>

                        <div>
                            <button type="button" @click="addItem" class="bg-blue-500 text-white hover:bg-blue-700 text-sm px-2 py-1 rounded-md">
                                Add Item
                            </button>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" id="submitButton" class="bg-blue-500 text-white hover:bg-blue-700 text-sm px-2 py-1 rounded-md">
                                Create Item
                            </button>
                        </div>
                    </form>

                    
                    
                    <script>
                        function disableSubmitButton(form) {
                            // Find the submit button inside the form
                            const submitButton = form.querySelector('#submitButton');
                            
                            // Disable the button and change its text (optional)
                            submitButton.disabled = true;
                            submitButton.innerText = 'Creating...';
                            
                            return true; // Allow form submission to continue
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
