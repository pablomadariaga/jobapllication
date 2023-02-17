<div
    style='background-image: url(https://thepineappletequila.com/img/menu-background.jpg);
background-size: cover;
background-position: 25%;
font-family: Roboto, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";'>
    <div style="background-color: #00000080; padding-top:2rem; padding-bottom:2rem;">
        <div style="min-height: 100vh; width: 100%; color: #d4d4d4; position: relative;">
            <div
                style="background-color: #171717cc;border-radius: 0.25rem;padding: 1.25rem; width: 90%; margin-left:2.5%;">
                <table style="margin-bottom: 1rem;font-weight: 600;width: 100%;" class="mb-4 font-semibold w-full">
                    <tr>
                        <td colspan="2" style="font-size: 1.65rem;line-height: 2rem;color: #fafafa;">
                            {{$user->company->name}}
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 1.5rem;line-height: 2rem;color: #fafafa;">
                            {{__('Application for employment')}}</td>
                        <td style="text-align: right;color: #fafafa;">
                            {{substr($user->created_at,0,10)}}</td>
                    </tr>
                </table>
                <hr style="border-color: {{$user->company->color}};margin-bottom: 1.2rem;">
                <table style="color: #fafafa;width: 100%;">
                    <tr>
                        <td colspan="2" style="font-weight: 600;">{{__('Personal information') }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-bottom: 1px solid {{$user->company->color}};padding-bottom: 1rem;"></td>
                    </tr>
                    <tr>
                        <td style="padding-top: 1rem;">{{__('First name')}}:</td>
                        <td style="padding-top: 1rem;">{{$user->first_name}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Last name')}}:</td>
                        <td>{{$user->last_name}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Social security No')}}:</td>
                        <td>{{$user->social_security}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Present address')}}:</td>
                        <td>{{$user->present_address}}
                            {{$user->present_state}},
                            {{$user->present_city}}. /
                            {{__('ZIP Code')}}: {{$user->present_zip}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Phone')}}:</td>
                        <td>{{$user->present_phone}}</td>
                    </tr>
                    {{-- <tr>
                        <td>{{__('Permanent address')}}:</td>
                        <td>{{$user->permanent_address}}
                            {{$user->permanentStateRelation->name}},
                            {{$user->permanentCityRelation->name}}. /
                            {{__('ZIP Code')}}: {{$user->permanent_zip}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Phone')}}:</td>
                        <td>{{$user->permanent_phone}}</td>
                    </tr> --}}
                    <tr>
                        <td>{{__('Email address')}}:</td>
                        <td>{{$user->email}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Referred by')}}:</td>
                        <td>{{$user->referred_by}}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-bottom: 1px solid {{$user->company->color}};padding-bottom: 1rem;"></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-weight: 600;padding-top: 1rem;">{{__('Employment desired') }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-bottom: 1px solid {{$user->company->color}};padding-bottom: 1rem;"></td>
                    </tr>
                    <tr>
                        <td style="padding-top: 1rem;">{{__('Position')}}:</td>
                        <td style="padding-top: 1rem;">{{$user->position}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Date you can start')}}:</td>
                        <td>{{ substr($user->start_date,0,10)}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Are you employed now?')}}:</td>
                        <td>{{$user->employed ? __('Yes') : __('No')}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Ever applied to this company before?')}}:</td>
                        <td>{{$user->applied ? __('Yes') : __('No')}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Where?')}}:</td>
                        <td>{{$user->where_apply}}</td>
                    </tr>
                    <tr>
                        <td>{{__('When?')}}:</td>
                        <td>{{$user->when_apply}}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-bottom: 1px solid {{$user->company->color}};padding-bottom: 1rem;"></td>
                    </tr>
                    {{-- <tr>
                        <td colspan="2" style="font-weight: 600;padding-top: 1rem;">{{__('Education') }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-bottom: 1px solid {{$user->company->color}};padding-bottom: 1rem;"></td>
                    </tr>
                    <tr>
                        <td style="padding-top: 1rem;">{{__('High school')}}:</td>
                        <td>{{$user->high_school}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Did you graduate?')}}:</td>
                        <td>{{$user->high_school_graduate ? __('Yes') : __('No')}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Subjects studied')}}:</td>
                        <td>{{$user->high_school_subjects_studied}}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-bottom: 1px solid {{$user->company->color}};padding-bottom: 1rem;"></td>
                    </tr>
                    <tr>
                        <td style="padding-top: 1rem;">{{__('College')}}:</td>
                        <td style="padding-top: 1rem;">{{$user->college}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Did you graduate?')}}:</td>
                        <td>{{$user->college_graduate ? __('Yes') : __('No')}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Subjects studied')}}:</td>
                        <td>{{$user->college_subjects_studied}}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-bottom: 1px solid {{$user->company->color}};padding-bottom: 1rem;"></td>
                    </tr>
                    <tr>
                        <td style="padding-top: 1rem;">{{__('Trade, business, or correspondence school')}}:</td>
                        <td style="padding-top: 1rem;">{{$user->trade_school}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Did you graduate?')}}:</td>
                        <td>{{$user->trade_school_graduate ? __('Yes') : __('No')}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Subjects studied')}}:</td>
                        <td>{{$user->trade_school_subjects_studied}}</td>
                    </tr> --}}
                    <tr>
                        <td colspan="2" style="border-bottom: 1px solid {{$user->company->color}};padding-bottom: 1rem;"></td>
                    </tr>
                    {{-- <tr>
                        <td colspan="2" style="font-weight: 600;padding-top: 1rem;">{{__('General information') }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-bottom: 1px solid {{$user->company->color}};padding-bottom: 1rem;"></td>
                    </tr>
                    <tr>
                        <td style="padding-top: 1rem;">{{__('Subjects of special study or research work')}}:</td>
                        <td style="padding-top: 1rem;">{{$user->special_study}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Special training')}}:</td>
                        <td>{{$user->special_training}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Special skills')}}:</td>
                        <td>{{$user->special_skills}}</td>
                    </tr>
                    <tr>
                        <td>{{__('U.S Military service')}}:</td>
                        <td>{{$user->military}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Rank')}}:</td>
                        <td>{{$user->rank}}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-bottom: 1px solid {{$user->company->color}};padding-bottom: 1rem;"></td>
                    </tr> --}}
                    <tr>
                        <td colspan="2" style="font-weight: 600;padding-top: 1rem;">{{__('Former employers') }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-bottom: 1px solid {{$user->company->color}};padding-bottom: 1rem;"></td>
                    </tr>
                    <tr>
                        <td style="padding-top: 1rem;">{{__('From')}}:</td>
                        <td style="padding-top: 1rem;">{{$user->year_1}}
                            {{$user->month_1}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Name')}}:</td>
                        <td>{{$user->name_1}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Phone')}}:</td>
                        <td>{{$user->phone_1}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Position')}}:</td>
                        <td>{{$user->position_1}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Reason for leaving')}}:</td>
                        <td>{{$user->reason_1}}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-bottom: 1px solid {{$user->company->color}};padding-bottom: 1rem;"></td>
                    </tr>
                    <tr>
                        <td style="padding-top: 1rem;">{{__('From')}}:</td>
                        <td style="padding-top: 1rem;">{{$user->year_2}}
                            {{$user->month_2}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Name')}}:</td>
                        <td>{{$user->name_2}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Phone')}}:</td>
                        <td>{{$user->phone_2}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Position')}}:</td>
                        <td>{{$user->position_2}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Reason for leaving')}}:</td>
                        <td>{{$user->reason_2}}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-bottom: 1px solid {{$user->company->color}};padding-bottom: 1rem;"></td>
                    </tr>
                    <tr>
                        <td style="padding-top: 1rem;">{{__('From')}}:</td>
                        <td style="padding-top: 1rem;">{{$user->year_3}}
                            {{$user->month_3}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Name')}}:</td>
                        <td>{{$user->name_3}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Phone')}}:</td>
                        <td>{{$user->phone_3}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Position')}}:</td>
                        <td>{{$user->position_3}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Reason for leaving')}}:</td>
                        <td>{{$user->reason_3}}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-bottom: 1px solid {{$user->company->color}};padding-bottom: 1rem;"></td>
                    </tr>
                    <tr>
                        <td style="padding-top: 1rem;">{{__('From')}}:</td>
                        <td style="padding-top: 1rem;">{{$user->year_4}}
                            {{$user->month_4}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Name')}}:</td>
                        <td>{{$user->name_4}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Phone')}}:</td>
                        <td>{{$user->phone_4}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Position')}}:</td>
                        <td>{{$user->position_4}}</td>
                    </tr>
                    <tr>
                        <td>{{__('Reason for leaving')}}:</td>
                        <td>{{$user->reason_4}}</td>
                    </tr>
                </table>
                <hr style="border-color: {{$user->company->color}};margin-bottom: 1.5rem;">
            </div>
        </div>
    </div>
</div>
