
<div class="bg-input-gradient w-full">
  <div class="container mx-auto">
  <nav class="bg-transparent border-transparent font-kanit dark:bg-red dark:border-gray-700">
    <div class="max-w-screen-2xl flex flex-wrap items-center justify-between mx-auto px-4 py-2.5">
      <a href="#" class="flex items-center">
        {{-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 mr-3" alt="Flowbite Logo" /> --}}
        <span class="self-center text-3xl font-semibold  font-kanit whitespace-nowrap text-white">Cahaya Nusantara</span>
      </a>
      <button data-collapse-toggle="navbar-dropdown" type="button" class="flex items-end p-2 w-10 h-10 justify-center text-sm  text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-dropdown" aria-expanded="false">
        {{-- <button data-collapse-toggle="navbar-dropdown" type="button" class="inline-flex items-center p-2 ml-3 w-10 h-10 justify-center text-sm text-white rounded-lg md:hidden hover:bg-grey-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-dropdown" aria-expanded="false"> --}}
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
      </button>
      <div class="hidden w-full lg:block md:w-auto" id="navbar-dropdown">
        <ul class="flex flex-col font-medium p-4 mt-4 border border-gray-100 gap-6 rounded-lg bg-transparent md:flex-row md:space-x-8 md:mt-0 md:text-sm  md:border-0">
          <li>
            <a href="/" class="block py-2 pl-3 pr-4 text-white text-xl bg-blue-700 rounded md:bg-transparent md:p-0 " aria-current="page">Home</a>
          </li>
          
          <li>
            <a href="#" class="block py-2 pl-3 pr-4 text-white text-xl bg-blue-700 rounded md:bg-transparent md:p-0 ">Harga</a>
          </li>
          <li>
            <a href="{{ route('cekresi-view') }}" class="block py-2 pl-3 pr-4 text-white bg-blue-700 text-xl rounded md:bg-transparent md:p-0 ">Cek Resi</a>
          </li>
          <li>
            <a href="#" class="block py-2 pl-3 pr-4 text-white bg-blue-700 text-xl rounded md:bg-transparent md:p-0 ">About</a>
          </li>
          <li>
            <a href="{{ route('contact') }}" class="block py-2 pl-3 pr-4 text-white bg-blue-700 text-xl rounded md:bg-transparent md:p-0 ">Contact</a>
          </li>
          
          

          {{-- authentifikasi --}}
          @auth

          <li>
            
            <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center text-xl justify-between w-full py-2 pl-3 pr-4  text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-gray-400 dark:hover:text-white dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
              {{ auth()->user()->username }}  
              <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
              </svg></button>


            <!-- Dropdown menu -->
            <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
              @if (auth()->check())

              {{-- auth cek jika admin --}}
                @if (auth()->user())
                  <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                    <li>
                      <a href="{{ route('admin') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                    </li>
                    <li>
                      <a href="/" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                    </li>
                    <li>
                      <a href="about/" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">About</a>
                    </li>
                  </ul>

                {{-- jika bukan admin --}}
                @else
                  <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                    <li>
                      <a href="/" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                    </li>
                    <li>
                      <a href="/" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                    </li>
                    <li>
                      <a href="about/" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">About</a>
                    </li>
                  </ul>
               
                @endif
                 {{-- logout menu --}}
                  <div class="py-2">
                    <form action="/logout" method="post">
                      @csrf
                      <button class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">
                      Logout</button>
                    </form>
                  </div>
              @endif
              
              @else
                <li>
            
                  <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center text-xl justify-between w-full py-2 pl-3 pr-4  text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-gray-400 dark:hover:text-white dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
                    <h1>Login</h1>
                    <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg></button>
                  <!-- Dropdown menu -->
                  <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
      
                    
                      <div class="py-2">
                      <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">Login</a>        
                      </div>
      
                    </div>
                </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>
  </div>
</div>  
