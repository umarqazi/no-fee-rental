<?php

Route::get('/home', 'Agent\HomeController@index')->name('agent.index');
Route::get('/logout', 'Agent\LoginController@logout')->name('agent.logout');
