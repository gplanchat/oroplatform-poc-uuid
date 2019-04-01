<?php

namespace AppBundle\Form\Type;

use Oro\Bundle\FormBundle\Form\Type\OroEntitySelectOrCreateInlineType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthorSelectType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'autocomplete_alias' => 'persons',
                'create_form_route'  => 'app_person_create',
                'configs'            => [
                    'placeholder' => 'app.form.choose_author'
                ],
            ]
        );
    }

    public function getParent()
    {
        return OroEntitySelectOrCreateInlineType::class;
    }
}
