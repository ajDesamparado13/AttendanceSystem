<?php

namespace App\Traits\Obfuscate;

use Jenssegers\Optimus\Optimus;

trait Optimuss
{

    public function optimus()
    {
        return new Optimus(1580030173, 59260789, 1163945558);

    }
    public function getOptimusIdAttribute()
    {
        if ($this->id) {
            return $this->optimus()->encode($this->id);
        }
    }

    public function getValueAttribute()
    {
        return $this->optimus()->decode($this->id);
    }

    public function removeStringDecode($val)
    {
        $res = preg_replace("/[^0-9]/", "", $val);
        return $this->optimus()->decode((int) $res);
    }

    //Id obfuscation should be resolveManually
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('id', $this->optimus()->decode($value))->first() ?? abort(404);
    }

}