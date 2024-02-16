<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Editing a form') }}
            </h2>

            <form action="{{route('admin.forms.destroy', $form)}}" method="POST">
                @csrf
                @method('DELETE')

                <x-secondary-button type="submit" class="max-w-fit">
                    <span>Delete X</span>
                </x-secondary-button>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
                <div class="block mb-3">
                    <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">Editing new form</h5>
                </div>
                <p class="mb-4 text-neutral-500">Leave the fields unchanged if you don't want to update
                </p>

                <form method="post" action="{{route('admin.forms.update', $form)}}" id="store">
                    @csrf
                    @method('PATCH')
                    <div class="form-inputs my-2 flex flex-col gap-4">
                        <div class="flex flex-col">
                            <x-input-label for="name" value="Name" />
                            <x-text-input name="name" label="name" placeholder="Eg. John Doe" required
                                :value="$form->name" />
                            @error('name')
                            <x-input-error :messages="$message"> </x-input-error>
                            @enderror
                        </div>

                        <div class="grid gap-2" style="grid-template-columns: 70fr 30fr;">
                            <div class="flex flex-col">
                                <x-input-label for="description" value="Description" />
                                <x-text-input name="description" label="Description"
                                    placeholder="Eg. This form is for small businesses" required
                                    :value="$form->description" />
                                @error('description')
                                <x-input-error :messages="$message"> </x-input-error>
                                @enderror
                            </div>
                            <div class="flex flex-col">
                                <x-input-label for="status" value="Status" />
                                <select name="status"
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="draft" @if($form->status=='draft' ) selected @endif>Draft</option>
                                    <option value="published" @if($form->status=='published' ) selected @endif>Published
                                    </option>
                                </select>
                                @error('status')
                                <x-input-error :messages="$message"> </x-input-error>
                                @enderror
                            </div>
                        </div>

                        <input type="hidden" name="fields" id="fieldsInput">

                        <x-input-label for="fields" value="Fields" />
                        <div id="fieldsContainer">
                            <!-- Fields will be added dynamically here -->
                            @foreach ($form->fields as $field => $type)
                            <div class="mb-2 flex gap-1">
                                <x-text-input type="text" name="fieldName[]" placeholder="Field Name" :value="$field"
                                    required>
                                </x-text-input>
                                <select name="fieldType[]"
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="text" @if($type=='text' ) selected @endif>Text</option>
                                    <option value="checkbox" @if($type=='checkbox' ) selected @endif>Checkbox</option>
                                </select>
                                <x-secondary-button type="button" onclick="removeField(this)">Remove
                                </x-secondary-button>
                            </div>
                            @endforeach
                        </div>
                        @error('features')
                        <x-input-error :messages="$message"> </x-input-error>
                        @enderror

                        <x-secondary-button class="w-max" type="button" onclick="addField()">Add Field +
                        </x-secondary-button>




                        <x-primary-button type="button" onclick="submitForm()" class="max-w-fit">
                            <span>Edit form &rarr;</span>
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
        function addField() {
          var fieldsContainer = document.getElementById('fieldsContainer');

          var fieldInput = document.createElement('div');
          fieldInput.classList.add('field-input', 'mb-2', 'flex', 'gap-1');

          fieldInput.innerHTML = `
            <x-text-input type="text" name="fieldName[]"  placeholder="Field Name" required></x-text-input>
            <select name="fieldType[]" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="text">Text</option>
                <option value="checkbox">Checkbox</option>
            </select>
            <x-secondary-button type="button" onclick="removeField(this)">Remove</x-secondary-button>
          `;

          fieldsContainer.appendChild(fieldInput);
        }

        function removeField(button) {
          var fieldInput = button.parentNode; // gets the div
          fieldInput.parentNode.removeChild(fieldInput); // gets the div container and removes the div
        }

        function submitForm() {
          var form = document.getElementById('store');


          var fields = [];
          var fieldNameInputs = form.querySelectorAll('input[name="fieldName[]"]');
          var fieldTypeInputs = form.querySelectorAll('select[name="fieldType[]"]');


            for (var i = 0; i < fieldNameInputs.length; i++) {
                var key = fieldNameInputs[i].value.trim();
                var value = fieldTypeInputs[i].value.trim();

                if (key !== '' && value !== '') {
                fields.push({ key: key, value: value });
                }
            }
          // Include fields in your AJAX request or form submission
          console.log('form Name:', form.elements['name'].value);
          console.log('form Description:', form.elements['description'].value);
          console.log('fields:', fields);

          document.getElementById('fieldsInput').value = JSON.stringify(fields);

          form.submit();
        }

    </script>

</x-app-layout>