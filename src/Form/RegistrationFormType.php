<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('firstName',TextType::class, array(
                'label' => 'First Name : ',
                'attr' => array(
                    'placeholder' => 'Your first name ...'
                )
            ))
            ->add('lastName' ,TextType::class, array(
                'label' => 'Last Name : ',
                'attr' => array(
                    'placeholder' => 'Your last name ...'
                )
            ))
            ->add('country', CountryType::class)
            ->add('state',TextType::class, array(
                'label' => 'State : ',
                'attr' => array(
                    'placeholder' => 'The state or addresse you currently live in ...'
                )
            ))
            ->add('email', EmailType::class, array(
                'label' => 'Email: ',
                'attr' => array(
                    'placeholder' => 'Your personal email ...'
                )
            ))


           -> add('password', RepeatedType::class, [
                'type' => PasswordType::class,
               'mapped' => false,
               'attr' => ['autocomplete' => 'new-password'],
               'constraints' => [
                   new NotBlank([
                       'message' => 'Please enter a password',
                   ]),
                   new Length([
                       'min' => 6,
                       'minMessage' => 'Your password should be at least {{ limit }} characters',
                       // max length allowed by Symfony for security reasons
                       'max' => 4096,
                   ])],
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  =>  array(
                    'label' => 'Password: ',
                    'attr' => array(
                        'placeholder' => 'Please enter a password that contains more than 6 characters...'
                    )
                ),
                'second_options' =>  array(
                    'label' => 'Repeated password: ',
                    'attr' => array(
                        'placeholder' => 'Please retype you password ...'
                    )
                )
            ])


           /*
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
*/

        /*    ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])*/
            ->add('Submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
