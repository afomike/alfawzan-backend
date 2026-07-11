<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    private const KEYS = [
        'school_name', 'tagline', 'address', 'phone', 'phone2', 'phone3',
        'email', 'website', 'logo_url', 'favicon_url',
        'seo_title', 'seo_description', 'seo_keywords',
        'receipt_footer', 'registration_fee_note',
        'facebook_url', 'instagram_url', 'twitter_url',
        'signature_path', 'signature_url',
    ];

    public function index()
    {
        $settings = Setting::getMany(self::KEYS);
        return response()->json(['data' => $settings]);
    }

    public function update(Request $request)
    {
        $data = $request->only(self::KEYS);
        Setting::setMany(array_filter($data, fn($v) => $v !== null));
        return response()->json(['message' => 'Settings saved.', 'data' => Setting::getMany(self::KEYS)]);
    }

    public function uploadLogo(Request $request)
    {
        $request->validate(['logo' => 'required|image|max:2048']);
        $old = Setting::get('logo_path');
        if ($old) Storage::disk('public')->delete($old);

        $path = $request->file('logo')->store('settings', 'public');
        Setting::set('logo_path', $path);
        $url = Storage::disk('public')->url($path);
        Setting::set('logo_url', $url);

        return response()->json(['message' => 'Logo uploaded.', 'logo_url' => $url]);
    }

    public function uploadSignature(Request $request)
    {
        $request->validate(['signature' => 'required|image|max:2048']);
        $old = Setting::get('signature_path');
        if ($old) Storage::disk('public')->delete($old);

        $path = $request->file('signature')->store('settings', 'public');
        Setting::set('signature_path', $path);
        $url = Storage::disk('public')->url($path);
        Setting::set('signature_url', $url);

        return response()->json(['message' => 'Signature uploaded.', 'signature_url' => $url]);
    }
}
