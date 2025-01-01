<?php

namespace Domain\Server\Support\Enums\Concerns;

use Domain\Server\Support\Enums\Attributes\ServerAttributes;

trait WithServerAttributes
{
    public function ip(): ?string
    {
        return $this->serverAttribute()?->ip;
    }

    public function port(): ?int
    {
        return $this->serverAttribute()?->port;
    }

    private function serverAttribute(): ?ServerAttributes
    {
        return once(function () {
            try {
                $reflection = new \ReflectionEnum($this);
                $attributes = $reflection->getCase($this->name)->getAttributes(ServerAttributes::class);
            } catch (\ReflectionException) {
                return null;
            }

            return ($attributes[0] ?? null)?->newInstance();
        });
    }
}
