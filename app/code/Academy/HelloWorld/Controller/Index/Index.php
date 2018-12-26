<?php
namespace Academy\HelloWorld\Controller\Index;
// To get cusomter information you can use following snippet
// session object should be passed to controller using DI
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /**
     * @var Session
     */
    private $session;
    private $pageFactory;

    public function __construct(
        Context $context,
        Session $session,
        PageFactory $pageFactory
    )
    {
        parent::__construct($context);
        $this->session = $session;
        $this->pageFactory = $pageFactory;
    }

    public function execute()
    {
        $page = $this->pageFactory->create();
        $customerData = $this->session->getCustomer()->getName();
//        $customerName = $customerData ->getCustomer()->getName();
        if($this->session->isLoggedIn()) {
            $page->getLayout()->getBlock('helloworld_index_index')->setCustomerName($customerData);
            return $page;
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('customer/account/login');
        return $resultRedirect;
    }
}