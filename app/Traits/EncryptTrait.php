<?php
namespace App\Traits;

trait EncryptTrait
{
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        return $this->hasEncryption($key) ? $this->decryptAttribute($value) : $value;
    }

    public function setAttribute($key, $value)
    {
        if ($this->hasEncryption($key)) {
            $value = $this->encryptAttribute($value);
        }

        return parent::setAttribute($key, $value);
    }

    protected function hasEncryption($key)
    {
        $encrypt = isset($this->encrypt) ? $this->encrypt : [];
        return in_array($key, $encrypt);
    }

    public function encryptAttribute($value)
    {
        return is_null($value) ? null : encrypt($value);
    }

    public function decryptAttribute($value)
    {
        return is_null($value) ? null : decrypt($value);
    }
}
