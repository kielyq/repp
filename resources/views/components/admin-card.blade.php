
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($works as $work)
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow dark:border-gray-700 dark:bg-gray-800">
                            @if($work->path_img)
                                <img class="w-full h-48 object-cover rounded-t-lg" 
                                     src="{{ asset('storage/' . $work->path_img) }}" 
                                     alt="{{ $work->title }}">
                            @endif
                            <div class="p-4">
                                <h5 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">
                                    {{ $work->title }}
                                </h5>
                                <p class="text-gray-700 dark:text-gray-400 mb-2">
                                    Автор: {{ $work->user->name }}
                                </p>
                                <p class="text-gray-600 dark:text-gray-300">
                                    Категория: {{ $work->category->title ?? 'Не указана' }}
                                </p>
                                @if($work->score !== null)
                                    <div class="mt-3 p-2 bg-blue-50 dark:bg-blue-900 rounded">
                                        Оценка: <span class="font-bold">{{ $work->score }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
           