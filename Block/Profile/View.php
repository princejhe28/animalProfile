<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Razoyo\AnimalProfile\Block\Profile;

class View extends \Magento\Framework\View\Element\Template
{
    /**
     * @var ScustomerSession
     */
    private $customerSession;

    /**
     * @var Profile
     */
    private $profile;

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Razoyo\AnimalProfile\Model\Customer\Profile $profile,
        array $data = []
    ) {
        $this->customerSession = $customerSession;
        $this->profile = $profile;
        parent::__construct($context, $data);
    }

    public function getGreeting()
    {
        return 'Hello ' . $this->customerSession->getCustomer()->getFirstname() . '!';
    }

    public function getCustomerId()
    {
        return $this->customerSession->getCustomer()->getId();
    }

    public function getPhotoUrl()
    {
        return $this->getUrl('animalid/profile/photo');
    }

    public function getProfileOptions(): array
    {
        return [
            'cat','dog', 'llama', 'anteaters'
        ];
    }

    public function getFormAction()
    {
        $result = $this->getUrl('animalid/profile/save', ['_secure' => true]);

        return rtrim($result, '/');
    }

    public function getCurrentProfile() {
        if (!$this->profile->getProfile($this->getCustomerId())) {
            //return cat as default
            return 'cat';
        }
        return $this->profile->getProfile($this->getCustomerId());
    }
}

