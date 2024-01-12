<?php

namespace App\DTO;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Auth;

class BuilderRequestDTO
{
    public $name;
    public $group_logo;
    public $address;
    public $website;
    public $contact_no;
    public $mail;
    public $linked_in;
    public $facebook;
    public $twitter;
    public $youtube;
    public $sub_group_name;
    public $sub_group;
    public $created_by;

    /**
     * Create a new notificationDTO instance.
     *
     * @param \Illuminate\Http\Request $request
     * @throws HttpResponseException
     */
    public function __construct(Request $request)
    {
        //dd($request->all());
        $validator = $this->validate($request);
        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'message' => 'Validation error',
                'errors' => $validator->getMessageBag()->toArray(),
            ], 422));
        }

        // {"success":false,"errors":{"gis_id":["The gis id field is required."]}}
        $this->name             = $request->input('name');
        $this->group_logo       = $request->input('group_logo');
        $this->address          = $request->input('address');
        $this->website          = $request->input('website');
        $this->contact_no       = $request->input('contact_no');
        $this->mail             = $request->input('mail');
        $this->linked_in        = $request->input('linked_in');
        $this->facebook         = $request->input('facebook');
        $this->twitter          = $request->input('twitter');
        $this->youtube          = $request->input('youtube');
        $this->sub_group_name   = $request->input('sub_group_name');
        $this->sub_group        = $request->input('sub_group');
        $this->created_by       = Auth::user()->id;
        
    }

    /**
     * Validate the given request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     * @throws ValidationException
     */
    private function validate(Request $request): Validator
    {
        $rules = [
            // 'required|unique:gis_id_mappings',
            'name'      => 'required',
            // 'group_logo'        => 'required',
            // 'address'           => 'required',
            // 'website'           => 'required',
            // 'contact_no'        => 'required',
            // 'mail'              => 'required',
            // 'linked_in'         => 'required',
            // 'facebook'          => 'required',
            // 'twitter'           => 'required',
            // 'youtube'           => 'required',
        ];
       // dd($request->all());
        return validator($request->all(), $rules);
    }

    /**
     * Convert the DTO to an array representation.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name'           => $this->name, 
            'group_logo'     => $this->group_logo,   
            'address'        => $this->address,      
            'website'        => $this->website,      
            'contact_no'     => $this->contact_no,   
            'mail'           => $this->mail,         
            'linked_in'      => $this->linked_in,    
            'facebook'       => $this->facebook,     
            'twitter'        => $this->twitter,      
            'youtube'        => $this->youtube,   
            'created_by'     => $this->created_by,   
        ];
    }
}
