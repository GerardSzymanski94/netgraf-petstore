@php

function categorySelected($id, $pet):bool {
    return old('category') ? explode('_', old('category'))[0] == $id : isset($pet['category']['id']) && $pet['category']['id'] == $id;
}

function tagsChecked($id, $pet):bool{
    return old('tags') ? isset(old('tags')[$id]) : isset($pet['tags']) && in_array($id, array_column($pet['tags'] ?? [], 'id'));
}

$pet = $pet ?? null;

@endphp

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
                    <option value="1_Dog" @selected(categorySelected(1, $pet))>Dog</option>
                    <option value="2_Cat" @selected(categorySelected(2, $pet))>Cat</option>
                    <option value="3_Bird" @selected(categorySelected(3, $pet))>Bird</option>
                    <option value="4_Other" @selected(categorySelected(4, $pet))>Other</option>
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
                Photo Urls (separate by ',')
            </th>
            <td class="px-6 py-4">
                <input type="text" name="photoUrls" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                       value="{{ old('photoUrls', implode(',', $pet['photoUrls'] ?? []))  }}">

            </td>
        </tr>
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                Add new photo
            </th>
            <td class="px-6 py-4">
                <input type="file" name="photo">
                <input type="text" placeholder="Additional metadata" value="{{ old('additional_metadata', $pet['additional_metadata'] ?? null) }}" name="additional_metadata" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
                @error('photo')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </td>
        </tr>
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                Tags
            </th>
            <td class="px-6 py-4">
                    <label><input type="checkbox" name="tags[1]" value="Healthy" @checked(tagsChecked(1, $pet))> Healthy </label>
                    <label><input type="checkbox" name="tags[2]" value="Sick" @checked(tagsChecked(2, $pet))> Sick </label>
                    <label><input type="checkbox" name="tags[3]" value="Funny" @checked(tagsChecked(3, $pet))> Funny </label>
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
                        <option value="{{ $enum->value }}" @selected(old('status', $pet['status'] ?? null) == $enum->value)>{{ $enum->name }}</option>
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
