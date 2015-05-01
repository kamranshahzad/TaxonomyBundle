<?php

use Kamran\TaxonomyBundle\Component\Dashboard;
use Kamran\DashboardBundle\Component\BuilderInterface;

class DashboardIntegrator
{
    public function build(BuilderInterface $builder)
    {
        $builder->addCategory('My Personal Blog')->end();
    }
}