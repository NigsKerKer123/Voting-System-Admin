<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
   <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
      <ul class="space-y-2 font-medium">
         <li>
            <a href="{{route('dashboard.index')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 group" id="dashboardBtn">
               <img src="{{asset('images/sidebar/dashboard.svg')}}" alt="dashboardlogo">
               <span class="ms-3">Dashboard</span>
            </a>
         </li>

         <li>
            <a href="{{route('college.index')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 group" id="collegeBtn">
               <img src="{{asset('images/sidebar/college.svg')}}" alt="collegeLogo">
               <span class="flex-1 ms-3 whitespace-nowrap">Colleges</span>
            </a>
         </li>

         <li>
            <a href="{{route('partylist.index')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 group" id="partylistBtn">
               <img src="{{asset('images/sidebar/partylist.svg')}}" alt="PartyListsLogo">
               <span class="flex-1 ms-3 whitespace-nowrap">PartyLists</span>
            </a>
         </li>
         
         <li>
            <a href="{{route('organization.index')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 group" id="organizationBtn">
               <img src="{{asset('images/sidebar/organization.svg')}}" alt="organizationLogo">
               <span class="flex-1 ms-3 whitespace-nowrap">Organizations</span>
            </a>
         </li>

         <li>
            <a href="{{route('position.index')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 group" id="positionBtn">
               <img src="{{asset('images/sidebar/position.svg')}}" alt="positionlogo">
               <span class="flex-1 ms-3 whitespace-nowrap">Positions</span>
            </a>
         </li>

         <li>
            <a href="{{route('candidates.index')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 group" id="candidateBtn">
               <img src="{{asset('images/sidebar/candidate.svg')}}" alt="CandidateLogo">
               <span class="flex-1 ms-3 whitespace-nowrap">Candidates</span>
            </a>
         </li>

         <li>
            <a href="{{route('voters.index')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 group" id="voterBtn">
               <img src="{{asset('images/sidebar/voter.svg')}}" alt="votersLogo">
               <span class="flex-1 ms-3 whitespace-nowrap">Voters</span>
            </a>
         </li>

         <div class="flex justify-center p-2">
            <hr style="width:95%; height: 1px; border: none; background-color: gray;">
         </div>
         
         <li>
            <a href="{{route('sboVotes.index')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 group" id="sboBtn">
               <img src="{{asset('images/sidebar/casted.svg')}}" alt="sbologo">
               <span class="flex-1 ms-3 whitespace-nowrap">SBO Votes (temporary)</span>
            </a>
         </li>

         <li>
            <a href="{{route('sscVotes.index')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 group" id="sscBtn">
               <img src="{{asset('images/sidebar/casted.svg')}}" alt="ssclogo">
               <span class="flex-1 ms-3 whitespace-nowrap">SSC Votes (temporary)</span>
            </a>
         </li>

         <li>
            <a href="{{route('castedVotes.index')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 group" id="castBtn">
               <img src="{{asset('images/sidebar/casted.svg')}}" alt="CastedLogo">
               <span class="flex-1 ms-3 whitespace-nowrap">Casted Votes</span>
            </a>
         </li>

         <div class="flex justify-center p-2">
            <hr style="width:95%; height: 1px; border: none; background-color: gray;">
         </div>

         <li>
            <a href="/" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 group" id="castBtn">
               <img src="{{asset('images/sidebar/casted.svg')}}" alt="CastedLogo">
               <span class="flex-1 ms-3 whitespace-nowrap">Add Users</span>
            </a>
         </li>

         <li>
            <button data-modal-target="upgrade-modal" data-modal-toggle="upgrade-modal" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 group" id="castBtn">
               <img src="{{asset('images/sidebar/casted.svg')}}" alt="CastedLogo">
               <span class="flex-1 ms-3 whitespace-nowrap">Upgrade to premium</span>
            </button>
         </li>
      </ul>
   </div>
</aside>

<script>
   document.addEventListener("DOMContentLoaded", function() {
      function hovered() {
         var dashboard = document.getElementById('dashboardBtn');
         var position = document.getElementById('positionBtn');
         var organization = document.getElementById('organizationBtn');
         var colleges = document.getElementById('collegeBtn');
         var partylist = document.getElementById('partylistBtn');
         var candidates = document.getElementById('candidateBtn');
         var voters = document.getElementById('voterBtn');
         var casted = document.getElementById('castBtn');
         var sbo = document.getElementById('sboBtn');
         var ssc = document.getElementById('sscBtn');

         if (window.location.pathname == "/dashboard") {
            dashboard.classList = 'flex items-center p-2 text-gray-900 bg-gray-300 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group';
         }  else if (window.location.pathname == "/positions") {
            position.classList = 'flex items-center p-2 text-gray-900 bg-gray-300 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group';
         }  else if (window.location.pathname == "/organizations") {
            organization.classList = 'flex items-center p-2 text-gray-900 bg-gray-300 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group';
         }  else if (window.location.pathname == "/colleges") {
            colleges.classList = 'flex items-center p-2 text-gray-900 bg-gray-300 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group';
         }  else if (window.location.pathname == "/partylists") {
            partylist.classList = 'flex items-center p-2 text-gray-900 bg-gray-300 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group';
         }  else if (window.location.pathname == "/candidates") {
            candidates.classList = 'flex items-center p-2 text-gray-900 bg-gray-300 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group';
         }  else if (window.location.pathname == "/voters") {
            voters.classList = 'flex items-center p-2 text-gray-900 bg-gray-300 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group';
         }  else if (window.location.pathname == "/castedVotes") {
            casted.classList = 'flex items-center p-2 text-gray-900 bg-gray-300 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group';
         } else if (window.location.pathname == "/sboVotes") {
            sbo.classList = 'flex items-center p-2 text-gray-900 bg-gray-300 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group';
         } else if (window.location.pathname == "/sscVotes") {
            ssc.classList = 'flex items-center p-2 text-gray-900 bg-gray-300 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group';
         }
      }
      hovered();
   });
</script>

<div id="upgrade-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="upgrade-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>

            <form action="{{route('upgrade')}}" method="POST">
               @csrf
               <div class="p-4 md:p-5 text-center">
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to Upgrade to premium?</h3>
                <button type="submit" class="text-gray-900 bg-gradient-to-r from-teal-200 to-lime-200 hover:bg-gradient-to-l hover:from-teal-200 hover:to-lime-200 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-teal-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                    Upgrade to premium
                </button>

                <button data-modal-hide="upgrade-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
               </div>
            </form>
            
        </div>
    </div>
</div>
