<?php

namespace App\Support;

use Illuminate\Http\Request;

class Recaptcha
{
    private const PRODUCTION_SITE_KEY = '6LfPm9orAAAAAITRksBgnr-QOyftwOnldiTKb7BS';
    private const LOCAL_TEST_SITE_KEY = '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI';
    private const LOCAL_TEST_SECRET_KEY = '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe';

    public static function enabledForRequest(?Request $request = null): bool
    {
        if (self::usesLocalTestKeys($request)) {
            return false;
        }

        return (bool) config('services.recaptcha.enabled');
    }

    public static function siteKeyForRequest(?Request $request = null): ?string
    {
        if (! self::enabledForRequest($request)) {
            return null;
        }

        if (self::usesLocalTestKeys($request)) {
            return self::LOCAL_TEST_SITE_KEY;
        }

        return self::PRODUCTION_SITE_KEY;
    }

    public static function secretKeyForRequest(?Request $request = null): ?string
    {
        if (! self::enabledForRequest($request)) {
            return null;
        }

        if (self::usesLocalTestKeys($request)) {
            return self::LOCAL_TEST_SECRET_KEY;
        }

        return config('services.recaptcha.secret_key');
    }

    private static function usesLocalTestKeys(?Request $request = null): bool
    {
        $host = $request?->getHost();

        return in_array($host, ['localhost', '127.0.0.1', 'staging.sortiqsolutions.com'], true)
            || ($host && str_starts_with($host, 'staging.'));
    }
}
