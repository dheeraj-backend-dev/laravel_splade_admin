<x-admin-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="flex justify-between ">
                <h1 class="text-2xl font-semibold p-4 ">Users</h1>
                <div class="p-4 ">
                    <Link href="{{ route('admin.users.create') }}"
                        class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded text-white ">
                    New User
                    </Link>
                </div>
            </div>
            <x-splade-table :for="$users">
                @cell('action', $users)
                    <div class="space-x-2 ">
                        <Link href="{{ route('admin.users.edit', $users) }}"
                            class="px-3 py-2 text-white bg-green-500 hover:bg-green-700 rounded ">
                        Edit
                        </Link>
                        <Link confirm href="{{ route('admin.users.destroy', $users) }}" method="DELETE"
                            class="px-3 py-2 text-white bg-red-500 hover:bg-red-700 rounded ">
                        Delete
                        </Link>
                    </div>
                @endcell
            </x-splade-table>
        </div>
    </div>
</x-admin-layout>
