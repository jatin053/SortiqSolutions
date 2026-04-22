<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ContactMessageRequest;
use App\Mail\ContactMessageNotification;
use App\Models\ContactMessage;
use App\Models\SiteLayoutSetting;
use App\Support\Recaptcha;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Throwable;

class ContactMessageController extends Controller
{
    public function store(ContactMessageRequest $request): JsonResponse
    {
        $data = $request->validated();

        $this->checkRecaptcha($data['recaptcha'] ?? null, $request->ip());

        $contactMessage = ContactMessage::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'country_code' => $data['country_code'] ?? null,
            'phone' => $data['phone'] ?? null,
            'subject' => $data['subject'],
            'message' => $data['message'],
            'ip_address' => $request->ip(),
            'user_agent' => (string) $request->userAgent(),
        ]);

        $this->sendNotificationEmail($contactMessage);

        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully.',
        ]);
    }

    private function checkRecaptcha(?string $token, ?string $ip): void
    {
        if (!Recaptcha::enabledForRequest(request())) {
            return;
        }

        if (empty($token)) {
            throw ValidationException::withMessages([
                'recaptcha' => 'Please complete the reCAPTCHA check.',
            ]);
        }

        $secretKey = Recaptcha::secretKeyForRequest(request());

        if (empty($secretKey)) {
            throw ValidationException::withMessages([
                'recaptcha' => 'reCAPTCHA is not configured correctly.',
            ]);
        }

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $secretKey,
            'response' => $token,
            'remoteip' => $ip,
        ]);

        if (!$response->ok()) {
            throw ValidationException::withMessages([
                'recaptcha' => 'reCAPTCHA verification failed.',
            ]);
        }

        $responseData = $response->json();

        if (empty($responseData['success'])) {
            throw ValidationException::withMessages([
                'recaptcha' => 'reCAPTCHA verification failed.',
            ]);
        }
    }

    private function sendNotificationEmail(ContactMessage $contactMessage): void
    {
        $notificationEmail = $this->getNotificationEmail();

        if (!$notificationEmail) {
            Log::warning('Contact message saved without notification email configuration.', [
                'contact_message_id' => $contactMessage->id,
            ]);

            return;
        }

        try {
            Mail::to($notificationEmail)->send(new ContactMessageNotification($contactMessage));
        } catch (Throwable $e) {
            Log::warning('Contact message saved but notification email could not be sent.', [
                'contact_message_id' => $contactMessage->id,
                'notification_email' => $notificationEmail,
                'error' => $e->getMessage(),
            ]);
        }
    }

    private function getNotificationEmail(): ?string
    {
        $siteLayoutData = SiteLayoutSetting::main()->data ?? [];

        $emails = [
            config('services.contact.notification_email'),
            data_get($siteLayoutData, 'header.email'),
            data_get($siteLayoutData, 'footer.email'),
        ];

        $mailFromAddress = trim((string) config('mail.from.address'));

        if ($mailFromAddress !== '' && $mailFromAddress !== 'hello@example.com') {
            $emails[] = $mailFromAddress;
        }

        foreach ($emails as $email) {
            $email = trim((string) $email);

            if ($email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return $email;
            }
        }

        return null;
    }
}