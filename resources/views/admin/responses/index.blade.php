<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Managing Responses') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between mb-2">
            <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                href="{{route('admin.forms.index')}}">Manage Forms &rarr;</a>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Response ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Form ID
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Copy Link
                        </th>

                        <th scope="col" class="px-6 py-3 text-right">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if($responses->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center py-4">No responses found.</td>
                    </tr>
                    @endif

                    @foreach($responses as $response)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <th scope="row" class="px-6 py-4">
                            {{Str::limit($response->id, 32)}}
                        </th>
                        <td class="px-6 py-4">
                            {{Str::limit($response->email, 42)}}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{route('admin.forms.show', $response->form)}}">{{Str::limit($response->form_id,
                                42)}}</a>
                        </td>

                        <td class="px-6 py-4">
                            <div x-data="{
        copyText: '{{route('admin.responses.show', $response->key)}}',
        copyNotification: false,
        copyToClipboard() {
            navigator.clipboard.writeText(this.copyText);
            this.copyNotification = true;
            let that = this;
            setTimeout(function(){
                that.copyNotification = false;
            }, 3000);
        }
    }" class="relative z-20 flex items-center">
                                <div x-show="copyNotification" x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 translate-x-2"
                                    x-transition:enter-end="opacity-100 translate-x-0"
                                    x-transition:leave="transition ease-in duration-300"
                                    x-transition:leave-start="opacity-100 translate-x-0"
                                    x-transition:leave-end="opacity-0 translate-x-2" class="absolute left-0" x-cloak>
                                    <div
                                        class="px-3 h-7 -ml-1.5 items-center flex text-xs bg-green-500 border-r border-green-500 -translate-x-full text-white rounded">
                                        <span>Copied!</span>
                                        <div
                                            class="absolute right-0 inline-block h-full -mt-px overflow-hidden translate-x-3 -translate-y-2 top-1/2">
                                            <div
                                                class="w-3 h-3 origin-top-left transform rotate-45 bg-green-500 border border-transparent">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button @click="copyToClipboard();"
                                    class="flex items-center justify-center h-8 text-xs bg-white border rounded-md cursor-pointer w-9 border-neutral-200/60 hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none text-neutral-500 hover:text-neutral-600 group">
                                    <svg x-show="copyNotification" class="w-4 h-4 text-green-500 stroke-current"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" x-cloak>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                    <svg x-show="!copyNotification" class="w-4 h-4 stroke-current" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g fill="none" stroke="none">
                                            <path
                                                d="M7.75 7.757V6.75a3 3 0 0 1 3-3h6.5a3 3 0 0 1 3 3v6.5a3 3 0 0 1-3 3h-.992"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M3.75 10.75a3 3 0 0 1 3-3h6.5a3 3 0 0 1 3 3v6.5a3 3 0 0 1-3 3h-6.5a3 3 0 0 1-3-3v-6.5z"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </svg>
                                </button>
                            </div>
                        </td>

                        <td class="p-4 max-h flex gap-4 justify-end">
                            <a href="{{route('admin.responses.edit', $response)}}"
                                class="font-medium text-blue-600 hover:underline">Edit</a>
                            <a href="{{route('admin.responses.show', $response->key)}}"
                                class="font-medium text-blue-600 hover:underline">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-2">
            {{$responses->links()}}
        </div>
    </div>
</x-app-layout>
