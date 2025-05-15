<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
   public function create(): View
    {
        // Проверяем, отправил ли пользователь уже работу
        if (Auth::user()->works()->exists()) {
            $categories = Category::all();
            return view('dashboard', compact('categories'))
                ->with('message', 'Вы уже отправили работу! Удачи в конкурсе!');
        }

        $categories = Category::all();
        return view('dashboard', compact('categories'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        // Проверка работы
        if (Auth::user()->works()->exists()) {
            return redirect()->route('dashboard')
                ->with('error', 'Вы уже отправили работу на конкурс');
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'path_img' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:2400'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        // Сохраняем изображение
        $imagePath = $request->file('path_img')->store('works', 'public');

        // Создаем работу
        Work::create([
            'title' => $validated['title'],
            'path_img' => $imagePath,
            'score' => null, // Администратор
            'category_id' => $validated['category_id'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Ваша работа успешно отправлена!');
    }
}