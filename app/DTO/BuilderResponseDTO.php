<?php

namespace App\DTO;

use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Builder;
use JsonSerializable;

class BuilderResponseDTO implements JsonSerializable
{

    public $id;
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
    public $created_by;
    
    /**
     * Create a new PandalDTO instance.
     *
     * @param \Illuminate\Http\Request $request
     * @throws HttpResponseException
     */
    public function __construct(Builder $Builder)
    {
        $this->id               = $Builder->id;
        $this->name             = $Builder->name;
        $this->group_logo       = $Builder->group_logo;
        $this->address          = $Builder->address;
        $this->website          = $Builder->website;
        $this->contact_no       = $Builder->contact_no;
        $this->mail             = $Builder->mail;
        $this->linked_in        = $Builder->linked_in;
        $this->facebook         = $Builder->facebook;
        $this->twitter          = $Builder->twitter;
        $this->youtube          = $Builder->youtube;
        $this->created_by       = $Builder->created_by;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
