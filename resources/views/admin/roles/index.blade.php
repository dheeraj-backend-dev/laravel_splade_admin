<x-admin-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="flex justify-between ">
                <h1 class="text-2xl font-semibold p-4 ">Roles</h1>
                <div class="p-4 ">
                    <Link href="{{ route('admin.roles.create') }}"
                        class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded text-white ">
                    New Role
                    </Link>
                </div>
            </div>
            <x-splade-table :for="$roles">
                @cell('action', $role)
                    <div class="space-x-2 ">
                        <Link href="{{ route('admin.roles.edit', $role) }}"
                            class="px-3 py-2 text-white bg-green-500 hover:bg-green-700 rounded ">
                        Edit
                        </Link>
                        <Link confirm href="{{ route('admin.roles.destroy', $role) }}" method="DELETE"
                            class="px-3 py-2 text-white bg-red-500 hover:bg-red-700 rounded ">
                        Delete
                        </Link>
                    </div>
                @endcell
            </x-splade-table>
        </div>
    </div>
</x-admin-layout>
