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

        <div class="p-6 text-gray-900" x-data="{
        requisitionItems: {{ $requisitionItems }},
        
        addItem() {
            this.requisitionItems.push({
                id: null,
                quantity: 1,
                unit: 'Pad',
                unreported: 0
            });
        },
        
        removeItem(index) {
            this.requisitionItems.splice(index, 1);
        },
        
        // Function to fetch unreported count
        fetchUnreportedCount(event, index) {
            const itemId = event.target.value;

            if (itemId) {
                fetch(`/get-unreported-count-reviewer?item_id=${itemId}`)
                    .then(response => response.json())
                    .then(data => {
                        this.requisitionItems[index].unreported = data.count;
                    })
                    .catch(error => {
                        console.error('Error fetching unreported count:', error);
                    });
            } else {
                this.requisitionItems[index].unreported = 0;
            }
        }
    }">

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
                        
                        
                                
    <div class="flex justify-end space-x-4">
        <!-- Button to open the modal -->
        <button class="bg-blue-500 text-white px-4 py-2 rounded" onclick="toggleModal('modal-id')">Action</button>
    </div>

        <div id="modal-id" class="fixed z-50 inset-0 hidden bg-black bg-opacity-50 flex justify-center items-start overflow-y-auto">
            <div class="bg-white p-6 rounded-lg shadow-lg w-2/3 mt-10 mb-10 max-h-screen overflow-y-auto">
                <div class="flex justify-end">
                    <button class="bg-red-500 text-white text-sm px-2 py-1 rounded-md" onclick="toggleModal('modal-id')">
                        Close
                    </button>
                </div>
                    
                    <div class="py-2" style="font-size: 11px; font-weight: bold; color: #333;">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


                            <div class="py-4 text-sm text-gray-800 font-semibold">
                                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                    <div class="bg-white shadow-sm sm:rounded-lg p-4">

                                        <!-- Remarks Table (Scrollable) -->
                                        <div class="overflow-y-auto max-h-60 border border-gray-200 rounded-md">
                                            <table class="min-w-full divide-y divide-gray-200 text-xs">
                                                <thead class="bg-gray-100 uppercase text-gray-600 font-bold">
                                                    <tr>
                                                        <th class="px-2 py-2 text-left">Date</th>
                                                        <th class="px-2 py-2 text-left">Content</th>
                                                        <th class="px-2 py-2 text-left">Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    @foreach ($remarks as $remark)
                                                    <tr>
                                                        <td class="px-2 py-1">{{ $remark->created_at }}</td>
                                                        <td class="px-2 py-1">{{ $remark->content }}</td>
                                                        <td class="px-2 py-1">{{ $remark->user->first_name }} {{ $remark->user->last_name }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>


                                        <!-- Remarks Form -->
                                        <form method="POST" action="{{ route('pendingrequisitions.update.forapproval', $requisition->id) }}">
                                            @csrf
                                            @method('PUT')

                                            <!-- Content Field -->
                                            <div class="mt-4">
                                                <x-input-label for="content" :value="__('Content')" />
                                                <x-text-input id="content" class="mt-1 w-full" type="text" name="content"
                                                    :value="old('content', $requisition->content)" required />
                                                <x-input-error :messages="$errors->get('content')" class="mt-2" />
                                            </div>

                                            <!-- Conditional Approval Fields -->
                                            @if ($requisition->type_request == 'Replenishment' && $requisition->coc_request_status == 'no')
                                                @include('components.select-approval', [
                                                    'field' => 'bonds_status_modal',
                                                    'label' => 'For bonds approval?',
                                                    'options' => ['no'],
                                                    'selected' => $requisition->bonds_status
                                                ])
                                                @include('components.select-approval', [
                                                    'field' => 'uw_status_modal',
                                                    'label' => 'For UW approval?',
                                                    'options' => ['no'],
                                                    'selected' => $requisition->uw_status
                                                ])
                                            @else
                                                @include('components.select-approval', [
                                                    'field' => 'bonds_status_modal',
                                                    'label' => 'For bonds approval?',
                                                    'options' => ['no', 'for approval', 'approved', 'return'],
                                                    'selected' => $requisition->bonds_status
                                                ])
                                                @include('components.select-approval', [
                                                    'field' => 'uw_status_modal',
                                                    'label' => 'For UW approval?',
                                                    'options' => ['no', 'for approval', 'approved', 'return'],
                                                    'selected' => $requisition->uw_status
                                                ])
                                            @endif

                                            <!-- Final Approval Field -->
                                            @include('components.select-approval', [
                                                'field' => 'finalapproval_status_modal',
                                                'label' => 'For final approval?',
                                                'options' => ['no', 'for approval', 'return'],
                                                'selected' => $requisition->finalapproval_status
                                            ])

                                            <!-- Submit Button -->
                                            <div class="mt-4">
                                                <button class="bg-green-500 hover:bg-green-700 text-white text-sm font-medium px-4 py-2 rounded">
                                                    Save
                                                </button>
                                            </div>
                                        </form>
                                        <div class="mt-4">
                                            <a href="{{ route('pendingrequisitions.update.forcancel', $requisition->id) }}" class="bg-red-500 hover:bg-red-700 text-white text-sm font-medium px-4 py-2 rounded"
                                            onclick="return confirm('Are you sure you want to cancel this requisition?');">Cancel Requisitioin</a>
                                        </div>
                                    </div>
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

                <!-- Success Notification -->
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <form action="{{ route('pendingrequisitions.update', $requisition->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mt-4">
                            <x-input-label for="req_no" :value="__('Requisition Number')" />
                            <x-text-input id="req_no" class="block mt-1 w-full" style="width: 300px;" type="text" name="req_no" :value="old('req_no', $requisition->req_no)" autofocus autocomplete="req_no" />
                            <x-input-error :messages="$errors->get('req_no')" class="mt-2" />
                        </div>

                        <div class="mt-4" style="width: 300px;">
                            <x-input-label for="req_date" :value="__('Request Date')" />
                            <x-text-input id="req_date" class="block mt-1 w-full" type="text" name="req_date" :value="$requisition->req_date" disable/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="full_name" :value="__('Request By')" />
                            <x-text-input id="full_name" class="block mt-1 w-full" style="width: 300px;" type="text" name="full_name" value="{{ $requisition->user->first_name }} {{ $requisition->user->last_name }}" autofocus autocomplete="full_name" />
                            <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="branch_name" :value="__('Branch Name')" />
                            <x-text-input id="branch_name" class="block mt-1 w-full" style="width: 400px" type="text" name="branch_name" :value="old('branch_name', $requisition->user->branch->branch_name)" autofocus autocomplete="branch_name" />
                            <x-input-error :messages="$errors->get('branch_name')" class="mt-2" />
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
                            <x-text-input id="coc_request_status" class="block mt-1 w-full uppercase" style="width: 100px;" type="text" name="coc_request_status" value="{{ $requisition->coc_request_status }}" autofocus autocomplete="coc_request_status" />
                            <x-input-error :messages="$errors->get('coc_request_status')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="replenishment_month" :value="__('Month')" />
                            <x-text-input id="replenishment_month" class="block mt-1 w-full" style="width: 100px;" type="text" name="replenishment_month" :value="$requisition->replenishment_month" disable/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="replenishment_year" :value="__('Year')" />
                            <x-text-input id="replenishment_year" class="block mt-1 w-full" style="width: 100px;" type="text" name="replenishment_year" :value="$requisition->replenishment_year" disable/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="remarks" :value="__('Remarks')" />
                            <x-text-input id="remarks" class="block mt-1 w-full" type="text" name="remarks" :value="$requisition->remarks" disable/>
                        </div>

                        <table class="min-w-full divide-y divide-gray-200 mt-2">
                            <thead class="bg-gray-50">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Item Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Unreported</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Unit</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"></th>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                
                            <template x-for="(item, index) in requisitionItems" :key="index">
                                    <tr class="hover:bg-gray-200">
                                        
                                        <td class="px-2 py-2">
                                            <select 
                                                class="form-select"  
                                                id="dropdown"
                                                x-model="item.item_id"
                                                :name="'items['+index+'][item_id]'"
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
                                                x-model="item.unreported"
                                                :name="'items[' + index + '][unreported]'"
                                                min="0"
                                                style="width: 100px;"
                                                readonly
                                            >
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

                <!-- Optional Auto-Close JavaScript -->
                <script>
                    setTimeout(function() {
                        let alert = document.querySelector('[role="alert"]');
                        if (alert) {
                            alert.style.transition = "opacity 0.5s ease";
                            alert.style.opacity = "0";
                            setTimeout(() => alert.remove(), 500);
                        }
                    }, 3000); // Hide after 3 seconds
                </script>  

                </div>
            </div>
        </div>
    </div>



    
</x-app-layout>




