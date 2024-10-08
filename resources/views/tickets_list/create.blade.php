<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
    <form id="roleForm" onsubmit="return false;" class="col-span-full">

        <label for="user_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300"><strong>User
                code</strong></label>
        <input type="text" name="user_code" id="user_code" placeholder="Enter user code"
            class="block w-full mt-1 px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-50 dark:focus:border-blue-300 focus:outline-none focus:ring">

        <label for="date_entered" class="block text-sm font-medium text-gray-700 dark:text-gray-300"><strong>Date
                entered</strong></label>
        <input type="date" name="date_entered" id="date_entered"
            class="block w-full mt-1 px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-50 dark:focus:border-blue-300 focus:outline-none focus:ring">

        <label for="transaction_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300"><strong>Select
                transaction type</strong></label>
        <select name="transaction_id" id="transaction_id">
            <option value="" selected disabled>Select transaction type</option>
            <!-- Options should be dynamically populated from your backend -->
        </select>

        <label for="reference_no" class="block text-sm font-medium text-gray-700 dark:text-gray-300"><strong>Reference
                no.</strong></label>
        <input type="text" name="reference_no" id="reference_no" placeholder="Enter Reference no."
            class="block w-full mt-1 px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-50 dark:focus:border-blue-300 focus:outline-none focus:ring">

        <label for="remarks"
            class="block text-sm font-medium text-gray-700 dark:text-gray-300"><strong>Remarks</strong></label>
        <textarea name="remarks" id="remarks" cols="10" rows="2" placeholder="Remarks"
            class="block w-full mt-1 px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-50 dark:focus:border-blue-300 focus:outline-none focus:ring"></textarea>

        <label for="expiry_date_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300"><strong>Expiry
                date</strong></label>
        <input type="datetime-local" name="expiry_date_time" id="expiry_date_time"
            class="block w-full mt-1 px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-50 dark:focus:border-blue-300 focus:outline-none focus:ring">
    </form>
</div>
