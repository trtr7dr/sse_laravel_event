Route::get('/sse', 'PeopleController@sse');
Route::get('/upd/{key}', 'PeopleController@scud_upd_event');
