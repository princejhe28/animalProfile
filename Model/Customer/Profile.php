<?php

namespace Razoyo\AnimalProfile\Model\Customer;

use Magento\Customer\Model\Customer;
use Magento\Customer\Model\CustomerFactory;
use Magento\Customer\Model\AttributeFactory;

class Profile
{

    protected $customerFactory;
    protected $attributeFactory;

    public function __construct(
        CustomerFactory $customerFactory,
        AttributeFactory $attributeFactory
    ) {
        $this->customerFactory = $customerFactory;
        $this->attributeFactory = $attributeFactory;
    }
    public function getProfile($customerId)
    {
        $customer = $this->customerFactory->create()->load($customerId);
        $attributeCode = 'profile_pic';
        $attribute = $this->attributeFactory->create()->loadByCode('customer', $attributeCode);
        return $customer->getData($attribute->getAttributeCode());
    }
}
