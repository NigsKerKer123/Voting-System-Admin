<!-- unofficial report -->
<form action="{{route('generate')}}" method="POST">
    @csrf
    <input type="hidden" name="report" value="1">
    <button type="submit" class="ml-[1rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Generate Unofficial SSC reports</button>
</form>

<!-- Final result -->
<form action="{{route('generate')}}" method="POST">
    @csrf
    <input type="hidden" name="report" value="0">
    <button type="submit" class="ml-[1rem] text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-blue-800">Generate Final SSC Result</button>
</form>


<button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="ml-[1rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 inline-flex items-center" type="button">Generate Unofficial SBO reports<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
</svg>
</button>

<!-- Dropdown menu -->
<div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
      <li>
        <form action="{{route('generateSBO')}}" method="POST">
            @csrf
            <input type="hidden" name="college" value="COT">
            <input type="hidden" name="report" value="1">
            <input type="hidden" name="college_id" value="COL42821">
            <button href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-[11rem]">COT</button>
        </form>
      </li>

      <li>
      <form action="{{route('generateSBO')}}" method="POST">
            @csrf
            <input type="hidden" name="college" value="CON">
            <input type="hidden" name="report" value="1">
            <input type="hidden" name="college_id" value="COL25032">
            <button href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-[11rem]">CON</button>
        </form>
      </li>

      <li>
      <form action="{{route('generateSBO')}}" method="POST">
            @csrf
            <input type="hidden" name="college" value="COB">
            <input type="hidden" name="report" value="1">
            <input type="hidden" name="college_id" value="COL89518">
            <button href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-[11rem]">COB</button>
        </form>
      </li>

      <li>
      <form action="{{route('generateSBO')}}" method="POST">
            @csrf
            <input type="hidden" name="college" value="CPAG">
            <input type="hidden" name="report" value="1">
            <input type="hidden" name="college_id" value="COL30246">
            <button href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-[11rem]">CPAG</button>
        </form>
      </li>

      <li>
      <form action="{{route('generateSBO')}}" method="POST">
            @csrf
            <input type="hidden" name="college" value="COE">
            <input type="hidden" name="report" value="1">
            <input type="hidden" name="college_id" value="COL11864">
            <button href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-[11rem]">COE</button>
        </form>
      </li>

      <li>
        <form action="{{route('generateSBO')}}" method="POST">
            @csrf
            <input type="hidden" name="college" value="CAS">
            <input type="hidden" name="report" value="1">
            <input type="hidden" name="college_id" value="COL92907">
            <button href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-[11rem]">CAS</button>
        </form>
      </li>
    </ul>
</div>

<button id="dropdownDefaultButton1" data-dropdown-toggle="dropdown1" class="ml-[1rem] text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 inline-flex items-center" type="button">Generate Official SBO reports<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
</svg>
</button>

<!-- Dropdown menu -->
<div id="dropdown1" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton1">
      <li>
        <form action="{{route('generateSBO')}}" method="POST">
            @csrf
            <input type="hidden" name="college" value="COT">
            <input type="hidden" name="report" value="0">
            <input type="hidden" name="college_id" value="COL42821">
            <button href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-[11rem]">COT</button>
        </form>
      </li>

      <li>
      <form action="{{route('generateSBO')}}" method="POST">
            @csrf
            <input type="hidden" name="college" value="CON">
            <input type="hidden" name="report" value="0">
            <input type="hidden" name="college_id" value="COL25032">
            <button href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-[11rem]">CON</button>
        </form>
      </li>

      <li>
      <form action="{{route('generateSBO')}}" method="POST">
            @csrf
            <input type="hidden" name="college" value="COB">
            <input type="hidden" name="report" value="0">
            <input type="hidden" name="college_id" value="COL89518">
            <button href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-[11rem]">COB</button>
        </form>
      </li>

      <li>
      <form action="{{route('generateSBO')}}" method="POST">
            @csrf
            <input type="hidden" name="college" value="CPAG">
            <input type="hidden" name="report" value="0">
            <input type="hidden" name="college_id" value="COL30246">
            <button href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-[11rem]">CPAG</button>
        </form>
      </li>

      <li>
      <form action="{{route('generateSBO')}}" method="POST">
            @csrf
            <input type="hidden" name="college" value="COE">
            <input type="hidden" name="report" value="0">
            <input type="hidden" name="college_id" value="COL11864">
            <button href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-[11rem]">COE</button>
        </form>
      </li>

      <li>
        <form action="{{route('generateSBO')}}" method="POST">
            @csrf
            <input type="hidden" name="college" value="CAS">
            <input type="hidden" name="report" value="0">
            <input type="hidden" name="college_id" value="COL92907">
            <button href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-[11rem]">CAS</button>
        </form>
      </li>
    </ul>
</div>