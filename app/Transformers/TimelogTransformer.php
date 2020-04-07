<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Timelog;

/**
 * Class TimelogTransformer.
 *
 * @package namespace App\Transformers;
 */
class TimelogTransformer extends TransformerAbstract
{
    /**
     * Transform the Timelog entity.
     *
     * @param \App\Entities\Timelog $model
     *
     * @return array
     */
    public function transform(Timelog $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
