<!--Add Main modal -->
<div id="add-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Add New Candidate
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="add-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" action="{{route('candidates.add')}}" method="POST">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter Student Name" required="">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="student_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student ID</label>
                        <input type="text" name="student_id" id="student_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="example: 210220302" required="">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="course" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Course</label>
                        <input type="text" name="course" id="course" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="example: BSIT" required="">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="college" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">College</label>
                        <select id="college" name="college_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected  value="">Select College</option>
                            @foreach($colleges as $collegeData)
                            <option value="{{$collegeData->college_id}}">{{$collegeData->name}} ({{$collegeData->acronym}})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="organization" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Organization</label>
                        <select id="organization" name="organization_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected  value="">Select Organization</option>
                            @foreach($organization as $organizationData)
                            <option value="{{$organizationData->organization_id}}">{{$organizationData->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="partylist" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Party List</label>
                        <select id="partylist" name="partylist_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected  value="">Select PartyList</option>
                            @foreach($partylist as $partylistData)
                            <option value="{{$partylistData->partylist_id}}">{{$partylistData->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="position" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Position</label>
                        <select id="position" name="position_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected  value="">Select Position</option>
                            @foreach($position as $positionData)
                            <option value="{{$positionData->position_id}}">{{$positionData->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit" class="inline-flex text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Add Candidate
                </button>
            </form>
        </div>
    </div>
</div>

<!--Edit Main modal -->
@foreach($candidate as $candidateData)
<div id="edit-modal{{$candidateData->student_id}}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Edit Candidate
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit-modal{{$candidateData->student_id}}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" action="{{route('candidates.edit')}}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter Student Name" required="" value="{{$candidateData->name}}">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="student_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student ID</label>
                        <input type="text" name="student_id" id="student_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="example: 210220302" required="" value="{{$candidateData->student_id}}">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="course" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Course</label>
                        <input type="text" name="course" id="course" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="example: BSIT" required="" value="{{$candidateData->course}}">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="college" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">College</label>
                        <select id="college" name="college_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected value="">Select College</option>
                            @foreach($colleges as $collegeData)
                            <option value="{{$collegeData->college_id}}"  {{$collegeData->college_id == $candidateData->college_id ? 'selected' : '' }}>{{$collegeData->name}} ({{$collegeData->acronym}})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="organization" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Organization</label>
                        <select id="organization" name="organization_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected  value="">Select Organization</option>
                            @foreach($organization as $organizationData)
                            <option value="{{$organizationData->organization_id}}" {{$organizationData->organization_id == $candidateData->organization_id ? 'selected' : '' }}>{{$organizationData->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="partylist" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Party List</label>
                        <select id="partylist" name="partylist_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected  value="">Select PartyList</option>
                            @foreach($partylist as $partylistData)
                            <option value="{{$partylistData->partylist_id}}" {{$partylistData->partylist_id == $candidateData->partylist_id ? 'selected' : '' }}>{{$partylistData->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="position" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Position</label>
                        <select id="position" name="position_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected value="">Select Position</option>
                            @foreach($position as $positionData)
                            <option value="{{$positionData->position_id}}" {{ $positionData->position_id == $candidateData->position_id ? 'selected' : '' }}>{{$positionData->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <input type="hidden" name="findID" value="{{$candidateData->student_id}}">
                <button type="submit" class="inline-flex text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                    <img src="{{asset('images/update_icon.svg')}}" alt="UpdateLogo" class="w-5 h-5 mr-2.5">
                    Update Candidate
                </button>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Delete modal -->
@foreach($candidate as $candidateData)
<div id="delete-modal{{$candidateData->student_id}}" data-modal-backdrop="static" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="delete-modal{{$candidateData->student_id}}">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this Record?</h3>
                <form action="{{route('candidates.deleteOne')}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="student_id" value="{{$candidateData->student_id}}">
                    <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Yes, I'm sure
                    </button>
                    <button data-modal-hide="delete-modal{{$candidateData->student_id}}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Profile modal -->
@foreach($candidate as $candidateData)
<div id="profile-modal{{$candidateData->student_id}}" data-modal-backdrop="static" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="profile-modal{{$candidateData->student_id}}">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <h1>This is profile modal</h1>
                <button data-modal-hide="profile-modal{{$candidateData->student_id}}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
            </div>
        </div>
    </div>
</div>
@endforeach