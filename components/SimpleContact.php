<?php namespace Zainab\SimpleContact\Components;

use Cms\Classes\ComponentBase;
use Doctrine\Tests\Common\Cache\RedisCacheTest;
use Zainab\SimpleContact\Models\Settings;
use Zainab\SimpleContact\Models\SimpleContact as simpleContactModel;
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
     * Injecting Assets
     */
    public function onRun()
    {
        if(Settings::get('recaptcha_enabled', false))
            $this->addJs('https://www.google.com/recaptcha/api.js');
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

        }elseif (Settings::get('recaptcha_enabled', false)){

            /**
             * Validating reCaptcha
             */
            $response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".Settings::get('secret_key')."&response=".post('g-recaptcha-response')."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
            if($response['success'] == false)
            {
                Flash::error(e(trans('zainab.simplecontact::validation.custom.reCAPTCHA.required')));
            }
            else
            {
                $this->submitForm(post());
            }

        }
        else{
            $this->submitForm(post());
        }




        return ['#simple_contact_flash_message' => $this->renderPartial('@flashMessage.htm')];

    }

    protected function submitForm(){

        $model = new simpleContactModel;

        $model->name = post('name');
        $model->email = post('email');
        $model->phone = post('phone');
        $model->subject = post('subject');
        $model->message = post('message');

        $model->save();

        if(Settings::get('recieve_notification',false) && !empty(Settings::get('notification_email_address','')))
            $this->sendNotificationMail();

        if(Settings::get('auto_reply',false))
            $this->sendAutoReply();
        
        if(Settings::get('redirect_to_page',false) && !empty(Settings::get('redirect_to_url','')))
            return Redirect::to(Settings::get('redirect_to_url'));
        else
            Flash::success(Settings::get('success_message','Thankyou for contacting us'));
            

    }

    /**
     * Send notification email
     */
    protected function sendNotificationMail(){
        $vars = [
            'name' => post('name'),
            'email' => post('email'),
            'phone' => post('phone'),
            'subject' => post('subject'),
            'message_body' => post('message')
        ];

        Mail::sendTo(Settings::get('notification_email_address'), 'zainab.simplecontact::mail.notification', $vars);
    }

    /**
     * send auto reply
     */
    protected function sendAutoReply(){

        $vars = [
            'name' => post('name'),
            'email' => post('email'),
            'phone' => post('phone'),
            'subject' => post('subject'),
            'message_body' => post('message')
        ];

        Mail::send('zainab.simplecontact::mail.auto-response', $vars, function($message) {

            $message->to(post('email'), post('name'));

        });

    }
}