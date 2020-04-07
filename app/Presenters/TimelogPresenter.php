<?php

namespace App\Presenters;

use App\Transformers\TimelogTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TimelogPresenter.
 *
 * @package namespace App\Presenters;
 */
class TimelogPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TimelogTransformer();
    }
}
