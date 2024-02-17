<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Viewing Form') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
                <div class="block mb-3">
                    <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">{{$form->name}}</h5>
                </div>
                <p class="mb-4 text-neutral-500">{{$form->description}}</p>


                <h3>Fields </h3>
                <div class="flex flex-col my-2 gap-2">
                    @foreach ($form->fields as $field => $type)

                    <div class="max-w bg-white border rounded-lg shadow-sm p-4 border-neutral-200/60 bg-gray-200">
                        <div class="block mb-1 flex items-center gap-2">
                            <h5 class="text-lg font-bold leading-none tracking-tight text-neutral-900">{{$field}}</h5>
                            <span
                                class="bg-blue-800 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-800 dark:text-blue-300">{{$type}}</span>
                        </div>

                    </div>
                    @endforeach
                </div>

                <x-primary-link href="{{route('admin.forms.edit', $form)}}"
                    class="inline-flex items-center justify-between w-auto h-10 px-4 py-2 text-sm font-medium text-white transition-colors rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-neutral-950 hover:bg-neutral-950/90">
                    <span>Edit form &rarr;</span>
                </x-primary-link>
            </div>
        </div>
    </div>
</x-app-layout>