<x-admin-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <h1 class="text-2xl font-semibold p-4 ">Edit Country </h1>
            <x-splade-form :default="$country" :action="route('admin.countries.update', $country)" method="PUT" class="p-4 bg-white rounded-md space-y-2">
                <x-splade-input name="country_code" label="Country Code : " />
                <x-splade-input name="name" label="Name : " />
                <x-splade-submit />
            </x-splade-form>
        </div>
    </div>
</x-admin-layout>
