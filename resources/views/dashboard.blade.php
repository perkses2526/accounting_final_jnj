<x-app-layout>
    @section('content')
        <x-slot name="header">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-gray-200">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
            <!-- Pending Card -->
            <div class="flex items-center p-4 bg-yellow-100 rounded-lg shadow-md dark:bg-yellow-800">
                <div class="flex items-center justify-center w-16 h-16 bg-yellow-200 rounded-full dark:bg-yellow-700">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="currentColor"
                        class="text-yellow-600 dark:text-yellow-300">
                        <path
                            d="M7 13.5q.625 0 1.063-.437T8.5 12t-.437-1.062T7 10.5t-1.062.438T5.5 12t.438 1.063T7 13.5m5 0q.625 0 1.063-.437T13.5 12t-.437-1.062T12 10.5t-1.062.438T10.5 12t.438 1.063T12 13.5m5 0q.625 0 1.063-.437T18.5 12t-.437-1.062T17 10.5t-1.062.438T15.5 12t.438 1.063T17 13.5M12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Pending</h3>
                    <p class="text-2xl font-bold text-gray-700 dark:text-gray-200" id="PendingNumbers"></p>
                </div>
            </div>

            <!-- Approved Card -->
            <div class="flex items-center p-4 bg-green-100 rounded-lg shadow-md dark:bg-green-800">
                <div class="flex items-center justify-center w-16 h-16 bg-green-200 rounded-full dark:bg-green-700">
                    <svg xmlns="http://www.w3.org/2000/svg" width="768" height="768" viewBox="0 0 48 48">
                        <defs>
                            <mask id="ipTCheckOne0">
                                <g fill="none" stroke="#fff" stroke-linejoin="round" stroke-width="4">
                                    <path fill="#555"
                                        d="M24 44a19.94 19.94 0 0 0 14.142-5.858A19.94 19.94 0 0 0 44 24a19.94 19.94 0 0 0-5.858-14.142A19.94 19.94 0 0 0 24 4A19.94 19.94 0 0 0 9.858 9.858A19.94 19.94 0 0 0 4 24a19.94 19.94 0 0 0 5.858 14.142A19.94 19.94 0 0 0 24 44Z" />
                                    <path stroke-linecap="round" d="m16 24l6 6l12-12" />
                                </g>
                            </mask>
                        </defs>
                        <path fill="currentColor" d="M0 0h48v48H0z" mask="url(#ipTCheckOne0)" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Approved</h3>
                    <p class="text-2xl font-bold text-gray-700 dark:text-gray-200" id="ApprovedNumbers"></p>
                </div>
            </div>

            <!-- Denied Card -->
            <div class="flex items-center p-4 bg-red-100 rounded-lg shadow-md dark:bg-red-800">
                <div class="flex items-center justify-center w-16 h-16 bg-red-200 rounded-full dark:bg-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" width="768" height="768" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-dasharray="12" stroke-dashoffset="12"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 12l7 7M12 12l-7 -7M12 12l-7 7M12 12l7 -7">
                            <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.3s" values="12;0" />
                        </path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Denied</h3>
                    <p class="text-2xl font-bold text-gray-700 dark:text-gray-200" id="DeniedNumbers"></p>
                </div>
            </div>
            <div class="flex items-center p-4 bg-gray-100 rounded-lg shadow-md dark:bg-gray-800">
                <div class="flex items-center justify-center w-16 h-16 bg-gray-200 rounded-full dark:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" width="768" height="768" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor"
                            d="M3 .5h18m-18 23h18m-15.5 0v-6l2.856-1.714a4.415 4.415 0 0 0 0-7.572L5.5 6.5v-6m13 0v6l-2.856 1.714a4.416 4.416 0 0 0 0 7.572L18.5 17.5v6" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Expired</h3>
                    <p class="text-2xl font-bold text-gray-700 dark:text-gray-200" id="ExpiredNumbers"></p>
                </div>
            </div>
        </div>
        @vite(['resources/js/dashboard.js'])
    @endsection
</x-app-layout>
