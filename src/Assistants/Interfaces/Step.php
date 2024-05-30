<?php

namespace GetFtpFiles\Assistants\Interfaces;

/**
 * Interface Step
 * @package GetFtpFiles\Assistants\Steps
 */
interface Step
{
    /**
     * Generates the step
     *
     * @return array
     */
    public function get(): array;

    /**
     * Generates all the step sections
     *
     * @return array
     */
    public function generateSections(): array;
}
