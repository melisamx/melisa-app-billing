<?php

namespace App\Billing\Logics\Contributors;

use Melisa\Laravel\Logics\CreateLogic as BaseCreateLogic;
use App\Billing\Repositories\ContributorsRepository;

/**
 * Create contributor
 *
 * @author Luis Josafat Heredia Contreras
 */
class CreateLogic extends BaseCreateLogic
{
    protected $disableFireEvent = true;

    public function __construct(
        ContributorsRepository $repository
    )
    {
        $this->repository = $repository;
    }
    
}
