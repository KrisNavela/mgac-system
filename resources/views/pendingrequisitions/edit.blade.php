<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Request') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900"  x-data="{
                            requisitionItems: {{ $requisitionItems }},
                            addItem() {
                                this.requisitionItems.push({
                                    id: null,
                                    quantity: 1,
                                    unit: 'Pad',
                                });
                            },
                            removeItem(index) {
                                this.requisitionItems.splice(index, 1);
                            }}">

        <div class="flex justify-center space-x-4">
            <div class="w-1/2 p-4 bg-gray-200">
                <p class="text-center">Status</p>
                <p class="uppercase text-center">{{ $requisition->status }}</p>
            </div>
            <div class="w-1/2 p-4 bg-gray-200">
                <p>Bonds Approval</p>
                <p class="uppercase">{{ $requisition->bonds_status }}</p>
            </div>
            <div class="w-1/2 p-4 bg-gray-200">
                <p>UW Approval</p>
                <p class="uppercase">{{ $requisition->uw_tatus }}</p>
            </div>
            <div class="w-1/2 p-4 bg-gray-200">
                <p>Final Approval</p>
                <p class="uppercase">{{ $requisition->finalapproval_status }}</p>
            </div>
            <div class="w-1/2 p-4 bg-gray-200">
                <p>Treasury Approval</p>
                <p class="uppercase">{{ $requisition->treasuryapproval_status }}</p>
            </div>
            <div class="w-1/2 p-4 bg-gray-200">
                <p>COC Approval</p>
                <p class="uppercase">{{ $requisition->cocapproval_status }}</p>
            </div>
        </div>



                            <div class="flex justify-end space-x-4">
                                        <div class="flex justify-end">    
                                            <!-- Button to open the modal -->
                                            <button class="bg-blue-500 text-white px-4 py-2 rounded" onclick="toggleModal('modalAttachment-id')">Attachment</button>
                                        </div>
                                    
                                            <div id="modalAttachment-id" class="fixed z-50 inset-0 hidden bg-black bg-opacity-50 flex justify-center items-center">
                                            <div class="bg-white p-6 rounded-lg shadow-lg w-2/3">
                                                <div class="flex justify-end"> 
                                                <button class="bg-red-500 text-white text-sm px-2 py-1 rounded-md" onclick="toggleModal('modalAttachment-id')">
                                                    Close
                                                </button>
                                                </div>
                                    
                                    
                                                    <div class="py-2" style="font-size: 16px; font-weight: bold; color: #333;">
                                                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                                                            <table class="min-w-full divide-y divide-gray-200 mt-2">
                                                                <thead class="bg-gray-50">
                                                                    <th class="px-3 py-2 text=left text-sm text-gray-500 uppercase">Path</th>
                                                                    <th class="px-3 py-2 text=left text-sm text-gray-500 uppercase">Action</th>
                                                                </thead>                
                                                                <tbody class="bg-white divide-y divide-gray-200">
                                                                    @foreach ($attachments as $attachment)
                                                                    <tr class="px-4 py-3 whitespace-nowrap">
                                                                        <td> <a href="{{ Storage::url($attachment->file_path) }}" target="_blank">{{ $attachment->file_path }}</a> </td>
                                                                        <td> <a href="{{ Storage::url($attachment->file_path) }}" target="_blank" class="bg-green-500 text-white hover:bg-green-700 text-sm px-1 py-1 rounded-md">Download File</a> </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        
                                    
                                                        
                                                    </div>
                                                    </div>
                                                    </div>
                                            </div>
                                            </div>
                        
                        
                                
    <div class="flex justify-end">    
        <!-- Button to open the modal -->
        <button class="bg-blue-500 text-white px-4 py-2 rounded" onclick="toggleModal('modal-id')">Action</button>
    </div>

        <div id="modal-id" class="fixed z-50 inset-0 hidden bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-2/3">
            <div class="flex justify-end"> 
            <button class="bg-red-500 text-white text-sm px-2 py-1 rounded-md" onclick="toggleModal('modal-id')">
                Close
            </button>
            </div>


                <div class="py-2" style="font-size: 11px; font-weight: bold; color: #333;">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 mt-2">
                        <thead class="bg-gray-50">
                            <th class="px-1 py-1 text=left text-sm text-gray-500 uppercase" style="font-size: 11px; font-weight: bold; color: #333;">Date</th>
                            <th class="px-1 py-1 text=left text-sm text-gray-500 uppercase" style="font-size: 11px; font-weight: bold; color: #333;">Content</th>
                            <th class="px-1 py-1 text=left text-sm text-gray-500 uppercase" style="font-size: 11px; font-weight: bold; color: #333;">Name</th>
                        </thead>                
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($remarks as $remark)
                            <tr class="px-1 py-1 whitespace-nowrap">
                                <td> {{ $remark->created_at }}</td>
                                <td> {{ $remark->content }}</td>
                                <td> {{ $remark->user->first_name }} {{ $remark->user->last_name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <form method="POST" action="{{ route('pendingrequisitions.update.forapproval', $requisition->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mt-4">
                            <x-input-label for="content" :value="__('Content')" />
                            <x-text-input id="content" class="block mt-1 w-full" type="text" name="content" :value="old('content', $requisition->content)" autofocus autocomplete="content" />
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>
                        
                        @if ($requisition->type_request != 'Replenishment')
                        <div class="mt-4">
                            <x-input-label for="bonds_status_modal" :value="__('For bonds approval?')" />
                            <select name="bonds_status_modal" id="">
                                <option value="no" {{ 'no' === $requisition->bonds_status ? 'selected' : '' }}>No</option>
                                <option value="for approval" {{ 'for approval' === $requisition->bonds_status ? 'selected' : '' }}>For Approval</option>
                                <option value="approved" {{ 'approved' === $requisition->bonds_status ? 'selected' : '' }}>Approved</option>
                                <option value="return" {{ 'return' === $requisition->bonds_status ? 'selected' : '' }}>Return</option>
                            </select>
                            <x-input-error :messages="$errors->get('bonds_status_modal')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="uw_status_modal" :value="__('For UW approval?')" />
                            <select name="uw_status_modal" id="">
                                <option value="no" {{ 'no' === $requisition->uw_status ? 'selected' : '' }}>No</option>
                                <option value="for approval" {{ 'for approval' === $requisition->uw_status ? 'selected' : '' }}>For Approval</option>
                                <option value="approved" {{ 'approved' === $requisition->uw_status ? 'selected' : '' }}>Approved</option>
                                <option value="return" {{ 'return' === $requisition->uw_status ? 'selected' : '' }}>Return</option>
                            </select>
                            <x-input-error :messages="$errors->get('uw_status_modal')" class="mt-2" />
                        </div>

                        <div class="py-2">
                            <button class="bg-green-500 text-white hover:bg-green-700 text-sm px-2 py-1 rounded-md">
                                Save
                            </button>
                        </div>
                        @endif
                    </form>

                    
                </div>
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


                <form action="{{ route('pendingrequisitions.update', $requisition->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mt-4">
                            <x-input-label for="req_no" :value="__('Requisition Number')" />
                            <x-text-input id="req_no" class="block mt-1 w-full" type="text" name="req_no" :value="old('req_no', $requisition->req_no)" autofocus autocomplete="req_no" />
                            <x-input-error :messages="$errors->get('req_no')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="req_date" :value="__('Date')" />
                            <x-text-input id="req_date" class="block mt-1 w-full" type="date" name="req_date" :value="old('req_date', $requisition->req_date)" autofocus autocomplete="req_date" />
                            <x-input-error :messages="$errors->get('req_date')" class="mt-2" />
                        </div>

                        @if ($requisition->type_request == 'Addition' || $requisition->type_request == 'Initial')
                        <div class="mt-4">
                            <x-input-label for="status" :value="__('Request status')" />
                            <select name="status" id="">
                                <option value="pending" {{ 'pending' === $requisition->status ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ 'approved' === $requisition->status ? 'selected' : '' }}>Approved</option>
                                <option value="return" {{ 'return' === $requisition->status ? 'selected' : '' }}>Return</option>
                                <option value="cancelled" {{ 'cancelled' === $requisition->status ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>
                        @endif

                        @if ($requisition->type_request == 'Replenishment')
                        <div class="mt-4">
                            <x-input-label for="status" :value="__('Request status')" />
                            <select name="status" id="">
                                <option value="pending" {{ 'pending' === $requisition->status ? 'selected' : '' }}>Pending</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>
                        @endif



                        <div class="mt-4">
                            <x-input-label for="finalapproval_status" :value="__('For Final Approval?')" />
                            <select name="finalapproval_status" id="">
                                <option value="for approval" {{ 'for approval' === $requisition->finalapproval_status ? 'selected' : '' }}>For Approval</option>
                                <option value="approved" {{ 'approved' === $requisition->finalapproval_status ? 'selected' : '' }}>Approved</option>
                                <option value="return" {{ 'return' === $requisition->finalapproval_status ? 'selected' : '' }}>Return</option>
                                <option value="cancelled" {{ 'cancelled' === $requisition->finalapproval_status ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <x-input-error :messages="$errors->get('finalapproval_status')" class="mt-2" />
                        </div>

                        <!--
                        <div class="mt-4">
                            <x-input-label for="bonds_status" :value="__('For bonds approval?')" />
                            <select name="bonds_status" id="">
                                <option value="no" {{ 'no' === $requisition->bonds_status ? 'selected' : '' }}>No</option>
                                <option value="for approval" {{ 'for approval' === $requisition->bonds_status ? 'selected' : '' }}>For Approval</option>
                                <option value="approved" {{ 'approved' === $requisition->bonds_status ? 'selected' : '' }}>Approved</option>
                                <option value="return" {{ 'return' === $requisition->bonds_status ? 'selected' : '' }}>Return</option>
                            </select>
                            <x-input-error :messages="$errors->get('bonds_status')" class="mt-2" />
                        </div>
                        
                        <div class="mt-4">
                            <x-input-label for="uw_status" :value="__('For UW approval?')" />
                            <select name="uw_status" id="">
                                <option value="no" {{ 'no' === $requisition->uw_status ? 'selected' : '' }}>No</option>
                                <option value="for approval" {{ 'for approval' === $requisition->uw_status ? 'selected' : '' }}>For Approval</option>
                                <option value="approved" {{ 'approved' === $requisition->uw_status ? 'selected' : '' }}>Approved</option>
                                <option value="return" {{ 'return' === $requisition->uw_status ? 'selected' : '' }}>Return</option>
                            </select>
                            <x-input-error :messages="$errors->get('uw_status')" class="mt-2" />
                        </div>
                        -->

                        <div class="mt-4">
                            <x-input-label for="full_name" :value="__('Request By')" />
                            <x-text-input id="full_name" class="block mt-1 w-full" style="width: 300px;" type="text" name="full_name" value="{{ $requisition->user->first_name }} {{ $requisition->user->last_name }}" autofocus autocomplete="full_name" />
                            <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="type_request" :value="__('Type of Request')" />
                            <select name="type_request" id="">
                                <option value="Initial" {{ 'Initial' === $requisition->type_request ? 'selected' : '' }}>Initial</option>
                                <option value="Additional" {{ 'Additional' === $requisition->type_request ? 'selected' : '' }}>Additional</option>
                                <option value="Replenishment" {{ 'Replenishment' === $requisition->type_request ? 'selected' : '' }}>Replenishment</option>
                            </select>
                            <x-input-error :messages="$errors->get('type_request')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="coc_request_status" :value="__('COC Request')" />
                            <x-text-input id="coc_request_status" class="block mt-1 w-full" style="width: 300px;" type="text" name="coc_request_status" value="{{ $requisition->coc_request_status }}" autofocus autocomplete="coc_request_status" />
                            <x-input-error :messages="$errors->get('coc_request_status')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="replenishment_month" :value="__('Month')" />
                            <x-text-input id="replenishment_month" class="block mt-1 w-full" type="text" name="replenishment_month" :value="$requisition->replenishment_month" disable/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="replenishment_year" :value="__('Year')" />
                            <x-text-input id="replenishment_year" class="block mt-1 w-full" type="text" name="replenishment_year" :value="$requisition->replenishment_year" disable/>
                        </div>

                        <table class="min-w-full divide-y divide-gray-200 mt-2">
                            <thead class="bg-gray-50">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Item Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Unit</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"></th>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <template x-for="(item, index) in requisitionItems" :key="index">
                                    <tr class="hover:bg-gray-200">
                                        <td class="px-2 py-2">
                                            <select class="" x-model="item.item_id" :name="'items['+index+'][item_id]'" >
                                                <option value="">Please Select Item</option>
                                                @foreach($items as $item)
                                                    <option value="{{ $item->id }}">{{ $item->item_desc }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="px-2 py-2">
                                            <input type="number" x-model="item.quantity" :name="'items['+index+'][quantity]'"> 
                                        </td>
                                        <td class="px-2 py-2">
                                            <select class="" x-model="item.quantity_unit" :name="'items['+index+'][quantity_unit]'">
                                                <option value="Pad" {{ 'pad' === $requisition->quantity_unit ? 'selected' : '' }}>Pad</option>
                                                <option value="Pcs" {{ 'pcs' === $requisition->quantity_unit ? 'selected' : '' }}>Pcs</option>
                                                <option value="Set" {{ 'set' === $requisition->quantity_unit ? 'selected' : '' }}>Set</option>
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
                            <button class="bg-green-500 text-white hover:bg-green-700 text-sm px-2 py-1 rounded-md">
                                Update Requisition
                            </button>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    
</x-app-layout>




