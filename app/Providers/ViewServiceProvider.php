<?php

namespace App\Providers;

use Auth;
use App\Tag;
use App\Role;
use App\Entry;
use App\Checkitem;
use App\Department;
use App\Thread;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeHeader();
        // $this->composeSidebar();
        // $this->composeEntriesFilter();
        $this->composeUsersFilter();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function composeHeader()
    {
        // latest messages for navigation
        // view()->composer('layouts.header', function($view)
        // {
        //     $view->with('messages', Thread::forUser(Auth::id())->latest('updated_at')->limit(5)->get());
        // });

        // latest notifications for navigation
        view()->composer('layouts.header', function($view)
        {
            $view->with('notifications', auth()->user()->notifications()->latest('created_at')->limit(5)->get());
        });
    }

    public function composeSidebar()
    {
        // view()->composer('layouts.sidebar', function($view)
        // {
        //     if (auth()->user()->hasRole('admin')) {
        //         // $view->with('documents', Entry::documents()->get());
        //         // $view->with('passwords', Entry::passwds()->get());

        //         $view->with('counts', [
        //             'passwords' => Entry::passwds()->count(),
        //             'documents' => Entry::documents()->count(),
        //         ]);
        //     } else {
        //         // $view->with('documents', auth()->user()->document->merge(auth()->user()->documents));
        //         // $view->with('passwords', auth()->user()->passwd->merge(auth()->user()->passwds));

        //         $view->with('counts', [
        //             'passwords' => auth()->user()->passwd->merge(auth()->user()->passwds)->count(),
        //             'documents' => auth()->user()->document->merge(auth()->user()->documents)->count(),
        //         ]);
        //     }
        // });
    }

    // public function composeEntriesFilter()
    // {
    //     view()->composer('entries._filter', function($view)
    //     {
    //         $tags = Tag::orderBy('name')->get();
    //         $view->with('tags', $tags);

    //         if (auth()->user()->hasRole('admin')) {
    //             $view->with('documents', Entry::documents()->get()->sortByDesc('is_printable'));
    //             $view->with('passwords', Entry::passwds()->get());
    //         } else {
    //             $view->with('documents', auth()->user()->document->merge(auth()->user()->documents));
    //             $view->with('passwords', auth()->user()->passwd->merge(auth()->user()->passwds));
    //         }

    //         $view->with('counts', [
    //             'my_tasks' => auth()->user()->task->count(),
    //             // 'forme_tasks' => auth()->user()->tasks->count(),
    //             'open_tasks' => Entry::tasks()->uncompleted()->count(),
    //             'expired_tasks' => Entry::tasks()->expired()->count(),
    //             'important_tasks' => Entry::tasks()->important()->count(),
    //             'today_tasks' => Entry::tasks()->today()->count(),
    //             'deleted_tasks' => Entry::tasks()->deleted()->count(),

    //             'my_articles' => auth()->user()->article->count(),
    //             'deleted_articles' => Entry::articles()->deleted()->count(),
    //         ]);

    //         // $view->with('counts', [
    //         //     'user_articles_by_tag' => Entry::tag('servers')
    //         //     ->whereHas('users', function($q){
    //         //         $q->where('id', auth()->user()->id)
    //         //         ->orWhere('user_id', auth()->user()->id);
    //         //     })
    //         //     ->get()
    //         // ]);
    //     });

    //     view()->composer('logs.checks.create', function($view)
    //     {
    //         $h = \Carbon\Carbon::now()->format('H');
    //         $d =\Carbon\Carbon::now()->format('l'); // friday

    //         if ($d == 'Friday' && $h > 17) {
    //             $checkitems = Checkitem::evening()->orWhere('time', 'Петък')->get();
    //             $view->with('checkitems', $checkitems);
    //         } elseif ($h < 17) {
    //             $checkitems = Checkitem::morning()->get();
    //             $view->with('checkitems',$checkitems);
    //         } else {
    //             $checkitems = Checkitem::evening()->get();
    //             $view->with('checkitems', $checkitems);
    //         }

    //     });
    // }

    public function composeUsersFilter()
    {
        // view()->composer('users.filter', function($view)
        // {
        //     $view->with('roles', Role::whereHas('users')->get());
        // });
    }
}
