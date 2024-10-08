<aside
    class="flex flex-col w-64 h-screen px-2 py-4 overflow-y-auto bg-white border-r rtl:border-r-0 rtl:border-l dark:bg-gray-900 dark:border-gray-700">
    <img class="object-cover mx-2 rounded-full h-9 w-9" src="https://api.dicebear.com/9.x/initials/svg?seed=JnJ"
        alt="avatar" />

    <div class="flex flex-col justify-between flex-1 mt-3">
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
                href="">
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
                href="{{ route('permission.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 2048 2048">
                    <path fill="currentColor"
                        d="M2048 1573v475h-512v-256h-256v-256h-256v-207q-74 39-155 59t-165 20q-97 0-187-25t-168-71t-142-110t-111-143t-71-168T0 704q0-97 25-187t71-168t110-142T349 96t168-71T704 0q97 0 187 25t168 71t142 110t111 143t71 168t25 187q0 51-8 101t-23 98zm-128 54l-690-690q22-57 36-114t14-119q0-119-45-224t-124-183t-183-123t-224-46q-119 0-224 45T297 297T174 480t-46 224q0 119 45 224t124 183t183 123t224 46q97 0 190-33t169-95h89v256h256v256h256v256h256zM512 384q27 0 50 10t40 27t28 41t10 50q0 27-10 50t-27 40t-41 28t-50 10q-27 0-50-10t-40-27t-28-41t-10-50q0-27 10-50t27-40t41-28t50-10" />
                </svg>
                <span class="mx-4 font-medium">Permission</span>
            </a>

            <a class="flex items-center px-3 py-1 mt-4 text-gray-600 transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
                href="{{ route('user_list.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
                    <path fill="currentColor"
                        d="M8 5c-3.3 0-6 2.7-6 6c0 2 1 3.8 2.5 4.8C1.8 17.2 0 19.9 0 23h2c0-3.3 2.7-6 6-6s6 2.7 6 6h2c0-3.2 2.6-5.9 5.8-6h.2c2.5 0 4.6-1.5 5.5-3.6c0 0 0-.1.1-.1c.1-.1.1-.3.1-.4s0-.1.1-.2c0-.1.1-.3.1-.4s0-.2.1-.3c0-.1 0-.2.1-.3v-.6c0-3.3-2.7-6-6-6s-6 2.7-6 6c0 2 1 3.8 2.5 4.8c-1.5.7-2.7 1.9-3.5 3.3c-.8-1.4-2-2.6-3.5-3.3C13 14.8 14 13 14 11c0-3.3-2.7-6-6-6m0 2c2.2 0 4 1.8 4 4s-1.8 4-4 4s-4-1.8-4-4s1.8-4 4-4m14 0c2.2 0 4 1.8 4 4s-1.8 4-4 4s-4-1.8-4-4s1.8-4 4-4m2.1 11v2.1c-.6.1-1.2.4-1.7.7l-1.5-1.5l-1.4 1.4l1.5 1.5c-.4.5-.6 1.1-.7 1.8H18v2h2.1c.1.6.4 1.2.7 1.8l-1.5 1.5l1.4 1.4l1.5-1.5c.5.3 1.1.6 1.7.7V32h2v-2.1c.6-.1 1.2-.4 1.7-.7l1.5 1.5l1.4-1.4l-1.5-1.5c.4-.5.6-1.1.7-1.8H32v-2h-2.1c-.1-.6-.4-1.2-.7-1.8l1.5-1.5l-1.4-1.4l-1.5 1.5c-.5-.3-1.1-.6-1.7-.7V18zm.9 4c1.7 0 3 1.3 3 3s-1.3 3-3 3s-3-1.3-3-3s1.3-3 3-3m0 2a.9.9 0 0 0-.367.086a1.1 1.1 0 0 0-.32.227a1.1 1.1 0 0 0-.227.32A.9.9 0 0 0 24 25q.002.19.086.367c.055.117.133.227.227.32c.093.094.203.172.32.227A.9.9 0 0 0 25 26c.5 0 1-.5 1-1s-.5-1-1-1" />
                </svg>
                <span class="mx-4 font-medium">Users list</span>
            </a>

            {{--   <a class="flex items-center px-3 py-1 mt-4 text-gray-600 transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
                href="{{ route('companies.index')}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M18 15h-2v2h2m0-6h-2v2h2m2 6h-8v-2h2v-2h-2v-2h2v-2h-2V9h8M10 7H8V5h2m0 6H8V9h2m0 6H8v-2h2m0 6H8v-2h2M6 7H4V5h2m0 6H4V9h2m0 6H4v-2h2m0 6H4v-2h2m6-10V3H2v18h20V7z" />
            </svg>
            <span class="mx-4 font-medium">Companies</span>
            </a>
            --}}

        </nav>

        <a href="{{-- {{ route('profile.show') --}} }}" class="flex items-center px-4 -mx-2 mt-6">
            <img class="object-cover mx-2 rounded-full h-9 w-9"
                src="https://api.dicebear.com/9.x/initials/svg?seed={{ auth()->user()->name }}" alt="avatar" />
            <span class="mx-2 font-medium text-gray-800 dark:text-gray-200">
                {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
            </span>
        </a>
    </div>
</aside>
