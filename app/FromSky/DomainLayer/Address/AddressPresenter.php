<?php

namespace App\FromSky\DomainLayer\Address;

trait AddressPresenter
{
    public function display($separator): string
    {
        $display = $this->firstname . ' ' . $this->lastname;
        $display .= $separator;
        $display .= $this->street;
        if ($this->number) {
            $display .= ', ' . $this->number;
        }
        $display .= $separator;
        $display .= $this->zip_code . ' ' . $this->city . ' (' . $this->province . ')';
        $display .= $separator;
        $display .= $this->country->name;
        if ($this->phone) {
            $display .= $separator;
            $display .= 'Tel: ' . $this->phone;
        }
        if ($this->mobile) {
            $display .= $separator;
            $display .= 'Cell: ' . $this->mobile;
        }
        if ($this->email) {
            $display .= $separator;
            $display .= 'Email: ' . $this->email;
        }
        if ($this->vat) {
            $display .= $separator;
            $display .= __('store.address.fields.vat') . ':' . $this->vat;
        }

        return $display;
    }

    public function getDisplayInlineAttribute()
    {
        return $this->display(' - ');
    }

    public function getDisplayBlockAttribute()
    {
        return $this->display('<br>');
    }
}