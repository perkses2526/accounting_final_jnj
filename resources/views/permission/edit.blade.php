<form id="permissionForm" onsubmit="return false;" class="col-span-full">
    @csrf
    @method('PUT') 
    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300"><strong>Role
            Name</strong></label>
    <input type="hidden" name="id" value="{{ $roles->id }}">
    <input type="text" name="name" id="name" placeholder="Enter Role Name" value="{{ $roles->name }}"
        class="block w-full mt-1 px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-50 dark:focus:border-blue-300 focus:outline-none focus:ring">
</form>
