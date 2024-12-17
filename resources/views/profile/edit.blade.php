<x-app-layout>

    <!-- Main content with a gradient background -->
    <div class="py-12 bg-gradient-to-r from-gray-800 via-gray-900 to-black">
    <h2 class="font-semibold text-3xl text-white leading-tight">
    {{ __('Profile') }}
</h2>


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Profile Information Section -->
            <div class="p-4 sm:p-8 bg-gray-800 shadow-lg rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-2xl text-white mb-4">Update Profile Information</h3>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password Section -->
            <div class="p-4 sm:p-8 bg-gray-800 shadow-lg rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-2xl text-white mb-4">Change Password</h3>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account Section -->
            <div class="p-4 sm:p-8 bg-gray-800 shadow-lg rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-2xl text-white mb-4">Delete Account</h3>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
