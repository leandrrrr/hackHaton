<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Departement Stats') }}
        </h2>
    </x-slot>

    <h2>Délits associés :</h2>
    <ul>
        @foreach($delits as $delit)
            <li>{{ $delit->id }}</li>
        @endforeach
    </ul>

</x-app-layout>
