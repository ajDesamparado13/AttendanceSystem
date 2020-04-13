<?php

namespace App\Presenters;

use App\Transformers\MachineTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class MachinePresenter.
 *
 * @package namespace App\Presenters;
 */
class MachinePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MachineTransformer();
    }
}
