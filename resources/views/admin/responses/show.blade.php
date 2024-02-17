<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Viewing Response') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
                <div class="block mb-3">
                    <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">{{$response->id}} |
                        {{$response->email}}</h5>
                </div>
                <p class="mb-4 text-neutral-500">{{$response->description}}</p>


                <h3>Fields </h3>
                <div class="flex flex-col my-2 gap-2">
                    @foreach ($response->fields as $field => $value)

                    <div class="max-w bg-white border rounded-lg shadow-sm p-4 border-neutral-200/60 bg-gray-200">
                        <div class="block mb-1 flex  gap-2 flex flex-col ">
                            <h5 class="text-lg font-bold leading-none tracking-tight text-neutral-900">{{$field}}
                                <span class="text-muted text-sm text-gray-500">{{isset($response->form->fields->$field)
                                    ?
                                    $response->form->fields->$field :
                                    'unkown type' }}</span>
                            </h5>
                            @if(strlen($value) > 0)
                            <div class="flex justify-between items-center">
                                <span
                                    class="bg-blue-800 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-800 dark:text-blue-300">{{$value}}</span>
                                <div x-data="{
                                    copyText: '{{$value}}',
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
                                    <button @click="copyToClipboard();"
                                        class="flex items-center justify-center w-auto  px-3 py-1 text-xs bg-white border rounded-md cursor-pointer border-neutral-200/60 hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none text-neutral-500 hover:text-neutral-600 group">
                                        <span x-show="!copyNotification">Copy to Clipboard</span>
                                        <svg x-show="!copyNotification" class="w-4 h-4 ml-1.5 stroke-current"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                        </svg>
                                        <span x-show="copyNotification" class="tracking-tight text-green-500"
                                            x-cloak>Copied
                                            to Clipboard</span>
                                        <svg x-show="copyNotification"
                                            class="w-4 h-4 ml-1.5 text-green-500 stroke-current"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" x-cloak>
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            @else
                            <span
                                class="w-max bg-red-800 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-800 dark:text-red-300">No
                                value</span>
                            @endif
                        </div>

                    </div>
                    @endforeach
                </div>

                <x-primary-link href="{{route('admin.forms.edit', $response->form)}}"
                    class="inline-flex items-center justify-between w-auto h-10 px-4 py-2 text-sm font-medium text-white transition-colors rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-neutral-950 hover:bg-neutral-950/90">
                    <span>Edit form &rarr;</span>
                </x-primary-link>
            </div>
        </div>
    </div>
</x-app-layout>
