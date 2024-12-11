<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Departments') }}
            </h2>
            <a class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                href="{{ route('department.create') }}"
                >
                {{ __('Add') }}
            </a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">{{ trans('ID') }}</th>
                                <th class="px-6 py-3">{{ trans('Name') }}</th>
                                <th class="px-6 py-3">{{ trans('Description') }}</th>
                                <th class="px-6 py-3">{{ trans('Employee') }}</th>
                                <th class="px-6 py-3">{{ trans('Salary Sum') }}</th>
                                <th class="px-6 py-3">{{ trans('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($departments as $item)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th class="px-6 py-4">{{ $item->id }}</th>
                                    <th class="px-6 py-4">{{ $item->title }}</th>
                                    <th class="px-6 py-4">{{ $item->description }}</th>
                                    <th class="px-6 py-4">{{ count($item->users) }}</th>
                                    <th class="px-6 py-4">{{ $item->users->sum('salary') }}</th>
                                    <th class="px-6 py-4">
                                        <div class="flex">
                                            <a href="{{ route('department.edit', $item->id) }}">
                                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                                </svg>
                                            </a>
                                            @if (!count($item->users))
                                                <form action="{{ route('department.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('Delete')
                                                    <button class="btn" type="submit">
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>