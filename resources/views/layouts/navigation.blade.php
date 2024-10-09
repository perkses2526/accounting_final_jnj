<aside
    class="flex flex-col w-64 h-screen px-2 py-4 overflow-y-auto bg-white border-r rtl:border-r-0 rtl:border-l dark:bg-gray-900 dark:border-gray-700 lg:block hidden">
    <!-- Logo Section -->
    <div class="flex justify-center mb-4">
        <img class="object-cover h-16 w-16"
            src="https://api.dicebear.com/9.x/icons/svg?backgroundType=gradientLinear,solid" alt="avatar" />
    </div>

    <!-- User Info Section -->
    <a href="#" class="flex items-center px-4">
        <img class="object-cover mx-2 rounded-full h-9 w-9"
            src="https://api.dicebear.com/9.x/initials/svg?seed={{ auth()->user()->first_name }} {{ auth()->user()->last_name }}"
            alt="User Avatar" />
        <span class="mx-2 font-medium text-gray-800 dark:text-gray-200">
            Hello, {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
        </span>
    </a>

    <nav>
        <a class="flex items-center px-3 py-1 mt-4 text-gray-600 transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
            href="{{ route('dashboard') }}">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M19 11H5M19 11C20.1046 11 21 11.8954 21 13V19C21 20.1046 20.1046 21 19 21H5C3.89543 21 3 20.1046 3 19V13C3 11.8954 3.89543 11 5 11M19 11V9C19 7.89543 18.1046 7 17 7M5 11V9C5 7.89543 5.89543 7 7 7M7 7V5C7 3.89543 7.89543 3 9 3H15C16.1046 3 17 3.89543 17 5V7M7 7H17"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span class="mx-4 font-medium">Dashboard</span>
        </a>

        <a class="flex items-center px-3 py-1 mt-4 text-gray-600 transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
            href="{{ route('approval_list.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="m17.275 20.25l3.475-3.45l-1.05-1.05l-2.425 2.375l-.975-.975l-1.05 1.075zM6 9h12V7H6zm12 14q-2.075 0-3.537-1.463T13 18t1.463-3.537T18 13t3.538 1.463T23 18t-1.463 3.538T18 23M3 22V3h18v8.675q-.475-.225-.975-.375T19 11.075V5H5v14.05h6.075q.125.775.388 1.475t.687 1.325L12 22l-1.5-1.5L9 22l-1.5-1.5L6 22l-1.5-1.5zm3-5h5.075q.075-.525.225-1.025t.375-.975H6zm0-4h7.1q.95-.925 2.213-1.463T18 11H6zm-1 6.05V5z" />
            </svg>
            <span class="mx-4 font-medium">Approval List</span>
        </a>
        @if (auth()->user()->hasRole('superadmin'))
            <a class="flex items-center px-3 py-1 mt-4 text-gray-600 transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
                href="{{ route('roles.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 2048 2048">
                    <path fill="currentColor"
                        d="M1664 1280h256v640h-640v-640h256v-256H384v256h256v640H0v-640h256V896h640V640H640V0h640v640h-256v256h640zM768 128v384h384V128zM512 1792v-384H128v384zm1280 0v-384h-384v384z" />
                </svg>
                <span class="mx-4 font-medium">Roles</span>
            </a>

            <a class="flex items-center px-3 py-1 mt-4 text-gray-600 transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
                href="{{ route('permission.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 2048 2048">
                    <path fill="currentColor"
                        d="M2048 1573v475h-512v-256h-256v-256h-256v-207q-74 39-155 59t-165 20q-97 0-187-25t-168-71t-142-110t-111-143t-71-168T0 704q0-97 25-187t71-168t110-142T349 96t168-71T704 0q97 0 187 25t168 71t142 110t111 143t71 168t25 187q0 51-8 101t-23 98zm-128 54l-690-690q22-57 36-114t14-119q0-119-45-224t-124-183t-183-123t-224-46q-119 0-224 45T297 297T174 480t-46 224q0 119 45 224t124 183t183 123t224 46q97 0 190-33t169-95h89v256h256v256h256v256h256zM512 384q27 0 50 10t40 27t28 41t10 50q0 27-10 50t-27 40t-41 28t-50 10q-27 0-50-10t-40-27t-28-41t-10-50q0-27 10-50t27-40t41-28t50-10" />
                </svg>
                <span class="mx-4 font-medium">Permission</span>
            </a>
        @endif

        <a class="flex items-center px-3 py-1 mt-4 text-gray-600 transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
            href="{{ route('user_list.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
                <path fill="currentColor"
                    d="M8 5c-3.3 0-6 2.7-6 6c0 2 1 3.8 2.5 4.8C1.8 17.2 0 19.9 0 23h2c0-3.3 2.7-6 6-6s6 2.7 6 6h2c0-3.2 2.6-5.9 5.8-6h.2c2.5 0 4.6-1.5 5.5-3.6c0 0 0-.1.1-.1c.1-.1.1-.3.1-.4s0-.1.1-.2c0-.1.1-.3.1-.4s0-.2.1-.3c0-.1 0-.2.1-.3v-.6c0-3.3-2.7-6-6-6s-6 2.7-6 6c0 2 1 3.8 2.5 4.8c-1.7 1.2-2.5 3-2.5 4.8h-2c0-3.2-2.6-5.9-5.8-6h-.2c-2.5 0-4.6-1.5-5.5-3.6C1.4 10.6 4.1 7 8 7c2.2 0 4.1 1.1 5.2 2.8C14.9 10 15 10 15 10c2.5-2.2 5.9-2.5 8.5-.4c3.3 3.2 1 8.4-3.1 8.4h-.1c-1.4 0-2.6-.7-3.4-1.8c-.1-.1-.3-.2-.4-.4c-.1 0-.1 0-.2-.1c-1.4-1.1-3.3-1.1-4.7 0c-.1 0-.1 0-.2.1c-.1.2-.2.3-.4.4c-.9 1.1-2 1.8-3.4 1.8H0c0-3.3 2.7-6 6-6c.4 0 .8 0 1.1.1c1.3-.5 2.7-.8 4.1-.8c.5 0 1 0 1.5.1C16.2 6 14.2 5 12 5c-2.7 0-5.1 1.1-7 3c-1.8 1.8-3 4.2-3 7c0 3.2 2.7 5.8 6 5.8h1.2c1.1 0 2.2.4 3 1.1c.8-.7 1.9-1.1 3-1.1h3.8c3.3 0 6-2.7 6-6c0-2.2-.7-4-1.8-5.5c1.3-1.2 2.2-3 2.2-5C26 9.7 22.3 5 16 5z" />
            </svg>
            <span class="mx-4 font-medium">Users</span>
        </a>

    </nav>
</aside>


<aside id="mobileSidebar"
    class="fixed inset-0 z-50 flex flex-col w-64 h-full bg-white border-r rtl:border-r-0 rtl:border-l dark:bg-gray-900 dark:border-gray-700 lg:hidden hidden">
    <div class="flex justify-between items-center px-4 py-2 border-b dark:border-gray-700">
        <span class="text-lg font-semibold">Menu</span>
        <button id="closeSidebar" class="p-2 text-gray-600 hover:bg-gray-200 dark:text-gray-400 dark:hover:bg-gray-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <nav class="flex-1 overflow-y-auto">
        <a class="flex items-center px-3 py-1 mt-4 text-gray-600 transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
            href="{{ route('dashboard') }}">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M19 11H5M19 11C20.1046 11 21 11.8954 21 13V19C21 20.1046 20.1046 21 19 21H5C3.89543 21 3 20.1046 3 19V13C3 11.8954 3.89543 11 5 11M19 11V9C19 7.89543 18.1046 7 17 7M5 11V9C5 7.89543 5.89543 7 7 7M7 7V5C7 3.89543 7.89543 3 9 3H15C16.1046 3 17 3.89543 17 5V7M7 7H17"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span class="mx-4 font-medium">Dashboard</span>
        </a>

        <a class="flex items-center px-3 py-1 mt-4 text-gray-600 transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
            href="{{ route('approval_list.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="m17.275 20.25l3.475-3.45l-1.05-1.05l-2.425 2.375l-.975-.975l-1.05 1.075zM6 9h12V7H6zm12 14q-2.075 0-3.537-1.463T13 18t1.463-3.537T18 13t3.538 1.463T23 18t-1.463 3.538T18 23M3 22V3h18v8.675q-.475-.225-.975-.375T19 11.075V5H5v14.05h6.075q.125.775.388 1.475t.687 1.325L12 22l-1.5-1.5L9 22l-1.5-1.5L6 22l-1.5-1.5zm3-5h5.075q.075-.525.225-1.025t.375-.975H6zm0-4h7.1q.95-.925 2.213-1.463T18 11H6zm-1 6.05V5z" />
            </svg>
            <span class="mx-4 font-medium">Approval List</span>
        </a>

        <a class="flex items-center px-3 py-1 mt-4 text-gray-600 transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
            href="{{ route('roles.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 2048 2048">
                <path fill="currentColor"
                    d="M1664 1280h256v640h-640v-640h256v-256H384v256h256v640H0v-640h256V896h640V640H640V0h640v640h-256v256h640zM768 128v384h384V128zM512 1792v-384H128v384zm1280 0v-384h-384v384z" />
            </svg>
            <span class="mx-4 font-medium">Roles</span>
        </a>

        <a class="flex items-center px-3 py-1 mt-4 text-gray-600 transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
            href="{{ route('user_list.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 2048 2048">
                <path fill="currentColor"
                    d="M1280 1024h768v512h-768v-512zm-512 0H0v512h768v-512zM640 640h640v-640H640v640zm1280 640h-768v512h768v-512zm-512-640H0v640h768V640zM0 1792h640v-512H0v512z" />
            </svg>
            <span class="mx-4 font-medium">Users</span>
        </a>
    </nav>
</aside>
