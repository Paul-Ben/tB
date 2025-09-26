<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Guardian Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-green-500 to-blue-600 rounded-lg shadow-lg mb-6">
                <div class="px-6 py-4 sm:px-6 sm:py-6">
                    <h3 class="text-xl font-semibold text-white">Welcome, {{ $user->name }}!</h3>
                    <p class="text-green-100 mt-1">Stay connected with your child's education journey.</p>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">My Children</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $childrenCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Pending Tasks</p>
                                <p class="text-2xl font-semibold text-gray-900">3</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">This Week's Grades</p>
                                <p class="text-2xl font-semibold text-green-600">A-</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow cursor-pointer">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-lg font-medium text-gray-900">View Grades</h4>
                                <p class="text-sm text-gray-500">Check your child's academic progress</p>
                            </div>
                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow cursor-pointer">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-lg font-medium text-gray-900">Attendance</h4>
                                <p class="text-sm text-gray-500">Track attendance records</p>
                            </div>
                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow cursor-pointer">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-lg font-medium text-gray-900">Messages</h4>
                                <p class="text-sm text-gray-500">Communicate with teachers</p>
                            </div>
                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Upcoming Events -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Upcoming Events</h3>
                        <div class="space-y-3">
                            <div class="flex items-start p-3 bg-blue-50 rounded-lg">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Parent-Teacher Conference</p>
                                    <p class="text-sm text-gray-500">Tomorrow at 3:00 PM</p>
                                    <p class="text-xs text-gray-400">Room 205 with Ms. Johnson</p>
                                </div>
                            </div>
                            <div class="flex items-start p-3 bg-green-50 rounded-lg">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">School Science Fair</p>
                                    <p class="text-sm text-gray-500">Friday, Oct 15th</p>
                                    <p class="text-xs text-gray-400">Gym Hall - 10:00 AM to 3:00 PM</p>
                                </div>
                            </div>
                            <div class="flex items-start p-3 bg-purple-50 rounded-lg">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Field Trip Permission</p>
                                    <p class="text-sm text-gray-500">Due: Oct 20th</p>
                                    <p class="text-xs text-gray-400">Natural History Museum visit</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Updates -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Updates</h3>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Math Assignment Graded</p>
                                    <p class="text-sm text-gray-500">Sarah received an A on her algebra homework</p>
                                    <p class="text-xs text-gray-400">2 hours ago</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Teacher Message</p>
                                    <p class="text-sm text-gray-500">Ms. Johnson: "Great participation in class today!"</p>
                                    <p class="text-xs text-gray-400">1 day ago</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Reminder</p>
                                    <p class="text-sm text-gray-500">Library book is due tomorrow</p>
                                    <p class="text-xs text-gray-400">2 days ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>