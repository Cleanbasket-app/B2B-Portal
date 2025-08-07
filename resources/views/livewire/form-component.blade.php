<form wire:submit.prevent="submit" class="space-y-4">
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <input id="name" type="text" wire:model="name" class="mt-1 block w-full border-gray-300 rounded-md" />
    </div>
    <x-button type="submit">Save</x-button>
</form>
