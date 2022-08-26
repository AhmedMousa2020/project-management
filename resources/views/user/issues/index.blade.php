<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your issues') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col">
                        @if (count($issues) < 1)
                            <h3 class="text-lg w-full text-center">You have no issues</h3>
                        @else
                        <div class="flex-grow overflow-auto">
                        
                            <table class="relative w-full border table-fixed">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 w-1/4 text-gray-900 bg-gray-100">Issue Name</th>
                                        <th class="px-6 py-3 w-1/2 text-gray-900 bg-gray-100">Issue Description</th>
                                        <th class="px-6 py-3 w-1/2 text-gray-900 bg-gray-100">Project Title</th>
                                        <th class="px-6 py-3 w-1/2 text-gray-900 bg-gray-100">Assigned For</th>
                                        <th class="px-4 py-1 w-1/2 text-gray-900 bg-gray-100">Status</th>
                                        <th class="px-6 py-3 w-1/4 text-gray-900 bg-gray-100">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y">
                                    @foreach ($issues as $issue)
                                        <tr>
                                            <td class="px-6 py-4 text-left">
                                                <h2 class="font-bold">{{ $issue->title }}</h2>
                                                <span class="text-sm font-light text-gray-400">Updated
                                                    {{ $issue->created_at }}</span>
                                            </td>
                                            <td class="px-6 py-4 text-center">{{ $issue->description }}</td>
                                            <td class="px-6 py-4 text-center">{{ \App\Models\Project::where(['id' => $issue->project_id])->pluck('title')->first()}}</td>
                                            <td class="px-6 py-4 text-center">
                                         
                                                @foreach ( \App\Models\Issue::find($issue->id)->issueUser as $issue_user)
                                                    {{ \App\Models\User::where(['id' => $issue_user->user_id])->pluck('name')->first()}}<br>
                                                @endforeach
                                            
                                            </td>
                                            <td class="px-4 py-2 text-center">
                                                 @if($issue->stage_id != 3)
                                                    <p class="inline-flex focus:outline-none text-red-500 text-bg py-1" >To Do<p>
                                                @else
                                                    <p class="inline-flex focus:outline-none text-green-500 text-bg py-1" >Done<p>
                                                 @endif
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                @if($issue->stage_id != 3)
                                                    <a href="{{ route('user-issues.edit', $issue->id) }}"
                                                        class="inline-flex focus:outline-none text-white text-sm py-1 px-2 rounded-md bg-yellow-500 hover:bg-yellow-600 hover:shadow-lg">
                                                        Submit
                                                    </a>
                                                @else
                                                    <p 
                                                        class="inline-flex focus:outline-none text-white text-sm py-1 px-2 rounded-md bg-gray-500 hover:bg-gray-600 hover:shadow-lg">
                                                        Submit
                                                    </p>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>   
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
