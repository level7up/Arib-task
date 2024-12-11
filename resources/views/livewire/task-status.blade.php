<div>
    <select wire:model="status" wire:change="updateStatus" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1">
        @foreach (\App\Enums\StatusEnum::cases() as $case)    
            <option value="{{ $case->value }}">{{ $case->name }}</option>
        @endforeach
    </select>
</div>