<?php

namespace App\Observers;

use App\BookDate;
use Illuminate\Support\Facades\Notification;
use App\Notifications\BookDatePaidNotification;
use App\Notifications\DataChangeEmailNotification;

class BookDateActionObserver
{
    public function created(BookDate $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'BookDate'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(BookDate $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'BookDate'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new BookDatePaidNotification($data));
    }

    public function deleting(BookDate $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'BookDate'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
