<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tickets') }}
            </h2>

            @can('crear tickets')
                <a href="{{ route('tickets.create') }}">
                    <x-primary-button>{{ __('Nuevo ticket') }}</x-primary-button>
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-4">
                    <p>{{ __('Listado de tickets.') }}</p>

                    @can('gestionar tickets')
                        <a href="{{ route('tickets.manage') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                            {{ __('Gestionar tickets') }}
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
