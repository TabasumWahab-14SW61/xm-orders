<?php

namespace Tests\Feature;

use App\Http\Requests\OrderRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->validator = app()->get('validator');

        $this->rules = (new OrderRequest())->rules();
    }

    public function validationProvider()
    {

        return [
            'request_should_fail_when_invalid_email' => [
                'passed' => false,
                'data' => [
                    'amount' => '100.50',
                    'currency' => 'AED',
                    'email' => 'tabasum_swe@hotmail',
                ]
            ],
            'request_should_fail_when_invalid_currency' => [
                'passed' => false,
                'data' => [
                    'amount' => '100.50',
                    'currency' => 'PKR',
                    'email' => 'tabasum_swe@hotmail.com',
                ]
            ],
            'request_should_fail_when_invalid_iso_4217_currency' => [
                'passed' => false,
                'data' => [
                    'amount' => '100.50',
                    'currency' => 'UAED',
                    'email' => 'tabasum_swe@hotmail.com',
                ]
            ],
            'request_should_fail_when_amount_is_missing' => [
                'passed' => false,
                'data' => [
                    'currency' => 'AED',
                    'email' => 'tabasum_swe@hotmail.com',
                ]
            ],
            'request_should_fail_when_currency_is_missing' => [
                'passed' => false,
                'data' => [
                    'amount' => '100.50',
                    'email' => 'tabasum_swe@hotmail.com',
                ]
            ],
            'request_should_fail_when_email_is_missing' => [
                'passed' => false,
                'data' => [
                    'amount' => '100.50',
                    'currency' => 'AED',
                ]
            ],
            'request_should_pss_when_data_is_provided' => [
                'passed' => true,
                'data' => [
                    'amount' => '100.50',
                    'currency' => 'AED',
                    'email' => 'tabasum_swe@hotmail.com',
                ]
            ],
        ];
    }

    /**
     * @test
     * @dataProvider validationProvider
     * @param bool $shouldPass
     * @param array $mockedRequestData
     */
    public function validation_results_as_expected($shouldPass, $mockedRequestData)
    {
        $this->assertEquals(
            $shouldPass,
            $this->validate($mockedRequestData)
        );
    }

    protected function validate($mockedRequestData)
    {
        return $this->validator
            ->make($mockedRequestData, $this->rules)
            ->passes();
    }

    public function test_order_form()
    {
        $response = $this->get('/orders/create');

        $response->assertStatus(200);
    }
}
