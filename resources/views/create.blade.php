<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6 text-gray-900">
    <a href="{{ route('welcome') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
        Посмотреть задание
    </a>
</div>
 

@if (auth()->user()->works()->exists())
    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded">
        <p>Вы уже отправили работу! Удачи в конкурсе!</p>
    </div>
@else
    <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data" class="p-8 space-y-6">
        @csrf
        
        <!-- Название работы -->
        <div>
            <x-input-label for="title" :value="__('Название работы')" />
            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <!-- Выбор категории -->
        <div>
            <x-input-label for="category_id" :value="__('Категория')" />
            <select id="category_id" name="category_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1">
                <option value="" disabled selected>-- Выберите категорию --</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->title }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
        </div>

        <!-- Загрузка изображения -->
        <div>
            <x-input-label for="path_img" :value="__('Изображение работы')" />
            <x-text-input id="path_img" class="block mt-1 w-full" type="file" name="path_img" required />
            <x-input-error :messages="$errors->get('path_img')" class="mt-2" />
        </div>

        <x-primary-button class="mt-4">
            {{ __('Отправить заявку') }}
        </x-primary-button>
    </form>
@endif
        </div>
    </div>
</div>
</x-app-layout>

