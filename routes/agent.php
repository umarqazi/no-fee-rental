<?php

Route::get('/home', 'Agent\HomeController@index')->name('agent.index');
Route::get('/logout', 'Agent\LoginController@logout')->name('agent.logout');

Route::get('/show-profile', 'Agent\AgentController@profile')->name('agent.profile');
Route::post('/update-profile', 'Agent\AgentController@profileUpdate')->name('agent.profileUpdate');

Route::post('/password-update', 'Agent\AgentController@updatePassword')->name('agent.updatePassword');
Route::get('/password-reset', 'Agent\AgentController@resetPassword')->name('agent.resetPassword');
