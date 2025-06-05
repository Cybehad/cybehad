<!-- resources/views/livewire/notification-preferences.blade.php -->
<div>
    <div class="flex items-center">
        <input
            wire:model="receiveNotifications"
            id="receive-notifications"
            type="checkbox"
            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
        >
        <label for="receive-notifications" class="ml-2 block text-sm text-gray-900">
            Receive email notifications for new posts
        </label>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('livewire:load', function() {
                Livewire.on('preferences-updated', () => {
                    alert('Notification preferences updated successfully!');
                });
            });
        </script>
    @endpush
</div>
