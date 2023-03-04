<?php

namespace App\Models\Traits;

use Exception;

trait GeneratesCode
{
    /**
     * Method: generateCode.
     *
     * @return self
     */
    public function generateCode(int $attempt = 1): self
    {
        if ($attempt > 10) {
            throw new Exception('Could not generate a unique code.');
        }

        $this->code = generateCode();

        if (self::where('code', $this->code)->exists()) {
            return $this->generateCode($attempt + 1);
        }

        return $this;
    }
}
