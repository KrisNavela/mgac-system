<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Request') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900"  x-data="">

        @if ($requisition->coc_request_status == 'yes')
            @if ($requisition->type_request == 'Replenishment')
                <!-- All Status -->
                <div class="flex justify-center space-x-4">
                    @if ($requisition->status == 'pending')
                        <div class="items-center p-4 rounded-lg bg-gray-500 text-white">
                    @elseif ($requisition->status == 'approved')
                        <div class="items-center p-4 rounded-lg bg-blue-500 text-white">
                    @elseif ($requisition->status == 'done')
                        <div class="items-center p-4 rounded-lg bg-green-500 text-white">
                    @endif

                        <p class="text-center font-bold">Status</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->status }}</p>

                        @if ($requisition->status == 'done')
                            <p class="uppercase text-center text-sm">{{ $requisition->updated_at }}</p>
                        @endif

                    </div>

                    @if ($requisition->bonds_status == 'No' || $requisition->bonds_status == 'no')
                        <div class="items-center p-4 rounded-lg bg-gray-500 text-white">
                    @elseif ($requisition->bonds_status == 'for approval')
                        <div class="items-center p-4 rounded-lg bg-blue-500 text-white">
                    @elseif ($requisition->bonds_status == 'approved')
                        <div class="items-center p-4 rounded-lg bg-green-500 text-white">
                    @elseif ($requisition->bonds_status == 'return')
                        <div class="items-center p-4 rounded-lg bg-red-500 text-white">
                    @endif

                        <p class="text-center font-bold">Bonds Approval</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->bonds_status }}</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->bonds_date }}</p>
                    </div>

                    @if ($requisition->uw_status == 'No' || $requisition->uw_status == 'no')
                        <div class="items-center p-4 rounded-lg bg-gray-500 text-white">
                    @elseif ($requisition->uw_status == 'for approval')
                        <div class="items-center p-4 rounded-lg bg-blue-500 text-white">
                    @elseif ($requisition->uw_status == 'approved')
                        <div class="items-center p-4 rounded-lg bg-green-500 text-white">
                    @elseif ($requisition->uw_status == 'return')
                        <div class="items-center p-4 rounded-lg bg-red-500 text-white">
                    @endif

                        <p class="text-center font-bold">UW Approval</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->uw_status }}</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->uw_date }}</p>
                    </div>

                    @if ($requisition->finalapproval_status == 'No' || $requisition->finalapproval_status == 'no')
                        <div class="items-center p-4 rounded-lg bg-gray-500 text-white">
                    @elseif ($requisition->finalapproval_status == 'For Approval' || $requisition->finalapproval_status == 'for approval')
                        <div class="items-center p-4 rounded-lg bg-blue-500 text-white">
                    @elseif ($requisition->finalapproval_status == 'approved')
                        <div class="items-center p-4 rounded-lg bg-green-500 text-white">
                    @elseif ($requisition->finalapproval_status == 'return')
                        <div class="items-center p-4 rounded-lg bg-red-500 text-white">
                    @endif

                        <p class="text-center font-bold">Final Approval</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->finalapproval_status }}</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->finalapproval_date }}</p>
                    </div>

                    @if ($requisition->collasst_status == 'no')
                        <div class="items-center p-4 rounded-lg bg-gray-500 text-white">
                    @elseif ($requisition->collasst_status == 'for approval')
                        <div class="items-center p-4 rounded-lg bg-blue-500 text-white">
                    @elseif ($requisition->collasst_status == 'approved')
                        <div class="items-center p-4 rounded-lg bg-green-500 text-white">
                    @elseif ($requisition->collasst_status == 'return')
                        <div class="items-center p-4 rounded-lg bg-red-500 text-white">
                    @endif

                        <p class="text-center font-bold">Coll Asst</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->collasst_status }}</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->collasst_date }}</p>
                    </div>

                    @if ($requisition->collmanager_status == 'no')
                        <div class="items-center p-4 rounded-lg bg-gray-500 text-white">
                    @elseif ($requisition->collmanager_status == 'for approval')
                        <div class="items-center p-4 rounded-lg bg-blue-500 text-white">
                    @elseif ($requisition->collmanager_status == 'approved')
                        <div class="items-center p-4 rounded-lg bg-green-500 text-white">
                    @elseif ($requisition->collmanager_status == 'return')
                        <div class="items-center p-4 rounded-lg bg-red-500 text-white">
                    @endif

                        <p class="text-center font-bold">Coll Manager</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->collmanager_status }}</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->collmanager_date }}</p>
                    </div>

                    @if ($requisition->treasuryapproval_status == 'no')
                        <div class="items-center p-4 rounded-lg bg-gray-500 text-white">
                    @elseif ($requisition->treasuryapproval_status == 'for approval')
                        <div class="items-center p-4 rounded-lg bg-blue-500 text-white">
                    @elseif ($requisition->treasuryapproval_status == 'approved')
                        <div class="items-center p-4 rounded-lg bg-green-500 text-white">
                    @elseif ($requisition->treasuryapproval_status == 'return')
                        <div class="items-center p-4 rounded-lg bg-red-500 text-white">
                    @endif

                        <p class="text-center font-bold">Treasury Approval</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->treasuryapproval_status }}</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->treasuryapproval_date }}</p>
                    </div>

                    @if ($requisition->cocapproval_status == 'no')
                        <div class="items-center p-4 rounded-lg bg-gray-500 text-white">
                    @elseif ($requisition->cocapproval_status == 'for approval')
                        <div class="items-center p-4 rounded-lg bg-blue-500 text-white">
                    @elseif ($requisition->cocapproval_status == 'approved')
                        <div class="items-center p-4 rounded-lg bg-green-500 text-white">
                    @elseif ($requisition->cocapproval_status == 'return')
                        <div class="items-center p-4 rounded-lg bg-red-500 text-white">
                    @endif

                        <p class="text-center font-bold">COC Approval</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->cocapproval_status }}</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->cocapproval_date }}</p>
                    </div>
                </div>
            @else
                <div class="flex justify-center space-x-4">
                    @if ($requisition->status == 'pending')
                        <div class="items-center p-4 rounded-lg bg-gray-500 text-white">
                    @elseif ($requisition->status == 'approved')
                        <div class="items-center p-4 rounded-lg bg-blue-500 text-white">
                    @elseif ($requisition->status == 'done')
                        <div class="items-center p-4 rounded-lg bg-green-500 text-white">
                    @endif

                        <p class="text-center font-bold">Status</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->status }}</p>

                        @if ($requisition->status == 'done')
                            <p class="uppercase text-center text-sm">{{ $requisition->updated_at }}</p>
                        @endif

                    </div>

                    @if ($requisition->bonds_status == 'No' || $requisition->bonds_status == 'no')
                        <div class="items-center p-4 rounded-lg bg-gray-500 text-white">
                    @elseif ($requisition->bonds_status == 'for approval')
                        <div class="items-center p-4 rounded-lg bg-blue-500 text-white">
                    @elseif ($requisition->bonds_status == 'approved')
                        <div class="items-center p-4 rounded-lg bg-green-500 text-white">
                    @elseif ($requisition->bonds_status == 'return')
                        <div class="items-center p-4 rounded-lg bg-red-500 text-white">
                    @endif

                        <p class="text-center font-bold">Bonds Approval</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->bonds_status }}</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->bonds_date }}</p>
                    </div>

                    @if ($requisition->uw_status == 'No' || $requisition->uw_status == 'no')
                        <div class="items-center p-4 rounded-lg bg-gray-500 text-white">
                    @elseif ($requisition->uw_status == 'for approval')
                        <div class="items-center p-4 rounded-lg bg-blue-500 text-white">
                    @elseif ($requisition->uw_status == 'approved')
                        <div class="items-center p-4 rounded-lg bg-green-500 text-white">
                    @elseif ($requisition->uw_status == 'return')
                        <div class="items-center p-4 rounded-lg bg-red-500 text-white">
                    @endif

                        <p class="text-center font-bold">UW Approval</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->uw_status }}</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->uw_date }}</p>
                    </div>

                    @if ($requisition->finalapproval_status == 'No' || $requisition->finalapproval_status == 'no')
                        <div class="items-center p-4 rounded-lg bg-gray-500 text-white">
                    @elseif ($requisition->finalapproval_status == 'For Approval' || $requisition->finalapproval_status == 'for approval')
                        <div class="items-center p-4 rounded-lg bg-blue-500 text-white">
                    @elseif ($requisition->finalapproval_status == 'approved')
                        <div class="items-center p-4 rounded-lg bg-green-500 text-white">
                    @elseif ($requisition->finalapproval_status == 'return')
                        <div class="items-center p-4 rounded-lg bg-red-500 text-white">
                    @endif

                        <p class="text-center font-bold">Final Approval</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->finalapproval_status }}</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->finalapproval_date }}</p>
                    </div>

                    @if ($requisition->treasuryapproval_status == 'no')
                        <div class="items-center p-4 rounded-lg bg-gray-500 text-white">
                    @elseif ($requisition->treasuryapproval_status == 'for approval')
                        <div class="items-center p-4 rounded-lg bg-blue-500 text-white">
                    @elseif ($requisition->treasuryapproval_status == 'approved')
                        <div class="items-center p-4 rounded-lg bg-green-500 text-white">
                    @elseif ($requisition->treasuryapproval_status == 'return')
                        <div class="items-center p-4 rounded-lg bg-red-500 text-white">
                    @endif

                        <p class="text-center font-bold">Treasury Approval</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->treasuryapproval_status }}</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->treasuryapproval_date }}</p>
                    </div>

                    @if ($requisition->cocapproval_status == 'no')
                        <div class="items-center p-4 rounded-lg bg-gray-500 text-white">
                    @elseif ($requisition->cocapproval_status == 'for approval')
                        <div class="items-center p-4 rounded-lg bg-blue-500 text-white">
                    @elseif ($requisition->cocapproval_status == 'approved')
                        <div class="items-center p-4 rounded-lg bg-green-500 text-white">
                    @elseif ($requisition->cocapproval_status == 'return')
                        <div class="items-center p-4 rounded-lg bg-red-500 text-white">
                    @endif

                        <p class="text-center font-bold">COC Approval</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->cocapproval_status }}</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->cocapproval_date }}</p>
                    </div>
                </div>
            @endif
        @elseif ($requisition->coc_request_status == 'no')
            @if ($requisition->type_request == 'Replenishment')
                <!-- All Status -->
                <div class="flex justify-center space-x-4">
                    @if ($requisition->status == 'pending')
                        <div class="items-center p-4 rounded-lg bg-gray-500 text-white">
                    @elseif ($requisition->status == 'approved')
                        <div class="items-center p-4 rounded-lg bg-blue-500 text-white">
                    @elseif ($requisition->status == 'done')
                        <div class="items-center p-4 rounded-lg bg-green-500 text-white">
                    @endif

                        <p class="text-center font-bold">Status</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->status }}</p>
                        
                        @if ($requisition->status == 'done')
                            <p class="uppercase text-center text-sm">{{ $requisition->updated_at }}</p>
                        @endif
                        
                    </div>

                    @if ($requisition->bonds_status == 'No' || $requisition->bonds_status == 'no')
                        <div class="items-center p-4 rounded-lg bg-gray-500 text-white">
                    @elseif ($requisition->bonds_status == 'for approval')
                        <div class="items-center p-4 rounded-lg bg-blue-500 text-white">
                    @elseif ($requisition->bonds_status == 'approved')
                        <div class="items-center p-4 rounded-lg bg-green-500 text-white">
                    @elseif ($requisition->bonds_status == 'return')
                        <div class="items-center p-4 rounded-lg bg-red-500 text-white">
                    @endif
                    
                        <p class="text-center font-bold">Bonds Approval</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->bonds_status }}</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->bonds_date }}</p>
                    </div>

                    @if ($requisition->uw_status == 'No' || $requisition->uw_status == 'no')
                        <div class="items-center p-4 rounded-lg bg-gray-500 text-white">
                    @elseif ($requisition->uw_status == 'for approval' || $requisition->uw_status == 'For Approval')
                        <div class="items-center p-4 rounded-lg bg-blue-500 text-white">
                    @elseif ($requisition->uw_status == 'approved')
                        <div class="items-center p-4 rounded-lg bg-green-500 text-white">
                    @elseif ($requisition->uw_status == 'return')
                        <div class="items-center p-4 rounded-lg bg-red-500 text-white">
                    @endif

                        <p class="text-center font-bold">UW Approval</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->uw_status }}</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->uw_date }}</p>
                    </div>

                    @if ($requisition->finalapproval_status == 'No' || $requisition->finalapproval_status == 'no')
                        <div class="items-center p-4 rounded-lg bg-gray-500 text-white">
                    @elseif ($requisition->finalapproval_status == 'For Approval' || $requisition->finalapproval_status == 'for approval')
                        <div class="items-center p-4 rounded-lg bg-blue-500 text-white">
                    @elseif ($requisition->finalapproval_status == 'approved')
                        <div class="items-center p-4 rounded-lg bg-green-500 text-white">
                    @elseif ($requisition->finalapproval_status == 'return')
                        <div class="items-center p-4 rounded-lg bg-red-500 text-white">
                    @endif

                        <p class="text-center font-bold">Final Approval</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->finalapproval_status }}</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->finalapproval_date }}</p>
                    </div>

                    @if ($requisition->collasst_status == 'No' || $requisition->collasst_status == 'no')
                        <div class="items-center p-4 rounded-lg bg-gray-500 text-white">
                    @elseif ($requisition->collasst_status == 'for approval' || $requisition->collasst_status == 'For Approval')
                        <div class="items-center p-4 rounded-lg bg-blue-500 text-white">
                    @elseif ($requisition->collasst_status == 'approved')
                        <div class="items-center p-4 rounded-lg bg-green-500 text-white">
                    @elseif ($requisition->collasst_status == 'return')
                        <div class="items-center p-4 rounded-lg bg-red-500 text-white">
                    @endif

                        <p class="text-center font-bold">Coll Asst</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->collasst_status }}</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->collasst_date }}</p>
                    </div>

                    @if ($requisition->collmanager_status == 'No')
                        <div class="items-center p-4 rounded-lg bg-gray-500 text-white">
                    @elseif ($requisition->collmanager_status == 'for approval' || $requisition->collmanager_status == 'For Approval')
                        <div class="items-center p-4 rounded-lg bg-blue-500 text-white">
                    @elseif ($requisition->collmanager_status == 'approved')
                        <div class="items-center p-4 rounded-lg bg-green-500 text-white">
                    @elseif ($requisition->collmanager_status == 'return')
                        <div class="items-center p-4 rounded-lg bg-red-500 text-white">
                    @endif

                        <p class="text-center font-bold">Coll Manager</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->collmanager_status }}</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->collmanager_date }}</p>
                    </div>
                </div>
            @else
            <div class="flex justify-center space-x-4">
                    @if ($requisition->status == 'pending')
                        <div class="items-center p-4 rounded-lg bg-gray-500 text-white">
                    @elseif ($requisition->status == 'approved')
                        <div class="items-center p-4 rounded-lg bg-blue-500 text-white">
                    @elseif ($requisition->status == 'done')
                        <div class="items-center p-4 rounded-lg bg-green-500 text-white">
                    @endif

                        <p class="text-center font-bold">Status</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->status }}</p>
                        
                        @if ($requisition->status == 'done')
                            <p class="uppercase text-center text-sm">{{ $requisition->updated_at }}</p>
                        @endif
                        
                    </div>

                    @if ($requisition->bonds_status == 'No' || $requisition->bonds_status == 'no')
                        <div class="items-center p-4 rounded-lg bg-gray-500 text-white">
                    @elseif ($requisition->bonds_status == 'for approval')
                        <div class="items-center p-4 rounded-lg bg-blue-500 text-white">
                    @elseif ($requisition->bonds_status == 'approved')
                        <div class="items-center p-4 rounded-lg bg-green-500 text-white">
                    @elseif ($requisition->bonds_status == 'return')
                        <div class="items-center p-4 rounded-lg bg-red-500 text-white">
                    @endif

                        <p class="text-center font-bold">Bonds Approval</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->bonds_status }}</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->bonds_date }}</p>
                    </div>

                    @if ($requisition->uw_status == 'No' || $requisition->uw_status == 'no')
                        <div class="items-center p-4 rounded-lg bg-gray-500 text-white">
                    @elseif ($requisition->uw_status == 'for approval')
                        <div class="items-center p-4 rounded-lg bg-blue-500 text-white">
                    @elseif ($requisition->uw_status == 'approved')
                        <div class="items-center p-4 rounded-lg bg-green-500 text-white">
                    @elseif ($requisition->uw_status == 'return')
                        <div class="items-center p-4 rounded-lg bg-red-500 text-white">
                    @endif

                        <p class="text-center font-bold">UW Approval</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->uw_status }}</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->uw_date }}</p>
                    </div>

                    @if ($requisition->finalapproval_status == 'No' || $requisition->finalapproval_status == 'no')
                        <div class="items-center p-4 rounded-lg bg-gray-500 text-white">
                    @elseif ($requisition->finalapproval_status == 'For Approval' || $requisition->finalapproval_status == 'for approval')
                        <div class="items-center p-4 rounded-lg bg-blue-500 text-white">
                    @elseif ($requisition->finalapproval_status == 'approved')
                        <div class="items-center p-4 rounded-lg bg-green-500 text-white">
                    @elseif ($requisition->finalapproval_status == 'return')
                        <div class="items-center p-4 rounded-lg bg-red-500 text-white">
                    @endif

                        <p class="text-center font-bold">Final Approval</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->finalapproval_status }}</p>
                        <p class="uppercase text-center text-sm">{{ $requisition->finalapproval_date }}</p>
                    </div>
                </div>
            @endif
        @endif

                <div class="p-6 text-gray-900"  x-data="{
                            requisitionItems: {{ $requisitionItems }},
                            addItem() {
                                this.requisitionItems.push({
                                    id: null,
                                    unreported: 0,
                                    quantity: 1,
                                    unit: 'Pad',
                                    ho_ctrl_start: 0,
                                    ho_ctrl_end: 0,
                                    coc_prefix: 'A',
                                    series_start: 0,
                                    series_end: 0,
                                });
                            },
                            removeItem(index) {
                                this.requisitionItems.splice(index, 1);
                            }}">
                                    
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
                                                                        <td> 
                                                                            <a href="{{ Storage::url($attachment->file_path) }}" target="_blank" class="bg-green-500 text-white hover:bg-green-700 text-sm px-1 py-1 rounded-md">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                                                                                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                                                                                </svg>
                                                                            </a> 
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
                        
                        
                                    
    <div class="flex justify-end">    
        <!-- Button to open the modal -->
        <button class="bg-blue-500 text-white px-4 py-2 rounded" onclick="toggleModal('modal-id')">Remarks</button>
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


                <form action="{{ route('donerequisitions.update', $requisition->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mt-4">
                            <x-input-label for="req_no" :value="__('Requisition Number')" />
                            <x-text-input id="req_no" class="block mt-1 w-full" type="text" name="req_no" :value="old('req_no', $requisition->req_no)" autofocus autocomplete="req_no" />
                            <x-input-error :messages="$errors->get('req_no')" class="mt-2" />
                        </div>

                        <div class="mt-4" style="width: 300px;">
                            <x-input-label for="req_date" :value="__('Request Date')" />
                            <x-text-input id="req_date" class="block mt-1 w-full" type="text" name="req_date" :value="$requisition->req_date" disable/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <x-text-input id="status" class="block mt-1 w-full text-gray-500 uppercase" style="width: 150px" type="text" name="status" :value="old('status', $requisition->status)" autofocus autocomplete="status" />
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="full_name" :value="__('Request By')" />
                            <x-text-input id="full_name" class="block mt-1 w-full" style="width: 300px;" type="text" name="full_name" value="{{ $requisition->user->first_name }} {{ $requisition->user->last_name }}" autofocus autocomplete="full_name" />
                            <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="branch_name" :value="__('Branch Name')" />
                            <x-text-input id="branch_name" class="block mt-1 w-full" style="width: 150px" type="text" name="branch_name" :value="old('branch_name', $requisition->user->branch->branch_name)" autofocus autocomplete="branch_name" />
                            <x-text-input id="branch_code" class="block mt-1 w-full" style="width: 150px" type="text" name="branch_code" :value="old('branch_code', $requisition->user->branch->branch_code)" autofocus autocomplete="branch_code" />
                            <x-input-error :messages="$errors->get('branch_name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="type_request" :value="__('Type of Request')" />
                            <x-text-input id="type_request" class="block mt-1 w-full text-gray-500 uppercase" style="width: 150px" type="text" name="type_request" :value="old('type_request', $requisition->type_request)" autofocus autocomplete="type_request" />
                            <x-input-error :messages="$errors->get('type_request')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="coc_request_status" :value="__('COC Request')" />
                            <x-text-input id="coc_request_status" class="block mt-1 w-full uppercase" style="width: 300px;" type="text" name="coc_request_status" value="{{ $requisition->coc_request_status }}" autofocus autocomplete="coc_request_status" />
                            <x-input-error :messages="$errors->get('coc_request_status')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="replenishment_month" :value="__('Month')" />
                            <x-text-input id="replenishment_month" class="block mt-1 w-full " type="text" style="width: 150px" name="replenishment_month" :value="$requisition->replenishment_month" disable/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="replenishment_year" :value="__('Year')" />
                            <x-text-input id="replenishment_year" class="block mt-1 w-full" type="text" style="width: 150px" name="replenishment_year" :value="$requisition->replenishment_year" disable/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="remarks" :value="__('Remarks')" />
                            <x-text-input id="remarks" class="block mt-1 w-full" type="text" name="remarks" :value="$requisition->remarks" disable/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="delivery_name" :value="__('Courier Name')" />
                            <x-text-input id="delivery_name" class="block mt-1 w-full" type="text" name="delivery_name" :value="$requisition->delivery_name" disable/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="delivery_no" :value="__('Courier Ref No.')" />
                            <x-text-input id="delivery_no" class="block mt-1 w-full" type="text" name="delivery_no" :value="$requisition->delivery_no" disable/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="delivery_status" :value="__('Status')" />

                            <select id="delivery_status" name="delivery_status" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                <option value="delivered" {{ $requisition->delivery_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="pending" {{ $requisition->delivery_status == 'pending' ? 'selected' : '' }}>Pending</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="delivery_date" :value="__('Delivery Date & Time')" />
                            <x-text-input id="delivery_date" class="block mt-1 w-full" type="datetime-local" name="delivery_date" 
                                :value="old('delivery_date', $requisition->delivery_date ? \Carbon\Carbon::parse($requisition->delivery_date)->format('Y-m-d\TH:i') : '')" />
                        </div>

                        <div style="overflow-x: auto; width: 100%;">
                            <table class="min-w-[1200px] text-xs border" style="border-collapse: collapse;">
                                <thead class="bg-gray-50">
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase" style="text-align: center;">Item Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase" style="text-align: center;">Unreported</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase" style="text-align: center;">Quantity</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase" style="text-align: center;">Unit</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase" style="text-align: center;">HO Ctrl Start</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase" style="text-align: center;">HO Ctrl End</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase" style="text-align: center;">COC Prefix</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase" style="text-align: center;">Series Start</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase" style="text-align: center;">Series End</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase" style="text-align: center;"></th>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <template x-for="(item, index) in requisitionItems" :key="index">
                                        <tr class="hover:bg-gray-200">
                                            <td class="px-1 py-1">
                                                <select class="" x-model="item.item_id" :name="'items['+index+'][item_id]'" >
                                                    <option value="">Please Select Item</option>
                                                    @foreach($items as $item)
                                                        <option value="{{ $item->id }}">{{ $item->item_desc }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="px-2 py-2">
                                                <input type="number" x-model="item.unreported" :name="'items['+index+'][unreported]'" style="width: 100px;">
                                            </td>
                                            <td class="px-1 py-1">
                                                <input type="number" style="width: 100px" x-model="item.quantity" :name="'items['+index+'][quantity]'"> 
                                            </td>
                                            <td class="px-1 py-1">
                                                <select class="" x-model="item.quantity_unit" :name="'items['+index+'][quantity_unit]'">
                                                    <option value="Pad" {{ 'pad' === $requisition->quantity_unit ? 'selected' : '' }}>Pad</option>
                                                    <option value="Pcs" {{ 'pcs' === $requisition->quantity_unit ? 'selected' : '' }}>Pcs</option>
                                                    <option value="Set" {{ 'set' === $requisition->quantity_unit ? 'selected' : '' }}>Set</option>
                                                    <option value="Ream" {{ 'ream' === $requisition->quantity_unit ? 'selected' : '' }}>Ream</option>
                                                </select>
                                            </td>

                                            <td class="px-1 py-1">
                                                <input type="number" style="width: 100px" x-model="item.ho_ctrl_start" :name="'items['+index+'][ho_ctrl_start]'"> 
                                            </td>

                                            <td class="px-1 py-1">
                                                <input type="number" style="width: 100px" x-model="item.ho_ctrl_end" :name="'items['+index+'][ho_ctrl_end]'"> 
                                            </td>

                                            <td class="px-1 py-1">
                                                <input type="text" style="width: 100px" x-model="item.coc_prefix" :name="'items['+index+'][coc_prefix]'"> 
                                            </td>

                                            <td class="px-1 py-1">
                                                <input type="number" style="width: 100px" x-model="item.series_start" :name="'items['+index+'][series_start]'"> 
                                            </td>

                                            <td class="px-1 py-1">
                                                <input type="number" style="width: 100px" x-model="item.series_end" :name="'items['+index+'][series_end]'"> 
                                            </td>

                                        </tr>
                                    </template>
                                </tbody>
                            </table>

                        </div>

                        <div class="flex justify-end space-x-4">
                            <div class="flex items-center justify-end mt-4">
                                <button class="bg-green-500 text-white hover:bg-green-700 text-sm px-2 py-1 rounded-md">
                                    Delivered
                                </button>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <a href="{{ url('/fortransmittal/' . $requisition->id . '/print') }}" target="_blank" class="bg-red-500 text-white hover:bg-red-700 text-sm px-2 py-1 rounded-md">Print PDF</a>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <a href="{{ route('donerequisitions.index') }}" class="bg-gray-700 text-white hover:bg-gray-900 text-sm px-2 py-1 rounded-md">Done</a>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
            
        </div>
    </div>



    
</x-app-layout>




