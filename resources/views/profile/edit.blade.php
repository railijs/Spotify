<x-app-layout>

    <!-- Main content with a gradient background -->
    <div class="py-12 bg-gradient-to-r from-gray-800 via-gray-900 to-black">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-10">
            <!-- Profile Header -->
            <div class="text-center">
                <h2 class="text-4xl font-bold text-white tracking-tight">
                    {{ __('Profile') }}
                </h2>
                <p class="mt-2 text-gray-200 text-lg">Manage your profile information and account settings</p>
            </div>

            <!-- Profile Information Section -->
            <div class="p-6 sm:p-10 bg-gray-800 shadow-xl rounded-lg border border-gray-700">
                <div class="max-w-xl mx-auto">
                    <h3 class="text-2xl text-white font-semibold mb-4">Update Profile Information</h3>
                    <p class="text-gray-200 mb-6">Keep your account details up to date.</p>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password Section -->
            <div class="p-6 sm:p-10 bg-gray-800 shadow-xl rounded-lg border border-gray-700">
                <div class="max-w-xl mx-auto">
                    <h3 class="text-2xl text-white font-semibold mb-4">Change Password</h3>
                    <p class="text-gray-200 mb-6">Ensure your account is secure by using a strong password.</p>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account Section -->
            <div class="p-6 sm:p-10 bg-gray-800 shadow-xl rounded-lg border border-gray-700">
                <div class="max-w-xl mx-auto">
                    <h3 class="text-2xl text-white font-semibold mb-4">Delete Account</h3>
                    <p class="text-gray-200 mb-6">Permanently delete your account and all associated data.</p>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
