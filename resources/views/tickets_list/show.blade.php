<div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6 p-3">
    <form id="ticketForm" onsubmit="return false;" class="col-span-full">
        <!-- User Code -->

        <input type="hidden" name="id" value="{{ $tickets->id }}">

        <div class="mb-4">
            <label for="user_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                <strong>User Code</strong>
            </label>
            <p class="mt-1 text-lg text-gray-800 dark:text-gray-300">
                {{ $tickets->user_code ?? 'No input' }}
            </p>
        </div>

        <!-- Date Entered -->
        <div class="mb-4">
            <label for="date_entered" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                <strong>Date Entered</strong>
            </label>
            <p class="mt-1 text-lg text-gray-800 dark:text-gray-300">
                {{ $tickets->date_entered ?? 'No input' }}
            </p>
        </div>

        <!-- Transaction Type -->
        <div class="mb-4">
            <label for="transaction_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                <strong>Transaction Type</strong>
            </label>
            <p class="mt-1 text-lg text-gray-800 dark:text-gray-300">
                {{ $tickets->transaction_name ?? 'No input' }}
            </p>
        </div>

        <!-- Reference Number -->
        <div class="mb-4">
            <label for="reference_no" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                <strong>Reference No.</strong>
            </label>
            <p class="mt-1 text-lg text-gray-800 dark:text-gray-300">
                {{ $tickets->reference_no ?? 'No input' }}
            </p>
        </div>

        <!-- Remarks -->
        <div class="mb-4">
            <label for="remarks" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                <strong>Remarks</strong>
            </label>
            <p class="mt-1 text-lg text-gray-800 dark:text-gray-300">
                {{ $tickets->remarks ?? 'No input' }}
            </p>
        </div>

        <!-- Expiry Date -->
        <div class="mb-4">
            <label for="expiry_date_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                <strong>Expiry Date</strong>
            </label>
            <p class="mt-1 text-lg text-gray-800 dark:text-gray-300">
                {{ $tickets->expiry_date_time ?? 'No expiry date' }}
            </p>
        </div>
        @if ((is_null($tickets->expiry_date_time) || $tickets->expiry_date_time > now()) && is_null($tickets->status))
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    <strong>Set Status</strong>
                </label>
                <select name="status" id="status"
                    class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
                    <option value="" selected disabled>Select status</option>
                    <option value="Approved">Approved Request</option>
                    <option value="Denied">Deny Request</option>
                </select>
            </div>
        @elseif($tickets->status == 'Approved')
            <div class="mb-4">
                <p class="mt-1 text-lg text-gray-800 dark:text-gray-300 text-green-800">
                    This ticket has been approved.
                </p>
            </div>
        @elseif($tickets->status == 'Denied')
            <div class="mb-4">
                <p class="mt-1 text-lg text-gray-800 dark:text-gray-300 text-red-800">
                    Sorry but this ticket has been denied. Please see details below
                    <hr>
                    {{ $tickets->reason_if_denied }}
                </p>
            </div>
        @else
            <div class="mb-4">
                <p class="mt-1 text-lg text-gray-800 dark:text-gray-300 text-red-800">
                    Sorry, but this ticket has already expired.
                </p>
            </div>
        @endif

        <div class="mb-4" id="reason_if_denied_div">
            <label for="reason_if_denied"
                class="block text-sm font-medium text-gray-700 dark:text-gray-300"><strong>Reason for denying
                    request</strong></label>
            <textarea name="reason_if_denied" id="reason_if_denied" cols="10" rows="2"
                placeholder="Reason for denying request"
                class="block w-full mt-1 px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-50 dark:focus:border-blue-300 focus:outline-none focus:ring"></textarea>
        </div>

    </form>
</div>
