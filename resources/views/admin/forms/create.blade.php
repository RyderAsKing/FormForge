<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add a new form') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
                <div class="block mb-3">
                    <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">Creating a new form</h5>
                </div>
                <p class="mb-4 text-neutral-500">Creating a new form by providing a name, description and its fields
                </p>

                <form method="post" action="{{route('admin.forms.store')}}" id="store">
                    @csrf

                    <div class="form-inputs my-2 flex flex-col gap-4">
                        <div class="flex flex-col">
                            <x-input-label for="name" value="Name" />
                            <x-text-input name="name" label="name" placeholder="Eg. Migration request" required />
                            @error('name')
                            <x-input-error :messages="$message"> </x-input-error>
                            @enderror
                        </div>

                        <div class="flex flex-col">
                            <x-input-label for="description" value="Description" />
                            <x-text-input name="description" label="Description"
                                placeholder="Eg. This form is for small businesses" required />
                            @error('email')
                            <x-input-error :messages="$message"> </x-input-error>
                            @enderror
                        </div>

                        <div class="flex flex-col">
                            <x-input-label for="status" value="Status" />
                            <select name="status"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="draft">Draft</option>
                                <option value="published">Published
                                </option>
                            </select>
                            @error('status')
                            <x-input-error :messages="$message"> </x-input-error>
                            @enderror
                        </div>

                        <input type="hidden" name="fields" id="fieldsInput">

                        <x-input-label for="fields" value="Fields" />
                        <div id="fieldsContainer">
                            <!-- fields will be added dynamically here -->
                        </div>
                        @error('fields')
                        <x-input-error :messages="$message"> </x-input-error>
                        @enderror

                        <x-secondary-button class="w-max" type="button" onclick="addField()">Add Field +
                        </x-secondary-button>


                        <x-primary-button type="button" onclick="submitForm()" class="max-w-fit">
                            <span>Create form &rarr;</span>
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

        document.addEventListener('DOMContentLoaded', function () {
          addField();
        });
    </script>

</x-app-layout>