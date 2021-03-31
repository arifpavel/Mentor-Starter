<?php

declare(strict_types=1);

namespace Inc;

/**
 * Core.
 * Core plugin class that registers all the services.
 * @author   Arif Pavel
 * @since   v0.0.1
 * @version   v1.0.0  Wednesday, Mar 31th, 2021.
 * @global
 */
class Core
{
    /**
     * services.
     * returns an array of base services.
     * @author   Arif Pavel
     * @since   v0.0.1
     * @version   v1.0.0  Wednesday, Mar 31th, 2021.
     * @access   private
     * @return   array
     */
    private static function services(): array
    {
        return [
            Base\LocalizationSetup::class,
            Base\InitElementorWidgets::class
        ];
    }

    /**
     * registerServices.
     * registers base services
     * @author   Arif Pavel
     * @since   v0.0.1
     * @version   v1.0.0  Wednesday, Mar 31th, 2021.
     * @access   public static
     * @return   void
     */
    public static function registerServices()
    {
        foreach (self::services() as $service) {
            new $service();
        }
    }
}
