<x-app-layout>
    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ request()->routeIs('issues.create') ? __('Create a New') : __('Edit') }} {{ __('issue') }}
        </h2>
    </x-slot>

    <div class="py-12 xs:px-4">
        <div class="max-w-3xl mx-auto px-4 lg:px-8">
            <form action="{{ request()->routeIs('issues.create') ? route('issues.store') : route('issues.update', $issue->id) }}" method="POST">
                @csrf
                @if (!request()->routeIs('issues.create'))
                    <input type="hidden" name="_method" value="PUT">
                @endif
                <div class="border-t border-b border-gray-300 py-8">
                    <div class="md:w-2/3 w-full mb-6">
                        <label for="title" class="block text-sm font-bold text-gray-700">
                            issue Title
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input type="text" name="title" id="title" value="{{ $issue->title }}"
                                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                                placeholder="issue Title">
                        </div>
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-bold text-gray-700">
                            Description <span class="text-xs text-gray-500">(Optional)</span>
                        </label>
                        <div class="mt-1">
                            <textarea id="description" name="description" rows="7"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md">{{ $issue->description }}</textarea>
                        </div>
                    </div>

                    @if (isset(\App\Models\Issue::find($issue->id)->issueUser) && count(\App\Models\Issue::find($issue->id)->issueUser) > 0)
                        <div>
                            <label for="assigned" class="mt-1 block text-sm font-bold text-gray-700">
                                Employees Selected
                            </label>
                            <div class="mt-1">
                                <P>
                                    @foreach (\App\Models\Issue::find($issue->id)->issueUser as $issue_user)
                                        <meta name="csrf-token" content="{{ csrf_token() }}">
                                        <button id="deleteRecord_{{ $issue_user->user_id }}"
                                            onclick="getId({{ $issue_user->user_id }},{{ $issue->id }})"
                                            class="focus:outline-none text-white text-sm py-1 px-2 rounded-md bg-red-500 hover:bg-red-600 hover:shadow-lg"
                                            type="button" name="deleting">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                        {{ \App\Models\User::where(['id' => $issue_user->user_id])->pluck('name')->first() }}<br>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    @endif
                    <div>
                        <label for="assigned" class="mt-1 block text-sm font-bold text-gray-700">
                            Select Employee Assigned
                        </label>
                        <div class="mt-1">
                            <select id="assigned" class="js-example-basic-multiple" placeholder="Select Employee"
                                name="assigned[]" multiple="multiple">
                                @foreach (\App\Models\User::get() as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach


                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="project" class="mt-1 block text-sm font-bold text-gray-700">
                            Assigned for Project
                        </label>
                        <div class="mt-1">
                            <select id="project" name="project">
                                @foreach (\App\Models\Project::get() as $name)
                                    <option value="{{ $name->id }}">{{ $name->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="mt-6 sm:mt-4">
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ request()->routeIs('issues.create') ? __('Create') : __('Save') }} {{ __('issue') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
