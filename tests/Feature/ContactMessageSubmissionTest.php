<?php

namespace Tests\Feature;

use App\Mail\ContactMessageNotification;
use App\Models\SiteLayoutSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use RuntimeException;
use Tests\TestCase;

class ContactMessageSubmissionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('services.recaptcha.enabled', false);
    }

    public function test_it_sends_contact_notifications_to_the_configured_recipient(): void
    {
        Mail::fake();

        config()->set('services.contact.notification_email', 'alerts@example.com');
        $payload = $this->payload();

        $response = $this->postJson('/api/contact-messages', $payload);

        $response->assertOk()
            ->assertJson([
                'success' => true,
                'message' => 'Message sent successfully.',
            ]);

        $this->assertDatabaseHas('contact_messages', [
            'email' => $payload['email'],
            'subject' => 'Need help with deployment',
        ]);

        Mail::assertSent(ContactMessageNotification::class, function (ContactMessageNotification $mail): bool {
            return $mail->hasTo('alerts@example.com')
                && $mail->contactMessage->email === $this->payload()['email'];
        });
    }

    public function test_it_falls_back_to_site_settings_when_no_notification_email_is_configured(): void
    {
        Mail::fake();

        config()->set('services.contact.notification_email', null);
        $payload = $this->payload();

        $setting = SiteLayoutSetting::main();
        $setting->update([
            'data' => array_replace_recursive($setting->data ?? [], [
                'header' => [
                    'email' => 'site-owner@example.com',
                ],
            ]),
        ]);

        $response = $this->postJson('/api/contact-messages', $payload);

        $response->assertOk();

        Mail::assertSent(ContactMessageNotification::class, function (ContactMessageNotification $mail): bool {
            return $mail->hasTo('site-owner@example.com');
        });
    }

    public function test_it_returns_success_even_when_mail_delivery_fails(): void
    {
        config()->set('services.contact.notification_email', 'alerts@example.com');
        $payload = $this->payload();

        Log::spy();
        Mail::shouldReceive('to')
            ->once()
            ->with('alerts@example.com')
            ->andReturnSelf();
        Mail::shouldReceive('send')
            ->once()
            ->andThrow(new RuntimeException('SMTP unavailable'));

        $response = $this->postJson('/api/contact-messages', $payload);

        $response->assertOk()
            ->assertJson([
                'success' => true,
            ]);

        $this->assertDatabaseHas('contact_messages', [
            'email' => $payload['email'],
            'subject' => 'Need help with deployment',
        ]);

        Log::shouldHaveReceived('warning')
            ->once()
            ->withArgs(function (string $message, array $context): bool {
                return $message === 'Contact message saved but notification email could not be sent.'
                    && ($context['notification_email'] ?? null) === 'alerts@example.com'
                    && str_contains((string) ($context['error'] ?? ''), 'SMTP unavailable');
            });
    }

    private function payload(): array
    {
        return [
            'name' => 'sortiq',
            'email' => 'sortiqsolutions@gmail.com',
            'country_code' => '+1',
            'phone' => '70187412392',
            'subject' => 'Need help with deployment',
            'message' => 'Please help us verify the production deployment setup.',
        ];
    }
}
