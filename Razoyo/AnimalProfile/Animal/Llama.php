<?php

/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Razoyo\AnimalProfile\Animal;

class Llama implements \Razoyo\AnimalProfile\Animal\AnimalInterface
{
    public function getContent()
    {
        return 'data:image/jpeg;base64,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';
    }
}
