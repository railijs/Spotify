<x-app-layout>
    

    <!-- Main content of the dashboard -->
    <div class="min-h-screen bg-gradient-to-r from-gray-800 via-gray-900 to-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-between items-center">
                        <button class="px-4 py-2 bg-green-600 text-white rounded-full hover:bg-green-700 transition duration-200">Add Content</button>
                    </div>
                    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Card 1 -->
                        <div class="bg-gray-700 p-6 rounded-lg shadow-md">
                            <h4 class="text-xl text-white">Feature 1</h4>
                            <p class="text-gray-400">Description of feature 1 goes here.</p>
                        </div>

                        <!-- Card 2 -->
                        <div class="bg-gray-700 p-6 rounded-lg shadow-md">
                            <h4 class="text-xl text-white">Feature 2</h4>
                            <p class="text-gray-400">Description of feature 2 goes here.</p>
                        </div>

                        <!-- Card 3 -->
                        <div class="bg-gray-700 p-6 rounded-lg shadow-md">
                            <h4 class="text-xl text-white">Feature 3</h4>
                            <p class="text-gray-400">Description of feature 3 goes here.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
