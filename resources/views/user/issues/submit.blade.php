<x-app-layout>
    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Submit Issue
        </h2>
    </x-slot>

    <div class="py-12 xs:px-4">
        <div class="max-w-3xl mx-auto px-4 lg:px-8">
            <form action="{{  route('file.upload')}}" method="POST" enctype="multipart/form-data">
                @csrf
                {{ method_field('put') }}
                @if (!request()->routeIs('issues.create'))
                    <input type="hidden" name="_method" value="PUT">
                @endif

                <div class="border-t border-b border-gray-300 py-8">
                    <div class="md:w-2/3 w-full mb-6">
                        <label for="title" class="block text-sm font-bold text-gray-700">
                            issue Title
                        </label>
                        {{ $issue->title }}
                    </div>
                    <div>
                        <label for="comment" class="block text-sm font-bold text-gray-700">
                            Comment <span class="text-xs text-gray-500"></span>
                        </label>
                        <div class="mt-1 mb-6">
                            <textarea id="comment" name="comment" rows="7"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                        </div>
                    </div>
                    <input type="hidden" value="{{$issue->id}}" name="issue_id"/>
                    @if (isset(\App\Models\Issue::find($issue->id)->issueUser) &&
                        count(\App\Models\Issue::find($issue->id)->issueUser) > 0)
                        <div>
                            <label for="assigned" class="mt-1 block text-sm font-bold text-gray-700">
                                Employees Assigned
                            </label>
                            <div class="mt-1 mb-6">
                                <P>
                                    @foreach (\App\Models\Issue::find($issue->id)->issueUser as $issue_user)
                                        {{ \App\Models\User::where(['id' => $issue_user->user_id])->pluck('name')->first() }}<br>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    @endif

                    <div class="mb-6">
                        <label for="project" class="mt-1 block text-sm font-bold text-gray-700">
                            Assigned for Project
                        </label>
                        {{ $project->title }}
                    </div>

                    <div>
                        <label for="project" class="mt-1 block text-sm font-bold text-gray-700">
                            upload issue
                        </label>
                        <div class="row mb-6">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="file" name="file" placeholder="Choose file" id="file">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 sm:mt-4">
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ request()->routeIs('issues.create') ? __('Create') : __('Submit') }} {{ __('issue') }}
                        </button>
                    </div>
                
            </form>
        </div>
    </div>

   
</x-app-layout>
