@extends('layouts.app')


@section('content')
    <div>
        <form class="w-full max-w-lg" action="{{ route('petstore.find') }}" method="post">
            @csrf
            <div class="flex items-center border-b border-teal-500 py-2">
                <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                       name="pet_id" id="grid-id" type="number" placeholder="Pet ID" value="{{ old('pet_id', session('pet')['id'] ?? session('petId') ?? null)  }}" aria-label="Full name">

                <button class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded" type="submit">
                   Find
                </button>
            </div>
            @error('pet_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </form>

        @if(session('pet'))
            <div class="mt-6 relative overflow-x-auto">
                <table class="table-fixed w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Key</th>
                            <th scope="col" class="px-6 py-3">Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(session('pet') as $key => $item)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $key }}
                                </th>
                                <td class="px-6 py-4">
                                    @if(is_array($item))
                                        @isset($item['name'])
                                            {{ $item['name'] }}
                                        @else
                                            @foreach($item as $value)
                                                <p>{{ $value['name'] ?? $value }}</p>
                                            @endforeach
                                        @endisset

                                    @else
                                        {{ $item }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endisset

    </div>
@endsection
