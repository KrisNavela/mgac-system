<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Request') }}
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
                    @elseif ($requisition->status == 'cancelled')
                        <div class="items-center p-4 rounded-lg bg-red-500 text-white">
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
                    @elseif ($requisition->status == 'cancelled')
                        <div class="items-center p-4 rounded-lg bg-red-500 text-white">
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
                    @elseif ($requisition->status == 'cancelled')
                        <div class="items-center p-4 rounded-lg bg-red-500 text-white">
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

                    @if ($requisition->collmanager_status == 'No' || $requisition->collmanager_status == 'no')
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
                    @elseif ($requisition->status == 'cancelled')
                        <div class="items-center p-4 rounded-lg bg-red-500 text-white">
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


                <div class="p-6 text-gray-900" x-data="{requisitionItems: {{ $requisitionItems }}}">

                <div class="flex justify-end space-x-4">
                    <div class="flex justify-end">      
                        <!-- Button to open the modal -->
                        <button class="bg-blue-500 text-white px-4 py-2 rounded" onclick="toggleModal('modalAttachment-id')">Attachment</button>
                    </div>



                
                    <div id="modalAttachment-id" class="fixed z-50 inset-0 hidden bg-black bg-opacity-50 flex justify-center items-start overflow-y-auto">
                        <div class="bg-white p-6 rounded-lg shadow-lg w-2/3 mt-10 mb-10 max-h-screen overflow-y-auto">


                            <!-- Modal Header -->
                            <div class="flex justify-between items-center border-b px-6 py-4">
                                <h2 class="text-lg font-semibold text-gray-800">Attachments</h2>
                                <button onclick="toggleModal('modalAttachment-id')" class="text-gray-500 hover:text-red-600 transition">
                                    ✕
                                </button>
                            </div>
                
                
                            <!-- Modal Body -->
                            <div class="max-h-[60vh] overflow-y-auto border border-gray-200 rounded-md">
                                <table class="w-full divide-y divide-gray-200 text-sm table-auto">
                                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                                        <tr>
                                            <th class="px-4 py-2 text-left">Path</th>
                                            <th class="px-4 py-2 text-left">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach ($attachments as $attachment)
                                        <tr>
                                            <td class="px-4 py-2 break-words whitespace-normal max-w-full">
                                                <a href="{{ Storage::url($attachment->file_path) }}"
                                                target="_blank"
                                                class="text-blue-600 hover:underline break-all">
                                                    {{ $attachment->file_path }}
                                                </a>
                                            </td>
                                            <td class="px-4 py-2">
                                                <a href="{{ Storage::url($attachment->file_path) }}"
                                                target="_blank"
                                                class="inline-flex items-center bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md transition">
                                                    
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
    
                    <div class="flex justify-end">    
                        <!-- Button to open the modal -->
                        <button class="bg-blue-500 text-white px-4 py-2 rounded" onclick="toggleModal('modal-id')">Remarks</button>
                    </div>

                        <div id="modal-id" class="fixed z-50 inset-0 hidden bg-black bg-opacity-50 flex justify-center items-start overflow-y-auto">
                            <div class="bg-white p-6 rounded-lg shadow-lg w-2/3 mt-10 mb-10 max-h-screen overflow-y-auto">

                                <!-- Modal Header -->
                                <div class="flex justify-between items-center border-b px-6 py-4">
                                    <h2 class="text-lg font-semibold text-gray-800">Action</h2>
                                    <button onclick="toggleModal('modal-id')" class="text-gray-500 hover:text-red-600 transition">
                                        ✕
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
                                                    
                                                    <div class="mt-4">
                                                        <x-input-label for="content" :value="__('Content')" />
                                                        <x-text-input id="content" class="block mt-1 w-full" type="text" name="content" :value="old('content', $requisition->content)" autofocus autocomplete="content" />
                                                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
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

                        <div class="mt-4">
                            <x-input-label for="req_no" :value="__('Requistion Number')" />
                            <x-text-input id="req_no" class="block mt-1 w-full text-gray-500 uppercase" style="width: 300px;" type="text" name="req_no" :value="$requisition->req_no" disable/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="req_date" :value="__('Request Date')" />
                            <x-text-input id="req_date" class="block mt-1 w-full text-gray-500 uppercase" style="width: 300px;" type="text" name="req_date" :value="$requisition->req_date" disable/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="full_name" :value="__('Request By')" />
                            <x-text-input id="full_name" class="block mt-1 w-full text-gray-500 uppercase" style="width: 300px;" type="text" name="full_name" value="{{ $requisition->user->first_name }} {{ $requisition->user->last_name }}" autofocus autocomplete="full_name" />
                            <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="branch_name" :value="__('Branch Name')" />
                            <x-text-input id="branch_name" class="block mt-1 w-full text-gray-500 uppercase" style="width: 500px" type="text" name="branch_name" :value="old('branch_name', $requisition->user->branch->branch_name)" autofocus autocomplete="branch_name" />
                            <x-input-error :messages="$errors->get('branch_name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="type_request" :value="__('Type of Request')" />
                            <x-text-input id="type_request" class="block mt-1 w-full text-gray-500 uppercase" style="width: 300px;" type="text" name="type_request" :value="$requisition->type_request" disable/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="coc_request_status" :value="__('COC Request')" />
                            <x-text-input id="coc_request_status" class="block mt-1 w-full text-gray-500 uppercase" style="width: 300px;" type="text" name="coc_request_status" value="{{ $requisition->coc_request_status }}" autofocus autocomplete="coc_request_status" />
                            <x-input-error :messages="$errors->get('coc_request_status')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="replenishment_month" :value="__('Month')" />
                            <x-text-input id="replenishment_month" class="block mt-1 w-full text-gray-500 uppercase" style="width: 150px;" type="text" name="replenishment_month" :value="$requisition->replenishment_month" disable/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="replenishment_year" :value="__('Year')" />
                            <x-text-input id="replenishment_year" class="block mt-1 w-full text-gray-500 uppercase" style="width: 150px;" type="text" name="replenishment_year" :value="$requisition->replenishment_year" disable/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="remarks" :value="__('Remarks')" />
                            <x-text-input id="remarks" class="block mt-1 w-full text-gray-500 uppercase" type="text" name="remarks" :value="$requisition->remarks" disable/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="delivery_name" :value="__('Courier Name')" />
                            <x-text-input id="delivery_name" class="block mt-1 w-full text-gray-500 uppercase" type="text" name="delivery_name" :value="$requisition->delivery_name" disable/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="delivery_no" :value="__('Courier Ref No.')" />
                            <x-text-input id="delivery_no" class="block mt-1 w-full text-gray-500 uppercase" type="text" name="delivery_no" :value="$requisition->delivery_no" disable/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="delivery_status" :value="__('Status')" />
                            <x-text-input id="delivery_status" class="block mt-1 w-full text-gray-500 uppercase" type="text" name="delivery_status" :value="$requisition->delivery_status" disable/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="delivery_date" :value="__('Delivery Date & Time')" />
                            <x-text-input id="delivery_date" class="block mt-1 w-full text-gray-500 uppercase" style="width: 300px;" type="text" name="delivery_date" :value="$requisition->delivery_date" disable/>
                        </div>


                                <div class="max-h-64 overflow-y-auto border border-gray-200 rounded-md">
                                    <table class="min-w-full divide-y divide-gray-200 text-xs">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="p-1 text-gray-500 uppercase text-center">Name</th>
                                                <th class="p-1 text-gray-500 uppercase text-center">Quantity</th>
                                                <th class="p-1 text-gray-500 uppercase text-center">Unit</th>
                                                <th class="p-1 text-gray-500 uppercase text-center">HO Ctrl Start</th>
                                                <th class="p-1 text-gray-500 uppercase text-center">HO Ctrl End</th>
                                                <th class="p-1 text-gray-500 uppercase text-center">COC Prefix</th>
                                                <th class="p-1 text-gray-500 uppercase text-center">Series Start</th>
                                                <th class="p-1 text-gray-500 uppercase text-center">Series End</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <template x-for="(item, index) in requisitionItems" :key="index">
                                                <tr class="hover:bg-gray-200">
                                                <td class="px-2 py-2">
                                                        <select class="" x-model="item.item_id" class="w-24 h-7 text-xs">
                                                            <option value="">Please Select Item</option>
                                                            @foreach($items as $item)
                                                                <option value="{{ $item->id }}">{{ $item->item_desc }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>

                                                    <td class="px-2 py-2">
                                                        <input type="number" class="w-24 h-7 text-xs" style="width: 80px" x-model="item.quantity"/>
                                                    </td>

                                                    <td class="px-2 py-2">
                                                        <input type="text" class="w-24 h-7 text-xs" style="width: 50px"x-model="item.quantity_unit "/>
                                                    </td>

                                                    <td class="px-2 py-2">
                                                        <input type="text" class="w-24 h-7 text-xs" style="width: 140px" x-model="item.ho_ctrl_start "/>
                                                    </td>

                                                    <td class="px-2 py-2">
                                                        <input type="text" class="w-24 h-7 text-xs" style="width: 140px" x-model="item.ho_ctrl_end "/>
                                                    </td>

                                                    <td class="px-2 py-2">
                                                        <input type="text" class="w-24 h-7 text-xs" style="width: 50px" x-model="item.coc_prefix "/>
                                                    </td>

                                                    <td class="px-2 py-2">
                                                        <input type="text" class="w-24 h-7 text-xs" style="width: 140px" x-model="item.series_start "/>
                                                    </td>

                                                    <td class="px-2 py-2">
                                                        <input type="text" class="w-24 h-7 text-xs" style="width: 140px" x-model="item.series_end "/>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>

                                </div>

            </div>
        </div>
    </div>
</x-app-layout>
