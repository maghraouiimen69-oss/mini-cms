<x-layout>
    <x-slot:title>Heure - Mini-CMS</x-slot:title>

    <h1 class="text-3xl font-bold">Il est {{ $heure }}</h1>
    <p class="mt-4 text-gray-700">Nous sommes le {{ $date }} (fuseau {{ config('app.timezone') }}).</p>
</x-layout>
