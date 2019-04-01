<?php

namespace AppBundle\Form\Type;

use Oro\Bundle\FormBundle\Form\Type\OroEntitySelectOrCreateInlineType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketSelectType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'autocomplete_alias' => 'leads',
                'create_form_route'  => 'oro_sales_lead_create',
                'configs'            => [
                    'placeholder' => 'oro.sales.form.choose_lead'
                ],
            ]
        );
    }

    public function getParent()
    {
        return OroEntitySelectOrCreateInlineType::class;
    }
}
