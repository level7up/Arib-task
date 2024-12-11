<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __(isset($employee) ?  'Edit Employee' : 'Create Employee') }}
            </h2>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ isset($employee) ? route('employee.update', $employee->id) : route('employee.store') }}" enctype="multipart/form-data">
                        @isset($employee)
                        @method('PUT')
                        @endisset
                        @csrf
                        <div>
                            <div class="flex items-center space-x-6 justify-center">
                                <div class="shrink-0">
                                <img id='preview_img' class="h-16 w-16 object-cover rounded-full" src="{{ @$employee->avatar_url ?? 'https://static.vecteezy.com/system/resources/previews/009/292/244/non_2x/default-avatar-icon-of-social-media-user-vector.jpg' }}" alt="Current profile photo" />
                                </div>
                                <label class="block">
                                <span class="sr-only">Choose profile photo</span>
                                <input type="file" onchange="loadFile(event)" class="block w-full text-sm text-slate-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-violet-50 file:text-violet-700
                                    hover:file:bg-violet-100
                                " name="avatar"/>
                                </label>
                            </div>
                        </div>
                        <div>
                            <x-input-label for="first_name" :value="__('First Name')" />
                            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="@$employee->first_name ?? old('first_name')" required autofocus autocomplete="first_name" />
                            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                        </div>
                        <div>
                            <x-input-label for="last_name" :value="__('Last Name')" />
                            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="@$employee->last_name ?? old('last_name')" required autofocus autocomplete="last_name" />
                            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                        </div>
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="@$employee->email ?? old('email')" required autofocus autocomplete="email" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
                        <div>
                            <x-input-label for="phone" :value="__('Phone')" />
                            <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="@$employee->phone ?? old('phone')" required autofocus autocomplete="phone" />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>
                        <div>
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"  required autofocus autocomplete="password" />
                            <x-input-error class="mt-2" :messages="$errors->get('password')" />
                        </div>
                        <div>
                            <x-input-label for="salary" :value="__('Salary')" />
                            <x-text-input id="salary" class="block mt-1 w-full" type="number" name="salary" :value="@$employee->salary ?? old('salary')" required autofocus autocomplete="salary" />
                            <x-input-error class="mt-2" :messages="$errors->get('salary')" />
                        </div>
                        <div>
                            <x-input-label for="role_id" :value="__('Role')" />
                            <select name="role_id" id="role_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                @foreach (\App\Models\Role::pluck('name','id')->toArray() as $key=> $role)
                                    <option value="{{ $key }}">{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-input-label for="department_id" :value="__('Department')" />
                            <select name="department_id" id="department_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                @foreach (\App\Models\Department::pluck('title','id')->toArray() as $key=> $department)
                                    <option value="{{ $key }}">{{ $department }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-input-label for="manager_id" :value="__('Manager')" />
                            <select name="manager_id" id="manager_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                @foreach (\App\Models\User::get()->pluck('name','id')->toArray() as $key=> $manger)
                                    <option value="{{ $key }}">{{ $manger }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Create') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        var loadFile = function(event) {
            var input = event.target;
            var file = input.files[0];
            var type = file.type;
            var output = document.getElementById('preview_img');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
</script>
</x-app-layout>
