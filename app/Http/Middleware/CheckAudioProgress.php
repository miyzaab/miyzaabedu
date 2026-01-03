<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Audio;
use App\Models\UserProgress;

class CheckAudioProgress
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Get audio slug or model from route
        // Assuming route is /audio/{audio:slug} or similar, but let's check web.php first
        $audio = $request->route('audio');

        if (!$audio instanceof Audio) {
            // If it's just a slug, or ID, fetch it?
            // Depends on route binding. Let's assume route model binding for now or update it.
            return $next($request);
        }

        if ($audio->sequence_order > 1) {
            $previousAudio = Audio::where('category_id', $audio->category_id)
                ->where('sequence_order', $audio->sequence_order - 1)
                ->first();

            if ($previousAudio) {
                $isCompleted = UserProgress::where('user_id', auth()->id())
                    ->where('content_type', Audio::class)
                    ->where('content_id', $previousAudio->id)
                    ->where('status', 'completed')
                    ->exists();

                if (!$isCompleted) {
                    return redirect()->route('audio.index')->with('error', 'Sesi ini terkunci. Silakan selesaikan sesi sebelumnya.');
                }
            }
        }

        return $next($request);
    }
}
