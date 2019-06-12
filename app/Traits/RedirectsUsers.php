<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 6/11/19
 * Time: 3:32 PM
 */

namespace App\Traits;



trait RedirectsUsers
{
    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }
}
