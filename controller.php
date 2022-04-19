 ...
 public function scud_upd_event($key) {
        if(md5(self::$key) === $key){
            Cache::forget('update_event_cache');
            Cache::put('update_event_cache', 'true', 3500);
        }
    }
    
public function sse() {
    return response()->stream(function () {
                $i = 0;
                while (true) {
                    $i++;
                    if (Cache::has('update_event_cache')) {
                        Cache::forget('update_event_cache');
                        echo "data: " . 'update' . "\n\n";
                        ob_flush();
                        flush();  
                    }
                    if($i > 20000){
                        $i = 0;
                        echo "data: " . 'reload' . "\n\n";
                        ob_flush();
                        flush(); 
                    }
                    usleep(1000);
                }
           }, 200, [
                'Cache-Control' => 'no-cache',
                'Content-Type' => 'text/event-stream',
    ]);
}
...
