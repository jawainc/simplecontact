<?php namespace Zainab\SimpleContact\Components;

use Cms\Classes\ComponentBase;
use Zainab\SimpleContact\Models\Settings;
use October\Rain\Support\Facades\Flash;
use Validator;
use ValidationException;
class SimpleContact extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'zainab.simplecontact::lang.plugin.name',
            'description' => 'zainab.simplecontact::lang.component.description',
            
        ];
    }

    public function defineProperties()
    {
        return [
            'nameTitle' => [
                'title' => 'zainab.simplecontact::lang.component.name_title',
                'description' => 'zainab.simplecontact::lang.component.name_description',
                'default' => 'Full Name',
                'type' => 'string',
                'required' => true,
                'validationMessage' => 'Title label required'
            ],
            'emailTitle' => [
                'title' => 'zainab.simplecontact::lang.component.email_title',
                'description' => 'zainab.simplecontact::lang.component.email_description',
                'default' => 'Email',
                'type' => 'string',
                'required' => true,
                'validationMessage' => 'Email label required'
            ],
            'phoneTitle' => [
                'title' => 'zainab.simplecontact::lang.component.phone_title',
                'description' => 'zainab.simplecontact::lang.component.phone_description',
                'default' => 'Phone',
                'type' => 'string'

            ],
            'subjectTitle' => [
                'title' => 'zainab.simplecontact::lang.component.subject_title',
                'description' => 'zainab.simplecontact::lang.component.subject_description',
                'default' => 'Subject',
                'type' => 'string',
                'required' => true,
                'validationMessage' => 'Subject label required'

            ],
            'messageTitle' => [
                'title' => 'zainab.simplecontact::lang.component.message_title',
                'description' => 'zainab.simplecontact::lang.component.message_description',
                'default' => 'Message',
                'type' => 'string',
                'required' => true,
                'validationMessage' => 'Message label required'

            ],
            'buttonText' => [
                'title' => 'zainab.simplecontact::lang.component.button_text',
                'description' => 'zainab.simplecontact::lang.component.button_description',
                'default' => 'Submit',
                'type' => 'string',
                'required' => true,
                'validationMessage' => 'Button text required'

            ],
            'displayPhone' => [
                'title' => 'zainab.simplecontact::lang.component.display_phone_field',
                'description' => 'zainab.simplecontact::lang.component.display_phone_field_description',
                'default' => true,
                'type' => 'checkbox',
            ],
            
        ];
    }

    public function properties(){
        return [
            'nameLabel' => $this->property('nameTitle','Full Name'),
            'emailLabel' => $this->property('emailTitle','Email'),
            'phoneLabel' => $this->property('phoneTitle','Phone No.'),
            'subjectLabel' => $this->property('subjectTitle','Subject'),
            'messageLabel' => $this->property('messageTitle','Message'),
            'phoneEnabled' => $this->property('displayPhone',false),
            'buttonText' => $this->property('buttonText','Submit'),
        ];
    }

    public function settings(){
        return [
            'recaptcha_enabled' => Settings::get('recaptcha_enabled', false),
            'recaptcha_site_key' => Settings::get('site_key', ''),
            'text_top_form' => Settings::get('text_top_form', ''),

        ];
        
    }

    /**
     * AJAX form fubmit handler
     */
    public function onFormSubmit(){

        /**
         * Form validation
         */
        $customValidationMessages = [
            'name.required' => e(trans('zainab.simplecontact::validation.custom.name.required')),
            'email.required' => e(trans('zainab.simplecontact::validation.custom.email.required')),
            'email.email' => e(trans('zainab.simplecontact::validation.custom.email.email')),
            'subject.required' => e(trans('zainab.simplecontact::validation.custom.subject.required')),
            'message.required' => e(trans('zainab.simplecontact::validation.custom.message.required'))
        ];
        $formValidationRules = [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ];

        $validator = Validator::make(post(), $formValidationRules,$customValidationMessages);

        if ($validator->fails()) {
            $messages = $validator->messages();
            Flash::error($messages->first());
        }else{

        }




        return ['#simple_contact_flash_message' => $this->renderPartial('@flashMessage.htm')];

    }

}