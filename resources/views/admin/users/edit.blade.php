<x-admin-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <h1 class="text-2xl font-semibold p-4 ">Edit User </h1>
            <x-splade-form :default="$user" :action="route('admin.users.update', $user)" method="PUT" class="p-4 bg-white rounded-md space-y-2">
                <x-splade-input name="username" label="User Name : " />
                <x-splade-input name="first_name" label="First Name : " />
                <x-splade-input name="last_name" label="Last Name : " />
                <x-splade-input name="email" label="Email : " />
                <x-splade-select name="roles[]" :options="$roles" label="Choose Role" multiple relation choices />
                <x-splade-select name="permissions[]" :options="$permissions" label="Choose Permission" multiple relation choices />
                <x-splade-submit />
            </x-splade-form>
        </div>
    </div>
</x-admin-layout>
