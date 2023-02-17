<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitApplicationRequest extends FormRequest
{
    /**
     * The route that users should be redirected to if validation fails.
     *
     * @var string
     */
    // protected $redirectRoute = 'index';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'company_id' => 'required|integer|exists:companies,id',
            'first_name' => 'required|string|max:100|min:2',
            'last_name' => 'required|string|max:100|min:2',
            'social_security' => 'nullable|integer|digits_between:4,30',
            'present_address' => 'required|string|max:255|min:10',
            'present_state' => 'required|string|max:100|min:3',
            'present_city' => 'required|string|max:100|min:3',
            'present_zip' => 'required|integer|digits_between:4,20',
            'present_phone' => 'required|integer|digits_between:4,20',
            'email' => 'required|email|max:255|unique:users,email',
            'referred_by' => 'nullable|string|max:255',
            'position' => 'required|string|max:255',
            'start_date' => 'required|date|after_or_equal:'.date('Y-m-d'),
            'employed' => 'required|boolean',
            'applied' => 'required|boolean',
            'where_apply' => 'nullable|string|max:255',
            'when_apply' => 'nullable|string|max:255',
            'high_school' => 'nullable|string|max:255',
            'high_school_graduate' => 'nullable|boolean',
            'high_school_subjects_studied' => 'nullable|string|max:255',
            'college' => 'nullable|string|max:255',
            'college_graduate' => 'nullable|boolean',
            'college_subjects_studied' => 'nullable|string|max:255',
            'trade_school' => 'nullable|string|max:255',
            'trade_school_graduate' => 'nullable|boolean',
            'trade_school_subjects_studied' => 'nullable|string|max:255',
            'special_study' => 'nullable|string|max:255',
            'special_training' => 'nullable|string|max:255',
            'special_skills' => 'nullable|string|max:255',
            'military' => 'nullable|string|max:255',
            'rank' => 'nullable|string|max:255',
            'year_1' => 'nullable|alpha_num|max:4|min:4',
            'month_1' => 'nullable|alpha_num|max:2|min:2',
            'name_1' => 'nullable|string|max:120',
            'phone_1' => 'nullable|integer|digits_between:4,20',
            'position_1' => 'nullable|string|max:255',
            'reason_1' => 'nullable|string|max:255',
            'year_2' => 'nullable|alpha_num|max:4|min:4',
            'month_2' => 'nullable|alpha_num|max:2|min:2',
            'name_2' => 'nullable|string|max:120',
            'phone_2' => 'nullable|integer|digits_between:4,20',
            'position_2' => 'nullable|string|max:255',
            'reason_2' => 'nullable|string|max:255',
            'year_3' => 'nullable|alpha_num|max:4|min:4',
            'month_3' => 'nullable|alpha_num|max:2|min:2',
            'name_3' => 'nullable|string|max:120',
            'phone_3' => 'nullable|integer|digits_between:4,20',
            'position_3' => 'nullable|string|max:255',
            'reason_3' => 'nullable|string|max:255',
            'year_4' => 'nullable|alpha_num|max:4|min:4',
            'month_4' => 'nullable|alpha_num|max:2|min:2',
            'name_4' => 'nullable|string|max:120',
            'phone_4' => 'nullable|integer|digits_between:4,20',
            'position_4' => 'nullable|string|max:255',
            'reason_4' => 'nullable|string|max:255',
        ];
    }
}
