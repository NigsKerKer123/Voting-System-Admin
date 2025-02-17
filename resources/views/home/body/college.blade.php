<div class="p-4 sm:ml-64">
      <div class="mb-[3.5rem]"></div>
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                  <thead class="text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400">
                        <tr> 
                              <th scope="col" class="px-6 py-3" colspan="2">
                                    COLLEGES
                              </th>

                              <th scope="col" class="px-6 py-3" colspan="2" style="text-align: right;">
                              <!-- Add Modal toggle -->
                                    <button data-modal-target="add-modal" data-modal-toggle="add-modal" type="button" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Add College</button>
                              </th>
                        </tr>
                  </thead>

                  <thead class="text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                              <th scope="col" class="px-6 py-3" colspan="4">
                                    <form class="flex items-center max-w-sm" method="GET" action="{{route('college.search')}}">   
                                          <label for="simple-search" class="sr-only">Search</label>
                                          <div class="relative w-full">
                                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                                </div>
                                                <input type="text" name="search" id="simple-search" class="bg-gray-50 font-mono border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search College" required />
                                          </div>
                                          <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                                <span class="sr-only">Search</span>
                                          </button>
                                    </form>
                              </th>
                        </tr>
                  </thead>

                  <thead class="text-md font-mono text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400" style="height: 4rem;">
                        <tr>
                        <th scope="col" class="px-6 py-3">
                              College ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                              College Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                              Acronym
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                              Action
                        </th>
                        </tr>
                  </thead>

                  <tbody>
                        @foreach($colleges as $collegeData)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$collegeData->college_id}}
                              </th>
                              <td class="px-6 py-4">
                                    {{$collegeData->name}}
                              </td>
                              <td class="px-6 py-4">
                                    {{$collegeData->acronym}}
                              </td>
                              <td class="px-6 py-4 text-center flex justify-center">
                                    <button data-modal-target="edit-modal{{$collegeData->college_id}}" data-modal-toggle="edit-modal{{$collegeData->college_id}}" type="button" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-3">Edit</button>

                                    <button data-modal-target="delete-modal{{$collegeData->college_id}}" data-modal-toggle="delete-modal{{$collegeData->college_id}}" type="button" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                              </td>
                        </tr>
                        @endforeach
                  </tbody>
            </table>
      </div>
</div>