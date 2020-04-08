<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class ProjectInvitationsRequest extends FormRequest
{
    /**
     * The key to be used for the view error bag.
     *
     * @var string
     */
    protected $errorBag = 'invitations';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('manage', $this->route('project'));
    }

    /*$this->authorize('update', $project);

        request()->validate([
            'email' => ['required', 'exists:users,email']
        ], [
            'email.exists' => 'The user you are inviting must have a birdshit account.'
        ]);*/

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'exists:users,email']
        ];
    }

    public function messages()
    {
        return [
            'email.exists' => 'The user you are attempting to invite must have a birdshit account.'
        ];
    }
}
