<div>
    @if($show)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-6 rounded shadow">
                <div class="mb-4">Modal Content</div>
                <x-button wire:click="close">Close</x-button>
            </div>
        </div>
    @endif
</div>
