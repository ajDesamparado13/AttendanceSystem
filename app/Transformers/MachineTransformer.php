<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Machine;

/**
 * Class MachineTransformer.
 *
 * @package namespace App\Transformers;
 */
class MachineTransformer extends TransformerAbstract
{
    /**
     * Transform the Machine entity.
     *
     * @param \App\Entities\Machine $model
     *
     * @return array
     */
    public function transform(Machine $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
