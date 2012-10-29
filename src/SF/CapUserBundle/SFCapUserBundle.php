<?php

namespace SF\CapUserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SFCapUserBundle extends Bundle
{

	public function getParent()
    {
        return 'FOSUserBundle';
    }
}
