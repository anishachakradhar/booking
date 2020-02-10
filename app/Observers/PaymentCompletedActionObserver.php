<?php

namespace App\Observers;

use App\Payment;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PaymentCompletedEmailNotification;

class PaymentCompletedActionObserver
{
    /**
     * Handle the payment "created" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function created(Payment $payment)
    {
        $data  = ['action' => 'created', 'model_name' => 'Payment'];
        $paid_user = Payment::where('book_date_id',$payment->book_date_id)->with('bookDatePayment.date')->first();
        dump($paid_user->toArray());
        $payment->notify(new PaymentCompletedEmailNotification($data, $paid_user));
    }

    /**
     * Handle the payment "updated" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function updated(Payment $payment)
    {
        //
    }

    /**
     * Handle the payment "deleted" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function deleted(Payment $payment)
    {
        //
    }

    /**
     * Handle the payment "restored" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function restored(Payment $payment)
    {
        //
    }

    /**
     * Handle the payment "force deleted" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function forceDeleted(Payment $payment)
    {
        //
    }
}
