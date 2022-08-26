<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col">
                        @if (count($users) < 1)
                            <h3 class="text-lg w-full text-center"> no users</h3>
                        @else
                        <div class="flex-grow overflow-auto">
                            <table class="relative w-full border table-fixed">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 w-1/4 text-gray-900 bg-gray-100">Name</th>
                                        <th class="px-6 py-3 w-1/2 text-gray-900 bg-gray-100">Email</th>
                                        <th class="px-6 py-3 w-1/2 text-gray-900 bg-gray-100">Projects Created</th>
                                        <th class="px-6 py-3 w-1/2 text-gray-900 bg-gray-100">Issues Assigned</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y">
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="px-6 py-4 text-left">
                                                <h2 class="font-bold">{{ $user->name }}</h2>
                                                <span class="text-sm font-light text-gray-400">Updated
                                                    {{ $user->created_at }}</span>
                                            </td>
                                            <td class="px-6 py-4 text-center">{{ $user->email }}</td>
                                            <td class="px-6 py-4 text-center">{{ \App\Models\Project::where(['user_id' => $user->id])->pluck('title')->first()}}</td>
                                            <td class="px-6 py-4 text-center">
                                         
                                            @foreach ( \App\Models\Issueuser::where('user_id',$user->id)->get() as $user)
                                                {{ \App\Models\Issue::where(['id' => $user->issue_id])->pluck('title')->first()}}<br>
                                            @endforeach
                                          
                                            </td>
                                           
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                             {{$users->links()}}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
