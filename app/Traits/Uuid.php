<?php

    namespace App\Traits;

    use Ramsey\Uuid\Uuid as PackageUuid;

    trait Uuid
    {
        /**
         * @return string
         */
        public function getUuidName()
        {
            return property_exists($this, 'uuidName') ? $this->uuidName : 'uuid';
        }

        public function getUuid()
        {
            return PackageUuid::uuid4()->toString();
        }

        protected static function boot()
        {
            parent::boot();

            static::creating(function ($model) {
                $model->{$model->getUuidName()} = PackageUuid::uuid4()->toString();
            });
        }

    }
