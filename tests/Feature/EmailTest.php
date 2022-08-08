<?php

namespace Tests\Feature;

use App\Mail\OrderMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class EmailTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_email_content()
    {
        $amount = 100.23;
        $currency = "AED";
        $mailable = new OrderMail($amount, $currency);

        $mailable->assertSeeInHtml("Amount & Currency: " . number_format((float) $amount, 2, '.', '') . ' ' . $currency);
    }

    public function test_email_sent()
    {
        $amount = 100.23;
        $currency = "AED";
        $mailTo = 'tabasum_swe@hotmail.com';

        Mail::fake();

        Mail::to($mailTo)->send(new OrderMail($amount, $currency));

        Mail::assertSent(OrderMail::class);
    }
}
