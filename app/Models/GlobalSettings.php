<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalSettings extends Model
{
    protected $settings;
    protected $keys = [];

    /**
     * @param $settings
     */
    public function __construct($settings)
    {
        $this->settings = $settings;
        foreach ($settings as $setting) {
            $this->keys[$setting->option_name] = $setting->option_value;
        }
    }

    public function get(string $key): string | null {
        return $this->settings->where('option_name', $key)->first()->option_value;
    }


}
