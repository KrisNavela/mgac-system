<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Request') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

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
                                });
                            },
                            removeItem(index) {
                                this.requisitionItems.splice(index, 1);
                            }}">



                <form action="{{ route('cancelrequisitions.update', $requisition->id) }}" method="POST">
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

                        <div class="mt-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <select name="status" id="">
                                <option value="pending" {{ 'pending' === $requisition->status ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ 'approved' === $requisition->status ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ 'rejected' === $requisition->status ? 'selected' : '' }}>Rejected</option>
                                <option value="cancelled" {{ 'cancelled' === $requisition->status ? 'selected' : '' }}>cancelled</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
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
                            <x-input-label for="user_id" :value="__('User ID')" />
                            <x-text-input id="user_id" class="block mt-1 w-full" type="text" name="user_id" :value="old('user_id', $requisition->user_id)" autofocus autocomplete="user_id" />
                            <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
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
                                            <select class="" x-model="item.item_id" :name="'items['+index+'][item_id]'" >
                                                <option value="">Please Select Item</option>
                                                @foreach($items as $item)
                                                    <option value="{{ $item->id }}">{{ $item->item_desc }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="px-2 py-2">
                                            <input type="number" x-model="item.unreported" :name="'items['+index+'][unreported]'">
                                        </td>
                                        <td class="px-2 py-2">
                                            <input type="number" x-model="item.quantity" :name="'items['+index+'][quantity]'"> 
                                        </td>
                                        <td class="px-2 py-2">
                                            <input type="number" x-model="item.quantity_unit" :name="'items['+index+'][quantity_unit]'"> 
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


                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
