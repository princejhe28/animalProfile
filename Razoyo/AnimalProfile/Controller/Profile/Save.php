<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Razoyo\AnimalProfile\Controller\Profile;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Save extends Action
{
    private $customerRepository;
    protected $customerFactory;

    public function __construct(
        Context $context,
        CustomerRepositoryInterface $customerRepository,
        \Magento\Customer\Model\CustomerFactory $customerFactory
    ) {
        parent::__construct($context);
        $this->customerRepository = $customerRepository;
        $this->customerFactory = $customerFactory;
    }

    public function execute()
    {
        try {
            $params = $this->getRequest()->getParams();
            $customer = $this->customerFactory->create()->load($params['customer_id']);

            $attr = $params['profile'];

            $customer->setData('profile_pic', $attr)
                ->save();

            $customer = $this->customerRepository->getById($params['customer_id']);
            $customer->setCustomAttribute('profile_pic', $attr);
            $this->customerRepository->save($customer);

            $this->messageManager->addSuccessMessage(__('Profile is saved!'));
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl($this->_redirect->getRefererUrl());
            return $resultRedirect;
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }
    }

}
