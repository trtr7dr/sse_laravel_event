 ...
 public function scud_upd_event($key) {
        if(md5(self::$key) === $key){
            Cache::forget('update_event_cache');
            Cache::put('update_event_cache', 'true', 3500);
        }
    }
    
public function sse() {
    return response()->stream(function () {
                while (true) {
                    usleep(1000);
                    if (Cache::has('update_event_cache')) {
                        Cache::forget('update_event_cache');
                        echo "data: " . 'update' . "\n\n";
                        ob_flush();
                        flush();  
                   }
                }
           }, 200, [
                'Cache-Control' => 'no-cache',
                'Content-Type' => 'text/event-stream',
    ]);
}
...
