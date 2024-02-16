<div class="mt-6 relative overflow-x-auto">
    <table class="table-fixed w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">Key</th>
            <th scope="col" class="px-6 py-3">Value</th>
        </tr>
        </thead>
        <tbody>

        @isset($pet['id'])
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    ID
                </th>
                <td class="px-6 py-4">
                    {{ $pet['id'] }}
                </td>
            </tr>
        @endisset
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                Category
            </th>
            <td class="px-6 py-4">
                <select name="category" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Select</option>
                    <option value="1_Dog" @selected(isset($pet['category']['id']) && $pet['category']['id'] == 1)>Dog</option>
                    <option value="2_Cat" @selected(isset($pet['category']['id']) && $pet['category']['id'] == 2)>Cat</option>
                    <option value="3_Bird" @selected(isset($pet['category']['id']) && $pet['category']['id'] == 3)>Bird</option>
                    <option value="4_Other" @selected(isset($pet['category']['id']) && $pet['category']['id'] == 4)>Other</option>
                    @if(isset($pet['category']['id']) && isset($pet['category']['name']) && $pet['category']['id'] > 4)
                        <option value="{{ $pet['category']['id'] }}_{{ $pet['category']['name'] }}" selected>{{ $pet['category']['name'] }}</option>
                    @endif
                </select>
                @error('category')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </td>
        </tr>
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                Name
            </th>
            <td class="px-6 py-4">
                <input type="text" placeholder="Name" value="{{ old('name', $pet['name'] ?? null) }}" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">

                @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </td>
        </tr>
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                Photo Urls
            </th>
            <td class="px-6 py-4">
                @isset($pet['photoUrls'])
                    @foreach($pet['photoUrls'] as $photo)
                        <p>{{ $photo }}</p>
                        <input type="hidden" name="photos[]" value="{{ $photo }}">
                    @endforeach
                @endisset
            </td>
        </tr>
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                Add new photo
            </th>
            <td class="px-6 py-4">
                <input type="file" name="photo">
                <input type="text" placeholder="Additional metadata" value="{{ old('additional_metadata', $pet['additional_metadata'] ?? null) }}" name="additional_metadata" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
            </td>
        </tr>
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                Tags
            </th>
            <td class="px-6 py-4">
                    <label><input type="checkbox" name="tags[]" value="1_Healthy" @checked(isset($pet['tags']) && in_array(1, array_column($pet['tags'] ?? [], 'id')))> Healthy </label>
                    <label><input type="checkbox" name="tags[]" value="2_Sick" @checked(isset($pet['tags']) && in_array(2, array_column($pet['tags'] ?? [], 'id')))> Sick </label>
                    <label><input type="checkbox" name="tags[]" value="3_Funny" @checked(isset($pet['tags']) && in_array(3, array_column($pet['tags'] ?? [], 'id')))> Funny </label>
            </td>
        </tr>
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                Status
            </th>
            <td class="px-6 py-4">
                <select name="status" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Select</option>
                    @foreach(\App\Enums\PetStatusEnum::cases() as $enum)
                        <option value="{{ $enum->value }}" @selected(isset($pet['status']) && $pet['status'] == $enum->value)>{{ $enum->name }}</option>
                    @endforeach
                </select>

                @error('status')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </td>
        </tr>
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <td class="px-6 py-4">
                <button type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Save</button>
            </td>
        </tr>
        </tbody>
    </table>
</div>
