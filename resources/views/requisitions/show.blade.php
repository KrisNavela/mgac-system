<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Request') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" x-data="{requisitionItems: {{ $requisitionItems }}}">

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

                                <div class="mt-4">
                                    <x-input-label for="content" :value="__('Content')" />
                                    <x-text-input id="content" class="block mt-1 w-full" type="text" name="content" :value="old('content', $requisition->content)" autofocus autocomplete="content" />
                                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                                </div>

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

                        <div class="mt-4">
                            <x-input-label for="req_no" :value="__('Requistion Number')" />
                            <x-text-input id="req_no" class="block mt-1 w-full" type="text" name="req_no" :value="$requisition->req_no" disable/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="req_date" :value="__('Request Date')" />
                            <x-text-input id="req_date" class="block mt-1 w-full" type="text" name="req_date" :value="$requisition->req_date" disable/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <x-text-input id="status" class="block mt-1 w-full text-gray-500 uppercase" type="text" name="status" :value="$requisition->status" disable/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="user_id" :value="__('User ID')" />
                            <x-text-input id="user_id" class="block mt-1 w-full" type="text" name="user_id" :value="$requisition->user_id" disable/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="type_request" :value="__('Type of Request')" />
                            <x-text-input id="type_request" class="block mt-1 w-full" type="text" name="type_request" :value="$requisition->type_request" disable/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="coc_request_status" :value="__('COC Request')" />
                            <x-text-input id="coc_request_status" class="block mt-1 w-full" type="text" name="coc_request_status" :value="$requisition->coc_request_status" disable/>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Unit</th>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                                <template x-for="(item, index) in requisitionItems" :key="index">
                                    <tr class="hover:bg-gray-200">
                                    <td class="px-2 py-2">
                                            <select class="" x-model="item.item_id" >
                                                <option value="">Please Select Item</option>
                                                @foreach($items as $item)
                                                    <option value="{{ $item->id }}">{{ $item->item_desc }}</option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td class="px-2 py-2">
                                            <input type="number" x-model="item.quantity"/>
                                        </td>

                                        <td class="px-2 py-2">
                                            <input type="text" x-model="item.quantity_unit "/>
                                        </td>
                                    </tr>
                                </template>
                        </tbody>
                    </table>



                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('requisitions.edit', $requisition->id)}}" class="bg-green-500 text-white hover:bg-blue-700 text-sm px-2 py-1 rounded-md">
                                Edit Item
                            </a>
                        </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
